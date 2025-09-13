<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function index(Request $request){
        $subcategories = DB::table('sub_categories')
            ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->select('sub_categories.*', 'categories.name as category_name')
            ->paginate();
        if(!empty($request->get('keyword'))) {
            $subcategories = DB::table('sub_categories')
            ->join('categories', 'sub_categories.category_id', '=', 'categories.id')
            ->where('sub_categories.name', 'like', '%' . $request->get('keyword'). '%')
            ->orWhere('categories.name', 'like', '%' . $request->get('keyword') . '%')
            ->select('sub_categories.*', 'categories.name as category_name')
            ->paginate();    
        }  
       // $subcategories =   $subcategories->paginate(); 
          return view('admin.subcategory.list',compact('subcategories'));

    }

    public function create(){
        $categories =  Category::all(); 
        return view('admin.subcategory.create',compact('categories'));
    }
   
    public function store(Request $request){
        $validator = Validator::make($request->all(), [          
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category' =>'required'
        ]);
        if($validator->passes()){
            $subcategory = new Subcategory();
            $subcategory->category_id = $request->category;
            $subcategory->name = $request->name; 
            $subcategory->slug = $request->slug;            
            $subcategory->status = $request->status;
            $subcategory->showHome = $request->showHome;
            $result = $subcategory->save();
            $request->session()->flash('success','subcategory added successfully');
            return response()->json([
                'status' =>true,
                'message' => "subcategory added successfully"
              ]);
        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);

        }   
    }

    public function edit($subcatid){
        $subcategory = Subcategory::find($subcatid);
        $categories =  Category::all(); 
          if(empty($subcategory)){
            return redirect()->route('subcategory.list');
          }

          return view('admin.subcategory.edit',compact('categories', 'subcategory' ));
    }

    public function update($subcatid, Request $request){
        $subcategory = Subcategory::find($subcatid);
         
          if(empty($subcategory)){
            $request->session()->flash('error',"Subcategory not found");
            return  response()->json([
             'status' =>false,
             'notFound' =>true,
             'message' => "Subcategory not found"
            ]);
          }

          $validator = Validator::make($request->all(), [          
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug,'.$subcategory->id.',id',
            'category' =>'required'
        ]);
        if($validator->passes()){  
            $subcategory->category_id = $request->category;        
            $subcategory->name = $request->name; 
            $subcategory->slug = $request->slug;            
            $subcategory->status = $request->status;
            $subcategory->showHome = $request->showHome;
            $result = $subcategory->save();
          
            
            $request->session()->flash('success','subcategory updated successfully');
            return response()->json([
                'status' =>true,
                'message' => "Subcategory updated successfully"
              ]);
        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);
        }
    }

    public function delete($id, Request $request){
        $subcategory = Subcategory::find($id);
         
        if(empty($subcategory)){
          $request->session()->flash('error',"subcategory not found");
          return response()->json([
            'status' =>true,
            'message' => "subcategory not found"
          ]);
         // return redirect()->route('category.list');
        }
        $subcategory->delete();
       
        $request->session()->flash('success',"subcategory deleted successfully");
        return response()->json([
          'status' =>true,
          'message' => "subcategory deleted successfully"
        ]);
      }

}
