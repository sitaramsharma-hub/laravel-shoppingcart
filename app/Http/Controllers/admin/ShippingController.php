<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Shipping;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function create(){
         $countries  = Country::get();
         $shipping  =  Shipping::select('shipping_charges.*','countries.name')->leftJoin('countries','countries.id','shipping_charges.country_id')->get();
         return view('admin.shipping.create', compact('countries','shipping'));
    }

    public function store(Request $request){

        

        $validator = Validator::make($request->all(), [          
            'country' => 'required',
            'amount' => 'required|numeric',
            
         ]);

         if($validator->fails()){
            return response()->json([
                'status' =>false,
               'errors' => $validator->errors()
             ]);
         }else{
            $count = Shipping::where('country_id', $request->country)->count();
            if($count >0 ){
                session()->flash('error', "Shipping already addded");
                return response()->json([
                    'status' =>true                 
                 ]);
            }
            $shipping = new Shipping();
            $shipping->country_id = $request->country;
            $shipping->amount= $request->amount;  
            $shipping->save();
            session()->flash('success', "Shipping added Successfully"); 
            return response()->json([
                'message' => 'Shipping saved Successfully',
                'status' =>true,                            
              ]);
         }
    }
}
