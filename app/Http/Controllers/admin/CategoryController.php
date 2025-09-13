<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\TempImage;
use Illuminate\Support\Facades\File;
use Image;
class CategoryController extends Controller
{
    public function index(Request $request){
      $categories =  Category::latest();    
      if(!empty($request->get('keyword'))) {
        $categories = Category::where('name','like','%'.$request->get('keyword').'%');     
      }  
      $categories =   $categories->paginate(); 
        return view('admin.category.list',compact('categories'));
    }

    public function create(){
      return view('admin.category.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [          
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);
        if($validator->passes()){
            $category = new Category();
            $category->name = $request->name; 
            $category->slug = $request->slug;            
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $result = $category->save();
            if(!empty($request->image_id)){
              $tempimage =  TempImage::find($request->image_id);
              $extArray =  explode('.', $tempimage->name);
              $ext = last($extArray);
              $newImageName = $category->id.'.'.$ext;
              $sPath = public_path().'/temp/'.$tempimage->name;
              $dPath = public_path().'/uploads/category/'.$newImageName;
              File::copy($sPath,$dPath);
              //generate image thumbnail
              $img = Image::make($sPath);
              $img->fit(450, 600, function ($constraint) {
                $constraint->upsize();
            });
              $dthumbPath = public_path().'/uploads/category/thumb/'.$newImageName;
              $img->save($dthumbPath);
              $category->image = $newImageName;
              $category->save();
            }
            $request->session()->flash('success','category added successfully');
            return response()->json([
                'status' =>true,
                'message' => "category added successfully"
              ]);
        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);
        }
    }
    public function edit($catgoryid){
          $category = Category::find($catgoryid);
         
          if(empty($category)){
            return redirect()->route('category.list');
          }

          return view('admin.category.edit',compact('category'));
        
    }
    public function update($catgoryid, Request $request){

      $category = Category::find($catgoryid);
         
          if(empty($category)){
            $request->session()->flash('error',"category not found");
            return  response()->json([
             'status' =>false,
             'notFound' =>true,
             'message' => "Category not found"
            ]);
          }

          $validator = Validator::make($request->all(), [          
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$category->id.',id',
        ]);
        if($validator->passes()){          
            $category->name = $request->name; 
            $category->slug = $request->slug;            
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $result = $category->save();
            $oldImage =  $category->image;
            if(!empty($request->image_id)){
              $tempimage =  TempImage::find($request->image_id);
              $extArray =  explode('.', $tempimage->name);
              $ext = last($extArray);
              $newImageName = $category->id.'-'.time().'.'.$ext;
              $sPath = public_path().'/temp/'.$tempimage->name;
              $dPath = public_path().'/uploads/category/'.$newImageName;
              File::copy($sPath,$dPath);
              //generate image thumbnail
              $img = Image::make($sPath);
              //$img->resize(450, 600);
              $img->fit(450, 600, function ($constraint) {
                $constraint->upsize();
            });
              $dthumbPath = public_path().'/uploads/category/thumb/'.$newImageName;
              $img->save($dthumbPath);
              $category->image = $newImageName;
              $category->save();
              
              //Delete old images 
              File::delete(public_path().'/uploads/category/'.$oldImage);
              File::delete(public_path().'/uploads/category/thumb/'.$oldImage);

            }
            $request->session()->flash('success','category updated successfully');
            return response()->json([
                'status' =>true,
                'message' => "category updated successfully"
              ]);
        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);
        }
    }

    public function delete($id, Request $request){
      $category = Category::find($id);
       
      if(empty($category)){
        $request->session()->flash('error',"category not found");
        return response()->json([
          'status' =>true,
          'message' => "category not found"
        ]);
       // return redirect()->route('category.list');
      }
      $category->delete();
      File::delete(public_path().'/uploads/category/'.$category->image);
      File::delete(public_path().'/uploads/category/thumb/'.$category->image);
      $request->session()->flash('success',"category deleted successfully");
      return response()->json([
        'status' =>true,
        'message' => "category deleted successfully"
      ]);
    }
}
