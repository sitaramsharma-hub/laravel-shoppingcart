<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use App\Models\ProductRating;

class ShopController extends Controller
{
    public function index(Request $request, $categorySlug = null, $subCategorySlug = null){
        $categorySelected = "";
        $subcategorySelected = "";
        $brandsArray = [];
        if(!empty($request->get('brands'))){
            $brandsArray =  explode(',', $request->get('brands'));
        }
         $categories  = Category::orderBy('name','ASC')->with('sub_category')->where('status',1)->get();
         $brands =  Brand::orderBy('id','DESC')->where('status',1)->get();
         $products = Product::where('status',1);
         //Apply Filter Here 
         if(!empty($categorySlug)){
           $category = Category::where('slug',$categorySlug)->first();
           $products =  $products->where('category_id',$category->id);
           $categorySelected = $category->id;
         }

         if(!empty($subCategorySlug )){
            $subcategory = Subcategory::where('slug',$subCategorySlug)->first();
            $products =  $products->where('sub_category_id', $subcategory->id);
            $subcategorySelected = $subcategory->id;
          }

          if(!empty($request->get('brands'))){
             $brandsArray =  explode(',', $request->get('brands'));
             $products = $products->whereIn('brand_id',$brandsArray);
        }

         if($request->get('price_max') != '' && $request->get('price_min') != ''){
             if($request->get('price_max') == 1000){
                $products = $products->whereBetween('price',[intval($request->get('price_min')), 100000]);
             }else{
                $products = $products->whereBetween('price',[intval($request->get('price_min')), intval($request->get('price_max'))]);
             }
           
         }

         if(!empty($request->get('search'))){
           $products =  $products->where('title','like','%'.$request->get('search').'%');

         }
         
         if($request->get('sort')!=''){
            if($request->get('sort')=='latest'){
                $products = $products->orderBy('id','DESC');
            }else if($request->get('sort')=='price_asc'){
                $products = $products->orderBy('price','ASC');
            }else{
                $products = $products->orderBy('price','DESC');
            }
         }else{
            $products = $products->orderBy('id','DESC');
         }
       
         $products = $products->paginate(6);
        $pricemin  = intval($request->get('price_min'));
        $pricemax  = (intval($request->get('price_max'))== 0)?1000 : intval($request->get('price_max'));
        $sort = $request->get('sort');
        // $products =  Product::orderBy('id','DESC')->where('status',1)->get();
        return view('front.shop',compact('products', 'categories','brands','categorySelected', 'subcategorySelected',
        'brandsArray','pricemin', 'pricemax','sort'));
    }

    public function product($slug){
        $product = Product::where('slug',$slug)
             ->withCount('product_ratings')
             ->withSum('product_ratings','rating')
           ->with('product_images','product_ratings')->first();
           //dd($product);
        $relatdProducts = [];
        if($product->related_products != ''){
            $productArray = explode(',',$product->related_products);
            $relatdProducts = Product::whereIn('id',$productArray )->where('status',1)->get();

        }
        //dd($product);
        //Rating calculation 
        $avgRating = '0.00';
        if($product->product_ratings_count>0){
            $avgRating =  number_format(($product->product_ratings_sum_rating/$product->product_ratings_count),2);
            $avgratingPer = ($avgRating*100)/5;
        }else{
            $avgratingPer = '0.00';
        }
        
        if($product == null){
            abort(404);
        } 
         return view('front.product', compact('product','relatdProducts','avgRating','avgratingPer'));    
       }

  public function saveRating($id, Request $request){
    $validator = Validator::make($request->all(), [          
        'name' => 'required',
        'email' => 'required|email',
        'review' =>'required',
        'rating' =>'required'
    ]);
    if($validator->fails()){
        return response()->json([
            'status' =>false,
            'errors' => $validator->errors()
          ]);
    } 
    $count = ProductRating::where('email', $request->email)->count();
    if($count>0){
        session()->flash('error',"You already rated this product");
        return response()->json([
            'status' =>true
            
          ]);
    }
     $productRating = new ProductRating;
     $productRating->product_id =  $id;
     $productRating->username =  $request->name;
     $productRating->email =  $request->email;
     $productRating->comment =  $request->review;
     $productRating->rating =  $request->rating;
     $productRating->status = 0;
     $productRating->save();
     session()->flash('success',"Thanks for your rating");
     return response()->json([
        'status' =>true,
        'message' => "Thanks for your rating"
      ]);
  }     
}
