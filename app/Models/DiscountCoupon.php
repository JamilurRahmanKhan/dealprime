<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountCoupon extends Model
{
    use HasFactory;

    private static $coupon;

    public static function couponInfo($request,$id=null){
        if ($id != null){
            $request->validate([
                'name' => 'required',
                'code' => 'required|unique:discount_coupons,code,' . $id,
                'coupon_type' => 'required',
                'coupon_amount' => 'required',
                'cart_amount' => 'required',
                'start_day' => 'required',
                'end_day' => 'required',
            ]);
            self::$coupon=DiscountCoupon::find($id);
        }
        else{
            self::$coupon=new DiscountCoupon();
            $request->validate([
                'name' => 'required',
                'code' => 'required|unique:discount_coupons,code',
                'coupon_type' => 'required',
                'coupon_amount' => 'required',
                'cart_amount' => 'required',
                'start_day' => 'required',
                'end_day' => 'required',
            ]);
        }
        self::$coupon->name=$request->name;
        self::$coupon->code=$request->code;
        self::$coupon->coupon_type=$request->coupon_type;
        self::$coupon->coupon_amount=$request->coupon_amount;
        self::$coupon->cart_amount=$request->cart_amount;
        self::$coupon->start_day=$request->start_day;
        self::$coupon->end_day=$request->end_day;
        self::$coupon->status=$request->status;
        self::$coupon->save();
    }

    public static function couponDelete($id){
        self::$coupon=DiscountCoupon::find($id);
            self::$coupon->delete();
    }

    public static function checkStatus($id)
    {
        self::$coupon= self::find($id);
        if (self::$coupon->status == 1){
            self::$coupon->status = 0;
        }
        else{
            self::$coupon->status = 1;
        }
        self::$coupon->save();
    }
}