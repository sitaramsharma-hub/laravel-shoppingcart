<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use App\Models\DiscountCoupon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function addToCart(Request $request){
        //Cart::add('293ad', 'Product 1', 1, 9.99);
         $product = Product::with('product_images')->find($request->id);
         if($product == null){
            return response()->json([
                'status' =>false,
                'message' => "product not found"
              ]);
         }

         if(Cart::count() > 0){
           
            //$message = "product alredy in cart";  
            //product found in cart
            //check if this product already in cart
            $cartContent = Cart::content();
            $productAlreadyExist = false;
            foreach($cartContent  as $item){
                if($item->id == $product->id){
                    $productAlreadyExist = true;
                }
            }        
              
            if($productAlreadyExist == false){
                Cart::add($product->id, $product->title, 1, $product->price,['productImage'=>(!empty($product->product_images)) ? $product->product_images->first():'']);
                $status = true;
                $message = $product->title.' added in the cart'; 
                session()->flash('success', $message); 
            }else{
                $status = false;
                $message = $product->title.' Already added in the cart';
            }

         }else{
            //cart is empty
           // echo "Cart is empty and adding product to cart";
            Cart::add($product->id, $product->title, 1, $product->price,['productImage'=>(!empty($product->product_images)) ? $product->product_images->first():'']);

            $status = true;
            $message = $product->title.' added in the cart';
            session()->flash('success', $message);
         }
        
         return response()->json([
            'status' => $status,
            'message' => $message
          ]);
    }
    
    public function cart(){
       // dd(Cart::content());
       $cartContent = Cart::content();
        return view('front.cart',compact('cartContent'));
    }

    function updateCart(Request $request){
       $rowId = $request->rowID;
       $qty = $request->qty;

       // check qty avilable in stock
      $itemInfo =Cart::get($rowId);
      $product = Product::find($itemInfo->id);

      if($product->track_qty == 'Yes'){
         if( $qty <= $product->qty ){
            Cart::update($rowId, $qty); 
            $message = "Cart updated Successfully";
            $status = true;
            session()->flash('success', $message);
         }else{
            $message = 'Requested qty('.$qty.') not avilaable in stock.';
            $status = false;
            session()->flash('error', $message);
         }
      }else{
        Cart::update($rowId, $qty); 
        $message = "Cart updated Successfully";
        $status = true;
        session()->flash('success', $message);
      }
      // Cart::update($rowId, $qty); 
      
       return response()->json([
        'status' => $status,
        'message' => $message
      ]);
    }

    public function deleteItem(Request $request){

           $rowId = $request->rowID;
           $itemInfo =Cart::get($rowId);
           if($itemInfo == null){
            $message = 'Item not found in cart';
            session()->flash('error', $message);
            return response()->json([
                'status' => false,
                'message' => $message
              ]);
           }

          
           Cart::remove($rowId);
           $message = "Item removed from cart successfully";
           session()->flash('success', $message);
           return response()->json([
            'status' => true,
            'message' => $message
          ]);
    }

    public function checkout(){
      $discount = 0;
      if(Cart::count() == 0 ){
         return redirect()->route('front.cart');
      }
      if(Auth::check() == false){
         if(!session()->has('url.intended')){
           session(['url.intended' => url()->current()]); 
         } 
         return redirect()->route('account.login');
      }
      $customerAddress = CustomerAddress::where('user_id', Auth::user()->id)->first();
        session()->forget('url.intended');

        $countries = Country::orderBy('name','ASC')->get();
        $subTotal = Cart::subtotal(2,'.','');
        if(session()->has('code')){
         $code = session()->get('code');
           if($code->type == 'percent'){
               $discount = ($code->discount_amount/100)*$subTotal;
           }else{
              $discount = $code->discount_amount;
           }
        }
        //calculate shipping
        if($customerAddress!=''){
         $userCountry = $customerAddress->country_id; 
         $shippingInfo =  Shipping::where('country_id',$userCountry )->first();
       
         $totalQty = 0;
         $totalShippingCharge = 0;        
         $grandTotal = 0;
         foreach(Cart::content() as $item){
            $totalQty += $item->qty;
         }
         if($shippingInfo != null){
            $totalShippingCharge  = $totalQty * $shippingInfo->amount;
            $grandTotal = ($subTotal-$discount)+$totalShippingCharge ;   
         }else{
            $shippingInfo =  Shipping::where('country_id','rest_of_world')->first();
            $totalShippingCharge  = $totalQty * $shippingInfo->amount;
            $grandTotal = ($subTotal-$discount)+$totalShippingCharge;     
         } 
    

        }else{
         $totalShippingCharge = 0;
         $grandTotal  = ($subTotal-$discount);
        }
          

       return view('front.checkout', compact('countries', 'customerAddress','totalShippingCharge','grandTotal','discount'));
    }

    public function processCheckout(Request $request){
      $validator = Validator::make($request->all(), [          
         'first_name' => 'required|min:5',
         'last_name' => 'required',
         'email' => 'required|email',
         'country' => 'required',
         'address' => 'required|min:30',
         'city' => 'required',
         'state' => 'required',
         'zip' => 'required',
         'mobile' => 'required',
      ]);
       
      if($validator->fails()){
         return response()->json([
            'message' => 'Please fix the error',
            'status' =>false,
            'errors' => $validator->errors()
          ]);
      }

         $user = Auth::user();
         CustomerAddress::updateOrCreate(
            ['user_id' => $user->id],
            [
               'user_id' => $user->id,
              'first_name' => $request->first_name,
               'last_name' => $request->last_name,
               'email' => $request->email,
               'country_id' => $request->country,
               'address' => $request->address,
               'apartment' => $request->apartment,
               'city' => $request->city,
               'state' => $request->state,
               'zip' => $request->zip,
               'mobile' => $request->mobile,

             ]
            );

            if($request->payment_method == 'cod'){
               $discountCodeId = NULL;
               $promoCode = '';
               $shipping = 0;
               $totalQty = 0;
              $discount = 0;
             
               $subTotal = Cart::subtotal(2,'.','');
               if(session()->has('code')){
                  $code = session()->get('code');
                
                    if($code->type == 'percent'){
                        $discount = ($code->discount_amount/100)*$subtotal;
                    }else{
                     $discount = $code->discount_amount; 
                    }
                    $discountCodeId = $code->id;    
                     $promoCode = $code->code;
                 }
               foreach(Cart::content() as $item){
                  $totalQty += $item->qty;
               }
               $shippingInfo =  Shipping::where('country_id',$request->country)->first();
               if($shippingInfo != null){
                  $shipping  = $totalQty * $shippingInfo->amount;
                  $grandTotal = ($subTotal-$discount)+$shipping;   
               }else{
                  $shippingInfo =  Shipping::where('country_id','rest_of_world')->first();
                  $shipping  = $totalQty * $shippingInfo->amount;
                  $grandTotal = ($subTotal-$discount)+$shipping;      
               }   
               
               
             
      
               $order = new Order();
               $order->subtotal = $subTotal;
               $order->shipping = $shipping;
               $order->discount = $discount;
               $order->coupon_code_id = $discountCodeId;
               $order->coupon_code = $promoCode;
               $order->grand_total = $grandTotal;
               $order->payment_status = 'not paid';
               $order->status = 'pending';
               $order->user_id = $user->id;
               $order->first_name = $request->first_name;
               $order->last_name = $request->last_name;
               $order->email= $request->email;
               $order->mobile = $request->mobile;
               $order->country_id = $request->country;
               $order->address = $request->address;
               $order->apartment = $request->apartment;
               $order->city = $request->city;
               $order->state = $request->state;
               $order->zip = $request->zip;
               $order->notes = $request->order_notes;
               $order->save();

               foreach(Cart::content() as $item){
                  $orderItem = new OrderItem();
                  $orderItem->product_id = $item->id;
                  $orderItem->order_id  = $order->id;
                  $orderItem->name = $item->name;
                  $orderItem->qty = $item->qty;
                  $orderItem->price = $item->price;
                  $orderItem->total = $item->price * $item->qty;
                  $orderItem->save();
                   //update product stock

                  $productData = Product::find($item->id);
                  if($productData->track_qty == 'Yes'){
                     $currentQty = $productData->qty;
                     $updateQty = $currentQty - $item->qty;
                     $productData->qty = $updateQty;
                     $productData->save();
                  }
                  

               }

               
               orderEmail($order->id,'customer');
               session()->flash('success', "You have successfully placed order"); 
               Cart::destroy();
               session()->forget('code');
               return response()->json([
                  'message' => 'Order saved Successfully',
                  'status' =>true, 
                  'orderId' => $order->id                 
                ]);

            }else{

            }


    }

    public function thankyou($id){
      return view('front.thank',
         ['id' =>$id

         ]);
    }

    public function getOrderSummery(Request $request){
      $subtotal  = Cart::subtotal(2,'.',''); 
      $discount = 0;
      $discountSummery = '';
         if(session()->has('code')){
          $code = session()->get('code');
        
            if($code->type == 'percent'){
                $discount = ($code->discount_amount/100)*$subtotal;
            }else{
             $discount = $code->discount_amount; 
            }

               $discountSummery =  '<div class="mt-4" id="discount-response">
               <strong>'.session()->get('code')->code.'</strong>
               <a class="btn btn-sm btn-danger" id="remove-discount"><i class="fa fa-times"></i></a>
         </div>'; 
         }

   
         
         if($request->country_id > 0){

            
            $totalQty = 0;
            foreach(Cart::content() as $item){
               $totalQty += $item->qty;
            }
            $shippingInfo =  Shipping::where('country_id',$request->country_id)->first();
            if($shippingInfo != null){
                 $shipingCharge = $totalQty * $shippingInfo->amount;
                 $grandtotal = ($subtotal-$discount) + $shipingCharge;     
                 
                 return response()->json([
                  'status' =>true, 
                  'grandTotal' =>  number_format($grandtotal,2),
                  'discount' => number_format($discount,2),
                  'shippingCharge' =>number_format($shipingCharge,2),
                  'discountSummery' => $discountSummery        
                ]);
            }else{
               $shippingInfo =  Shipping::where('country_id','rest_of_world')->first();
               $shipingCharge = $totalQty * $shippingInfo->amount;
               $grandtotal = ($subtotal-$discount) + $shipingCharge;     
               
               return response()->json([
                'status' =>true, 
                'grandTotal' =>  number_format($grandtotal,2),
                'discount' => number_format($discount,2),
                'shippingCharge'=> number_format($shipingCharge,2),
                'discountSummery' => $discountSummery        
              ]);
            }
         }else{
            return response()->json([
               'status' =>true, 
               'grandTotal' =>  number_format(($subtotal-$discount),2) ,
               'discount' => number_format($discount,2),
               'shippingCharge' =>number_format(0,2),
               'discountSummery' => $discountSummery       
             ]);
         }   
    }

    public function applyDiscount(Request $request){
      //dd($request->code);
      $code = DiscountCoupon::where('code',$request->code)->first();
       if($code == null){
         return response()->json([
            'status' =>false,
            'message' => 'Invalid discount coupon' 
          ]);
       } 
       
       //check if couopn start date is valid or not
       $now = Carbon::now();
      // echo $now->format('Y-m-d H:i:s');
       if($code->starts_at != null ){
         $startAt = Carbon::createFromFormat('Y-m-d H:i:s',$code->starts_at);
         if($now->lt($startAt)){
            return response()->json([
               'status' =>false,
               'message' => 'Invalid discount coupon' 
             ]);
         }
       }

       if($code->expire_at != null ){
         $endDate = Carbon::createFromFormat('Y-m-d H:i:s',$code->expire_at);
         if($now->gt($endDate)){
            return response()->json([
               'status' =>false,
               'message' => 'Invalid discount coupon' 
             ]);
         }
       }

       // Max uses check
       if($code->max_uses > 0){
         $couponUsed = Order::where('coupon_code_id',$code->id)->count();     
         if($couponUsed >= $code->max_uses){
           return response()->json([
              'status' =>false,
              'message' => 'Invalid discount coupon' 
            ]);
         }
       }
    
    
       // Max uses user check
       if($code->max_uses_user > 0){
         $couponUsedByUser = Order::where(['coupon_code_id' => $code->id, 'user_id'=> Auth::user()->id])->count();
       
         if($couponUsedByUser >= $code->max_uses_user){
           return response()->json([
              'status' =>false,
              'message' => 'You Already used this coupon', 
            ]);
         }
       }
    
       $subtotal  = Cart::subtotal(2,'.',''); 
       if($code->min_amount > 0){
          if($code->min_amount > $subtotal){
            return response()->json([
               'status' =>false,
               'message' => 'Your minimum amount must be '.$code->min_amount.'.', 
             ]);
          }
       }

        
       session()->put('code', $code);
       return  $this->getOrderSummery($request);
    }

    public function removeCoupon(Request $request){
         session()->forget('code');
         return  $this->getOrderSummery($request);
    }
}
