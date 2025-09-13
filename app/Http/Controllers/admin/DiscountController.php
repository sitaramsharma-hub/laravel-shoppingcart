<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\DiscountCoupon;
use Illuminate\Support\Carbon;

class DiscountController extends Controller
{
    public function create(){
        return view('admin.discounts.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [          
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required'
        ]);

        if($validator->passes()){

           if(!empty($request->start_at)){
             $now = Carbon::now();
             $startAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->start_at);
             if($startAt->lte($now) == true ){
                return response()->json([
                    'status' =>false,
                    'errors' => ['starts_at' => 'Start date can not be less than current time']
                  ]);
             }
           }

           if(!empty($request->start_at) && !empty($request->expire_at)){
       
            $startAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->start_at);
            $expireAt = Carbon::createFromFormat('Y-m-d H:i:s',$request->expire_at);
            if($expireAt->gt($startAt) == false){
               return response()->json([
                   'status' =>false,
                   'errors' => ['expire_at' => 'Expre date must be greater than start date']
                 ]);
            }
          }
            $discountCode = new DiscountCoupon();
            $discountCode->code =  $request->code;
            $discountCode->name =  $request->name;
            $discountCode->description =  $request->description;
            $discountCode->max_uses =  $request->max_uses;
            $discountCode->max_uses_user =  $request->max_uses_user;
            $discountCode->type =  $request->type;
            $discountCode->discount_amount =  $request->discount_amount; 
            $discountCode->min_amount =  $request->min_amount; 
            $discountCode->status =  $request->status; 
            $discountCode->starts_at =  $request->start_at;
            $discountCode->expire_at =  $request->expire_at;    
            $discountCode->save();
            $request->session()->flash('success','Discount added successfully');
            return response()->json([
                'status' =>true,
                'message' => "Discount added successfully"
              ]);
        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);
        }
    }
}
