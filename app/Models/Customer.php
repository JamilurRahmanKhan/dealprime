<?php

namespace App\Models;

// use Log;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use sms_net_bd\SMS;

class Customer extends Authenticatable
{
    use HasFactory;
    private static $customer ;

    public static function infoStore($request) {
         $request->validate([
            'customer_name' => 'required',
            'phone' => 'required|digits:11|unique:customers,phone',
            'customer_email' => 'unique:customers,email',
            'password' => 'required|min:8',
        ],[
            'phone.required' => 'The phone number field is required.',
            'phone.unique' => 'Phone number already exist.',
            'phone.digits' => 'The phone number must be exactly 11 digits.',
            'customer_email' => 'Email already exist',
            'password.min' => 'Password must be 8 character',
        ]);
        $otp = rand(111111,999999);
        self::$customer = new Customer();
        self::$customer->name = $request->customer_name;
        self::$customer->email = $request->customer_email;
        self::$customer->phone = $request->phone;
        self::$customer->password = bcrypt($request->password);
        self::$customer->otp = $otp;
        self::$customer->save();
        $sms = new SMS();
        try {
            // Send Single SMS
            $response = $sms->sendSMS(
                "Your DealPrime OTP is $otp",
                "$request->phone"
            );
            if ($response){
                return self::$customer;
            }
        } catch (Exception $e) {
            // handle $e->getMessage();
        }
    }

    // public static function infoCheck($request) {
    //     $request->validate([
    //         'customer_phone' => 'required|exists:customers,phone',
    //         'customer_password' => 'required ',
    //     ]);

    //     if (Auth::guard('customer')->attempt([
    //         'phone' => $request->customer_phone,
    //         'password' => $request->customer_password,
    //     ], $request->has('remember_token')));
    // }
//    public static function sendOpt(Request $request){
//        self::$customer = Customer::where('phone',$request->phone)->first();
//        if (self::$customer){
//            if (self::$customer->phone  == $request->phone){
//                $otp = rand(111111,999999);
//                self::$customer->otp = $otp;
//                self::$customer->save();
//                $sms = new SMS();
//                try {
//                    // Send Single SMS
//                    $response = $sms->sendSMS(
//                        "Your DealPrime OTP is $otp",
//                        "$request->phone"
////                   "01722736224"
//                    );
//                    if ($response){
//                        return self::$customer;
//                    }
//                } catch (Exception $e) {
//                    // handle $e->getMessage();
//                }
//            }
//        }else{
//            return back()->with('message','please use registered phone number');
//        }
//
//    }
    public static function customerDelete($id)
    {
        self::$customer=Customer::find($id);
        self::$customer->status = 0;
        self::$customer->save();

    }

    public static function sentLink($request){
        $request->validate([
            'email'=>'required|email|exists:customers,email'
        ]);

        $token = Str::random(60);
        DB::table('password_reset_tokens')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);
       Mail::send('web.accounts.reset-message',['token'=>$token],function($message)use($request){
            $message->to($request->email);
            $message->subject("Password Reset ");
       });
    }

}
