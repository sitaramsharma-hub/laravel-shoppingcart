<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\TempImage;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(){

        //delete temp images 
         $dayBeforeToday = Carbon::now()->subDays(1)->format('Y-m-d H:i:s');
         //dd($dayBeforeToday);
        $tempImages =TempImage::where('created_at','<=',$dayBeforeToday)->get();
        foreach($tempImages as $tempImage){
            $path = public_path('/temp/'.$tempImage->name);
            $thumbPath = public_path('/temp/thumb/'.$tempImage->name);
            //Delete Main Image
          
           if(File::exists($path)){
              File::delete($path);
           }

             //Delete Thumb Image
             if(File::exists($thumbPath)){
                File::delete($thumbPath);
             }

             TempImage::where('id', $tempImage->id)->delete();
        }

        return view('admin.dashboard');
      //$admin = Auth::guard('admin')->user();
       //echo 'welcome ' .$admin->name.' <a href="'.route('admin.logout').'">Logout</a>';    
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login'); 
    }
}
