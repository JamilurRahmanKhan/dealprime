<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Livewire\Attributes\Session;
use sms_net_bd\SMS;

class SmsController extends Controller
{
    public function sendSms(){
        $sms = new SMS();
        try {
            $response = $sms->sendSMS(
                "Hello, this is a test SMS!",
                "01818077683"
            );
            if ($response){
                echo 'ok';
            }
        } catch (Exception $e) {
            // handle $e->getMessage();
        }

    }

    public function sendOpt(Request $request){
       $customer = Customer::where('phone',$request->phone)->first();
       if ($customer){
           if ($customer->phone  == $request->phone){
               $otp = rand(111111,999999);
               $customer->otp = $otp;
               $customer->save();
               $sms = new SMS();
               try {
                   // Send Single SMS
                   $response = $sms->sendSMS(
                       "Your DealPrime OTP is $otp",
                       "$request->phone"
//                   "01722736224"
                   );
                   if ($response){
                       return view('website.auth.check-otp', [
                            'otp' => $otp,
                        ]);  
                    //   return redirect(route('check.otp',['otp'=>$otp]));
                   }
               } catch (Exception $e) {
                   // handle $e->getMessage();
               }
           }
       }else{
//           Session::flash('message','This Number is not user create number');
           return back()->with('message','please use registered phone number');
       }

    }
}
