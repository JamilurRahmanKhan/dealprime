<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MerchantAccountController extends Controller
{

    public function merchantRegister(){
        return view('website.merchant-apply.register');
    }
    public function thanksYou(){
        return view('website.merchant-apply.thank_you');
    }
    public function merchantStore(Request $request){
        // return $request->all();
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'phone'=>'required|min:11|unique:users,phone',
            'shop_name'=>'required',
        ]);
        $merchant=new User();
        $merchant->name=$request->name;
        $merchant->email=$request->email;
        $merchant->phone=$request->phone;
        $merchant->shop_name=$request->shop_name;
        $merchant->save();

        Session::flash('success','Thank you for your Partner Application');
        return redirect()->route('thanks.you');
    }
}