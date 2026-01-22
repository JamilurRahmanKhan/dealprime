<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillingAddress;
use Illuminate\Support\Facades\Session;

class BillingAddressController extends Controller
{
     public function billingAddressStore(Request $request){
        BillingAddress::addressInfo($request);
        Session::flash('success','Delivery address Store Successfully');
        return back();
     }
     public function billingAddressDestroy($id){
        BillingAddress::addressDelete($id);
        Session::flash('success','Delivery address Delete Successfully');
        return back();
     }
}