<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\TempImage;
use App\Models\ProductImage;
use App\Models\Subcategory;
use App\Models\ProductRating;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Image;
class ProductController extends Controller
{
   public function index(Request $request){
     $products = Product::latest('id')->with('product_images')->paginate();
     if(!empty($request->get('keyword'))) {
        $products = Product::latest('id')->with('product_images')->
        where('title', 'like', '%' . $request->get('keyword'). '%')->
        paginate();
     }
     //dd($products);
     return view('admin.products.list', compact('products') );
   }

    public function create(){
        $categories =  Category::all();
        return view('admin.products.create',compact('categories'));
    }

    public function store(Request $request){
        
        $rules = [          
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' =>'required|numeric',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
        if(!empty($request->track_qty) && $request->track_qty == 'Yes' ){
            $rules['qty'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()) {
            $product = new Product();
            $product->title = $request->title; 
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            $product->sub_category_id  = $request->sub_category;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->related_products = (!empty($request->related_products))?implode(',' ,$request->related_products):'';
            $result = $product->save();
            if(!empty($request->image_array)){
                foreach($request->image_array as $image_id){
                    $tempimage =  TempImage::find($image_id);
                    $extArray =  explode('.', $tempimage->name);
                    $ext = last($extArray);
                 
                    $productImage = new ProductImage();
                    $productImage->product_id =  $product->id;
                    $productImage->image=  'Null';
                    $productImage->save();

                    $imageName =  $product->id.'_'.$productImage->id.'_'.time().'.'.$ext;
                    $productImage->image=  $imageName;
                    $productImage->save();
                    //Generate Thumnail
                    $sPath = public_path().'/temp/'.$tempimage->name;
                    $dPath = public_path().'/uploads/product/large/'.$imageName ;
                    $img = Image::make($sPath);
                    $img->resize(1400, null, function ($constraint) {
                      $constraint->aspectRatio();
                  });
                  $img->save($dPath); 
                 
                  //smallimage
                 
                    $dPath = public_path().'/uploads/product/small/'.$imageName ;
                    $img = Image::make($sPath);
                    $img->fit(300,300);
                     $img->save($dPath); 

                }
            }
            $request->session()->flash('success','Product added successfully');
            return response()->json([
                'status' =>true,
                'message' => "Product added successfully"
              ]);

        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);
        }

    }

    public function edit($productid){
        $categories =  Category::all(); 
        $product = Product::find($productid);
        $productImage = ProductImage::where('product_id',$productid)->get();
        if(empty($product)){
            return redirect()->route('product.list')->with('error','Product not found');
        }
        $subCategories =  Subcategory::where('category_id',$product->category_id)->get(); 
        //fetch realed products
        $relatdProducts = [];
        if($product->related_products != ''){
            $productArray = explode(',',$product->related_products);
            $relatdProducts = Product::whereIn('id',$productArray )->get();

        }
        
        return view('admin.products.edit', compact('categories', 'product','subCategories','productImage','relatdProducts'));
    }

    public function update($productid,Request $request){
        $product = Product::find($productid);
        $rules = [          
            'title' => 'required',
            'slug' => 'required|unique:products,slug,'. $product->id.',id',
            'price' =>'required|numeric',
            'sku' => 'required|unique:products,sku,'.$product->id.',id',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];
        if(!empty($request->track_qty) && $request->track_qty == 'Yes' ){
            $rules['qty'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->passes()) {     
            $product->title = $request->title; 
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            $product->sub_category_id  = $request->sub_category;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->related_products = (!empty($request->related_products))?implode(',' ,$request->related_products):'';
            $result = $product->save();
           
            $request->session()->flash('success','Product Updated successfully');
            return response()->json([
                'status' =>true,
                'message' => "Product Updated successfully"
              ]);

        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);
        }
        
    }

    public function delete($id, Request $request){
        $product = Product::find($id);
         
        if(empty($product)){
          $request->session()->flash('error',"product not found");
          return response()->json([
            'status' =>true,
            'message' => "product not found"
          ]);
         // return redirect()->route('category.list');
        }
        //$product->delete();
        $productImage = ProductImage::where('product_id',$id)->get();
        if(!empty($productImage)){
            foreach($productImage  as $pimage){
                File::delete(public_path().'/uploads/product/large/'.$pimage->image);
                File::delete(public_path().'/uploads/category/thumb/'.$pimage->image);
            }  
            ProductImage::where('product_id',$id)->delete();  
        }
        $product->delete();
        $request->session()->flash('success',"Product deleted successfully");
        return response()->json([
          'status' =>true,
          'message' => "Product deleted successfully"
        ]);
      }

    public function getProducts(Request $request){
        $tempProduct= [];
       if($request->term != ""){
        $products = Product::where('title', 'like', '%'.$request->term.'%')->get();
         foreach($products as $product){

            $tempProduct[] =  array('id' => $product->id ,'text' => $product->title);
         }
       }

        return response()->json([
            'tags' => $tempProduct,
            'status'=> true
        ]);
    }  

    public function rating(Request $request){
    $productRatings    = ProductRating::leftJoin('products','products.id', '=', 'product_ratings.product_id')
        ->select('product_ratings.*', 'products.title as product_title');
       
        if(!empty($request->get('keyword'))) { 
             
            $productRatings->where('products.title' ,'like',
        '%'.$request->get('keyword').'%')
        ->orWhere('product_ratings.username', 'like', '%' . $request->get('keyword') . '%');      
        }
        
       //echo $productRatings->toSql(); // Displays the query with placeholders
        //print_r($productRatings->getBindings()); // Displays the binding values
        //die();
        $productRatings = $productRatings->paginate();    
        return view('admin.products.rating',compact('productRatings'));  
    }

    public function changeRatingStatus(Request $request){
    $productRating    = ProductRating::find($request->id);
    $productRating->status = $request->status;
    $productRating->save();
    $request->session()->flash('success',"Product Rating updated successfully");
    return response()->json([
         'status'=> true
    ]);
    }
}
