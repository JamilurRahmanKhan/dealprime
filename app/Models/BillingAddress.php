<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    private static $address;


    public static function addressInfo($request ,$id=null){
       if($id!==null){

            self::$address = BillingAddress::find($id);
       }
       else{
        self::$address = new BillingAddress();
       }
       self::$address->customer_id=$request->customer_id;
       self::$address->name=$request->name;
       self::$address->email=$request->email;
       self::$address->phone=$request->phone;
       self::$address->country=$request->country;
       self::$address->zip_code=$request->zip_code;
       self::$address->delivery_address=$request->delivery_address;
       self::$address->save();
    }

    public static function addressDelete($id){
        self::$address=BillingAddress::find($id)->delete();
    }

}