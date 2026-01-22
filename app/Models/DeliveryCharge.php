<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryCharge extends Model
{
    private static $deliveryCharge;

    public static function chargeInfo($request , $id=null) {
        if($id !=null){
            self::$deliveryCharge=DeliveryCharge::find($id);
            $request->validate([
                'location_name' => 'required|unique:delivery_charges,location_name,' . $id,
                'delivery_charge' => 'required',
            ]);
        }else{
            self::$deliveryCharge=new DeliveryCharge();
            $request->validate([
                'location_name'=>'required|unique:delivery_charges,location_name',
                'delivery_charge'=>'required',
            ]);
        }
        self::$deliveryCharge->location_name=$request->location_name;
        self::$deliveryCharge->delivery_charge=$request->delivery_charge;
        self::$deliveryCharge->status=$request->status;
        self::$deliveryCharge->save();
    }

    public static function deliveryChargeDelete($id){
        self::$deliveryCharge=DeliveryCharge::find($id)->delete();
    }

    public static function checkStatus($id)
    {
        self::$deliveryCharge= self::find($id);
        if (self::$deliveryCharge->status == 1){
            self::$deliveryCharge->status = 0;
        }
        else{
            self::$deliveryCharge->status = 1;
        }
        self::$deliveryCharge->save();

    }
}
