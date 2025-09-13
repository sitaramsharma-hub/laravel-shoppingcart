<?php

namespace App\Http\Controllers;
use App\Models\User; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Wishlist;

class AuthController extends Controller
{
    public function login(){
        return view('front.account.login');
    }

    public function register(){
        return view('front.account.register');
    }

    public function processRegister(Request $request){
        $validator = Validator::make($request->all(), [          
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required| min:5|confirmed'
        ]);
        if($validator->passes()){
            $user = new User();
            $user->name = $request->name; 
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();
            session()->flash('success', 'You have beeen reistred successfully');

            return response()->json([
                'status' =>true,        
              ]);
        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);
        }
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [        
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->passes()){
            if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password], 
            $request->get('remember'))) {
               
                if(session()->has('url.intended')){
                     return  redirect(session()->get('url.intended')); 
                  } 

                return redirect()->route('account.profile');
            }else{
                //session()->flash('error', 'Either email/pasword is incorrect'); 
                return redirect()->route('account.login')->withinput($request->only('email'))
                ->with('error', 'Either email/pasword is incorrect'); 
            }  

        }else{
           
        return redirect()->route('account.login')
        ->withErrors($validator)->withinput($request->only('email'));
        }
    }


    public function profile(){
        $user =  User::where('id', Auth::user()->id)->first();
        return view('front.account.profile',compact('user'));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('account.login')->with('success', 'You are successfully logout');
    }
    public function orders(){
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at','DESC')->get();
        return view('front.account.orders', compact('orders'));
    }
    public function orderDetail($id){
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('id', $id)->first();
        $orderItems = OrderItem::where('order_id',$id)->get();
        $itemCount = OrderItem::where('order_id',$id)->count();
        return view('front.account.order-detail',compact('order','orderItems','itemCount' ));
    }

    public function wishlist(){
      $wishlists =  Wishlist::where('user_id', Auth::user()->id)
      ->with('product')
      ->get();
        return view('front.account.wishlist',compact('wishlists'));
    }

    public function removeProductFromWishlist(Request $request){
        $productid =  $request->id;
        $wishlist = Wishlist::where('user_id', Auth::user()->id)
                    ->where('product_id',$productid)->first();

        if($wishlist == null){
            session()->flash('error','Product already removed');
            return response()->json([
                'status'=> true
            ]);
        }else{
            Wishlist::where('user_id', Auth::user()->id)
                    ->where('product_id',$productid)->delete();
                    session()->flash('success','Product removed successfully');
                    return response()->json([
                        'status'=> true
                    ]);      

        }            
    }

    function updateProfile(Request $request){
        $user =   User::find(Auth::user()->id);
        $validator = Validator::make($request->all(), [          
            'name' => 'required',
            'email' => 'required|unique:users,email,'.$user->id,            
        ]);
        if($validator->passes()){
          $user->name = $request->name;
          $user->email = $request->email;
          $user->phone = $request->phone; 
          $user->save();
          $request->session()->flash('success','Profile added successfully');
          return response()->json([
            'status' =>true,
            'message' => 'Profile added successfully'
            ]);
        }else{

            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
                ]);
        } 

    }

    public function showChangePasswordForm(){
        return view('front.account.change-password');
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [          
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' =>'required|min:5|same:confirm_password'           
        ]);
            if($validator->passes()){
            $user = User::select('id','password')->where('id', Auth::user()->id)->first();
               if(!Hash::check($request->old_password,$user->password)){
                $request->session()->flash('error','Your Old password is incorrect'); 

                return response()->json([
                    'status' =>true                    
                    ]);
               }

               User::where('id', $user->id)->update([
                'password' => Hash::make($request->new_password)
               ]);

               $request->session()->flash('success','You have successfully update password'); 
               return response()->json([
                'status' =>true                    
                ]);

            }else{

                return response()->json([
                    'status' =>false,
                    'errors' => $validator->errors()
                    ]);
            } 
        }

        public function forgotPassword(){
            return view('front.account.forgot-password');
        }
    
        public function processForgotPassword(Request $request){
            $validator = Validator::make($request->all(), [          
                'email' => 'required|email|exists:users,email',
                         
            ]);
            if($validator->fails()){
               return redirect()->route('front.forgotPassword')->withInput()
               ->withErrors($validator);
            }

          $token = Str::random(60);
          \DB::table('password_resets')->where('email',$request->email)->delete();

          \DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' =>now()
          ]);
          // Send Email  
         $user = User::where('email',$request->email)->first();
          $formData =[
            'token' => $token,
            'user' => $user,
            'mailsubject' => 'You have reuested to reset password'
          ];
          Mail::to($request->email)->send(new ResetPasswordEmail($formData));
          return redirect()->route('front.forgotPassword')->with('success','Please
          check your inbox to reset your password');
        }

        public function resetPassword($token){
           $tokenFound =  \DB::table('password_resets')->where('token',$token)->first();
           if(!$tokenFound){
            return redirect()->route('front.forgotPassword')->with('error','There is token mismatch');
           }
           return view('front.account.reset-password',compact('token'));
        }

        public function processResetPassword(Request $request){
             // dd($request->token);
            $tokenObj =  \DB::table('password_resets')->where('token',$request->token)->first();
            if($tokenObj == null){
             return redirect()->route('front.forgotPassword')->with('error','There is token mismatch');
            }

         $user = User::where('email', $tokenObj->email)->first();  

             $validator = Validator::make($request->all(), [          
            'new_password' => 'required|min:5',
            'confirm_password' =>'required|min:5|same:new_password'           
        ]);

        if($validator->fails()){
            return redirect()->route('front.resetPassword',$request->token)->withInput()
            ->withErrors($validator);
         }
            $new_password = Hash::make($request->new_password);
         User::where('id',$user->id)->update([
            'password'=> $new_password
         ]);
       
         \DB::table('password_resets')->where('email',$tokenObj->email)->delete();
         return redirect()->route('account.login')->with('success','password 
         reset successfully');

    }
}
