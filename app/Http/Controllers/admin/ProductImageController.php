<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductImage;
use Image;
use Illuminate\Support\Facades\File;
class ProductImageController extends Controller
{
    public function update(Request $request){
        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $tempImageLocation = $image->getPathName();

        $productImage = new ProductImage();
        $productImage->product_id =  $request->product_id;
        $productImage->image=  'Null';
        $productImage->save();

        $imageName =  $request->product_id.'_'.$productImage->id.'_'.time().'.'.$ext;
        $productImage->image =  $imageName;
        $productImage->save();

        $sourcePath =  $tempImageLocation;
        $dPath = public_path().'/uploads/product/large/'.$imageName ;
         $img = Image::make($sourcePath);
        $img->resize(1400, null, function ($constraint) {
                      $constraint->aspectRatio();
        });
        $img->save($dPath);

        $dPath = public_path().'/uploads/product/small/'.$imageName ;
        $img = Image::make($sourcePath);
        $img->fit(300,300);
         $img->save($dPath);

         return response()->json([
            'status' =>true,
            'image_id' => $productImage->id,
            'ImagePath' => asset('uploads/product/small/'.$productImage->image),
            'message' => "Image save Successfully"
          ]);

    }

    public function destroy(Request $request){
        $productImage = ProductImage::find($request->id);
        //$productImage->delete();
        if(empty($productImage)){
            $request->session()->flash('error',"Image not found");
            return response()->json([
              'status' =>false,
              'message' => "Image not found"
            ]);
           // return redirect()->route('category.list');
          }
        File::delete(public_path().'/uploads/product/large/'.$productImage->image);
        File::delete(public_path().'/uploads/product/small/'.$productImage->image);
        $productImage->delete();
        $request->session()->flash('success',"image deleted successfully");
        return response()->json([
          'status' =>true,
          'message' => "image deleted successfully"
        ]);
    }
}
