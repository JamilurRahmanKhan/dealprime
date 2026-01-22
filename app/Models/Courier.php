<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    use HasFactory;

    private static $courier;

    public static function courierInfo($request , $id=null) {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'shipping_cost'=>'required',
        ]);
        if($id !=null){
            self::$courier=Courier::find($id);
        }else{
            self::$courier=new Courier();
        }
        self::$courier->name=$request->name;
        self::$courier->email=$request->email;
        self::$courier->mobile=$request->mobile;
        self::$courier->address=$request->address;
        self::$courier->shipping_cost=$request->shipping_cost;
        self::$courier->status=$request->status;
        self::$courier->save();
    }

    public static function checkStatus($id)
    {
        self::$courier= self::find($id);
        if (self::$courier->status == 1){
            self::$courier->status = 0;
        }
        else{
            self::$courier->status = 1;
        }
        self::$courier->save();

    }

    public static function courierDelete($id){
        self::$courier=Courier::find($id)->delete();
    }
}