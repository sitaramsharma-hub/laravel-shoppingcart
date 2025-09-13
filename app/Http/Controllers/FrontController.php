<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
class FrontController extends Controller
{
    public function index(){
       $products = Product::where('is_featured','Yes')->orderBy('id','DESC')->take(8)       
        ->where('status',1)->get();
        $latestProducts =  Product::orderBy('id','DESC')->where('status',1)->take(8)->get();
        return view('front.home',compact('products', 'latestProducts'));
    }

  public function addToWishlist(Request $request){
      if(Auth::check() == false){

        session(['url.intended' => url()->previous()]);

         return response()->json([
            'status'=> false            
         ]);
      }
   $product   = Product::where('id',$request->id)->first();
   if(empty( $product)){
    return response()->json([
        'status'=> true,
        'message' => "Product is not found"            
     ]);
   }
   Wishlist::updateOrCreate(
        [
            'user_id' => Auth::user()->id,
            'product_id' => $request->id,
        ],
        [
            'user_id' => Auth::user()->id,
            'product_id' => $request->id,
        ]
    );
     //$wishlist =  new Wishlist;
     //$wishlist->user_id = Auth::user()->id;
    // $wishlist->product_id = $request->id;
    // $wishlist->save();  
     return response()->json([
        'status'=> true,
        'message' => '"'.$product->title.'" added in your wishlist'           
     ]);
  }

}
