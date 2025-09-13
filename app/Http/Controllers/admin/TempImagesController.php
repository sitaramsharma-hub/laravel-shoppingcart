<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempImage;
use Image;
class TempImagesController extends Controller
{
    public function create(Request $request){
        $image  = $request->image;
        if(!empty($image)){
            $ext = $image->getClientOriginalExtension();
            $newname = time().'.'.$ext;
            $tempimage =  new TempImage();
            $tempimage->name =  $newname;
            $tempimage->save();
            $image->move(public_path().'/temp',$newname);
            $sPath =  public_path().'/temp/'.$newname;
            $dpath =  public_path().'/temp/thumb/'.$newname;
            $img = Image::make($sPath);
            $img->fit(300, 275);
            $img->save($dpath);
             
            return response()->json([
                'status' => true,
                'image_id' => $tempimage->id,
                'ImagePath' => asset('/temp/thumb/'.$newname),
                 'message' => 'Image Upload Successfully'
            ]);
        }
    }
}
