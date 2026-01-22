<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Spatie\FlareClient\View;
use App\Models\BillingAddress;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class CustomerAuthController extends Controller
{
    public function dashboard()  { 
        $orders = Order::where('customer_id', Auth::guard('customer')->user()->id)
                ->with(['orderDetails' => function ($query) {
                    $query->select('order_id', 'coupon_discount_amount')->latest(); // Get the latest orderDetail only
                }])
                ->orderBy('id', 'desc')
                ->get();
        return view('website.auth.customer_dashboard.dashboard',[
            // 'orders'=>Order::where('customer_id',Auth::guard('customer')->user()->id)->orderby('id','desc')->get(),
            'orders' => $orders,
            'deliveryAddress'=>BillingAddress::where('customer_id',Auth::guard('customer')->user()->id)->get(),
        ]);
   }

   public function orderDetails($id)  {
    $comboProductresults = DB::table('orders')
        ->where('orders.id', $id)
        ->join('order_details', 'order_details.order_id', '=', 'orders.id')
        ->where( 'order_details.type', 'combo')
        ->join('combo_products', 'order_details.product_id', '=', 'combo_products.id')
        ->get();

    $productResults =  DB::table('orders')
        ->where('orders.id', $id)
        ->join('order_details', 'order_details.order_id', '=', 'orders.id')
        ->where( 'order_details.type', 'product')
        ->join('products', 'order_details.product_id', '=', 'products.id')
        ->get();
    
        return View('website.auth.order_details.details',[
            'orders'=>Order::find($id),
            'comboProductresults'=>$comboProductresults,
            'order_details'=>$productResults,
        ]);
   }
    public function customerLogin()  {
        return view('website.auth.customer_login');
   }
   public function customerRegister()  {
        return view('web.accounts.register');
   }


   public function infoStore(Request $request)  {
    //  return $request->all();
       $this->customer = Customer::infoStore($request);
       return view('website.auth.check-register-otp',[
           'otp' => $this->customer->otp
       ]);
   }

   public function infoCheck(Request $request)  {
        $customer = Customer::where('phone', $request->customer_phone)->first(); 
         if($customer ){
                    // Check if the customer is inactive
            if ($customer->status != 1) {
               return redirect()->back()->withErrors(['customer_password' => 'Your account is inactive. Please contact support.']);
            }
         }else{
                 
             return redirect()->back()->withErrors(['customer_password' => 'Your Phone number is not correct. Please try again.']);
            }
     
        $request->validate([
            'customer_phone' => 'required|exists:customers,phone',
            'customer_password' => 'required|min:8',
        ]);
        if (Auth::guard('customer')->attempt([
            'phone' => $request->customer_phone,
            'password' => $request->customer_password,
        ],$request->has('Remember_token'))) {
//            if (!session()->has('url.intended')) {
//                session(['url.intended' => url()->current()]);
//            }
            // dd(session('url.intended'));
            Session::flash('success','Login Successfully ');
            return redirect()->to(session('url.intended', route('dashboard')));
        }
        return back()->withErrors(['customer_password' => 'Incorrect Password. Please try again!'])->withInput();
   }
    public function authenticated(Request $request, $user)
    {
        dd(session('url.intended')); // Check if the intended URL is stored
    }
   public function logout()  {
        Auth::guard('customer')->logout();
        Session::flash('success','logout Successfully');
        return redirect()->route('home');
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'new_password.confirmed' => 'The new password and confirm password must match.',
        ]);

        $customer = Customer::find($request->customer_id);

        if (!$customer) {
            return redirect()->back()->withErrors(['customer_id' => 'Customer not found.']);
        }

        if (!Hash::check($request->password, $customer->password)) {
            return redirect()->back()->withErrors(['password' => 'Current password is incorrect.']);
        }

        $customer->password = Hash::make($request->new_password);
        $customer->save();

        Session::flash('success', 'Password updated successfully.');
        return redirect()->route('customer.dashboard');
    }


    public function forgotForm()  {
        return view('website.auth.forgot-password');
    }

    public function sentLink(Request $request)  {
        Customer::sentLink($request);
        Session::flash('success','Reset password link sent successfully');
        return back();
    }
    public function resetForm($token)  {
        return view('web.accounts.reset-form',[
            'token'=>$token,
        ]);
    }

    public function customerPasswordUpdateForm(){
        return view('website.auth.customer-login-update');
    }
    public function checkOtpForm(){

        return view('website.auth.check-otp');
    }
    public function checkOtp(Request $request){
        $customer = Customer::where('otp',$request->new_otp)->first();
       if($customer){
           if ($customer->otp == $request->new_otp){
               return redirect(route('customer.password',[
                   'customer_id' => $customer->id
               ]));
           }
       }else{
           return back()->with('message','Your otp is not correct');
       }
    }
    public function checkRegisterOtp(Request $request){
        $customer = Customer::where('otp',$request->new_otp)->first();
       if($customer){
           if ($customer->otp == $request->new_otp){
               Auth::guard('customer')->login($customer);
               return redirect()->route('home');
           }
       }else{
           return back()->with('message','Your otp is not correct');
       }
    }

    public function customerPasswordUpdate(Request $request){

        $request->validate([
            'update_password' => 'required|min:8',
            ]
        );

        $customer = Customer::find($request->customer_id);

        if (!$customer) {
            return redirect()->back()->withErrors(['error' => 'Customer not found.']);
        }else{
            $customer->password = Hash::make($request->update_password);
            $customer->save();
            Session::flash('success', 'Password updated successfully.');
//            Auth::guard('customer')->login($customer);
            return redirect()->route('customer.dashboard');

        }
    }




}
