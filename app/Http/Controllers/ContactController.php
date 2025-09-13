<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Mail\ContactEmail;
class ContactController extends Controller
{
    public function index(){
        return view('front.contact');
    }
    public function sendContactEmail(Request $request){
        $validator = Validator::make($request->all(), [          
            'name' => 'required',
            'email' => 'required|email',
            'subject' =>'required'
        ]);

        if($validator->passes()){

            //Send Email
            $emailData = [
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'mailSubject' =>'you have received a contact enquiry'
            ];
            $admin = User::where('id',1)->first();

            Mail::to($admin->email)->send(new ContactEmail($emailData));

            $request->session()->flash('success','Email sent successfully');
            return response()->json([
                'status' =>true,
                'message' => "Email sent successfully"
              ]);
        }else{
            return response()->json([
                'status' =>false,
                'errors' => $validator->errors()
              ]);

        }
    }
}
