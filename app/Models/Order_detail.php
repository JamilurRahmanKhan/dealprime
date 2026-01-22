<?php

namespace App\Models;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use sms_net_bd\SMS;

class Order_detail extends Model
{
    use HasFactory;
    private static $orderDetail, $orderDetails,$product,$cproduct;

    public static function newOrderDetail($order,$request)
    {
//dd(Cart::content());
        foreach ($request->product_id as $index => $productId) {
//            dd($item->options);
            self::$orderDetail = new Order_detail();
            self::$orderDetail->order_id = $order->id;
            self::$orderDetail->product_id = $productId;
            self::$orderDetail->type = $request->type[$index];
            self::$orderDetail->merchant_id = $request->merchant_id[$index];
            self::$orderDetail->qty = $request->qty[$index];
            self::$orderDetail->color = $request->color[$index];
            self::$orderDetail->size = $request->size[$index];
//        $orderDetails->tax_total = $request->tax_total;
            self::$orderDetail->coupon_discount = $request->coupon_discount;
            self::$orderDetail->coupon_discount_amount = $request->coupon_discount_amount;
            self::$orderDetail->regular_price = $request->regular_price[$index] ?? 0;
            self::$orderDetail->selling_price = $request->price[$index] ?? 0;
            self::$orderDetail->save();

            self::$product = Product::find($productId);
            if (self::$product){
                self::$product->stock_amount = self::$product->stock_amount - $request->qty[$index];
                self::$product->save();
            }

            self::$cproduct = ComboProduct::find($productId);
            if (self::$cproduct) {
                self::$cproduct->stock_amount = self::$cproduct->stock_amount - $request->qty[$index];
                self::$cproduct->save();
            }
//            Cart::remove($item->rowId);
        }
        $uniqueMerchantIds = collect($request->merchant_id)->unique();
        foreach ($uniqueMerchantIds as $merchantId) {
            $merchantOrder = new Merchant_order();
            $merchantOrder->order_id =$order->id;
            $merchantOrder->merchant_id = $merchantId;
            $merchantOrder->save();
        }
        foreach (Cart::content() as $item) {
            Cart::remove($item->rowId);
        }
        
        $user_name = Auth::guard('customer')->user()->name;
        $user_phone = Auth::guard('customer')->user()->phone;
        $net_total = $order->order_total; 
        
        if($order->payment_method == 'cod' ){
        $sms = new SMS();
       try {
            $sms->sendSMS(
//            "Your DealPrime Order number is $order_number",
            "
Hi ! {$user_name}
Order Invoice:
Order ID: {$order->order_number}
Total Price: {$net_total} TK.

You can find more details on https://dealprime.com.bd

We received your order from DealPrime.Your order is under processing and will be delivered within the next 1 to 7 days.Thanks for being with DealPrime.
",
                "$user_phone"
            );
        } catch (Exception $e) {
            // handle $e->getMessage();
        }
        
    } 

    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
