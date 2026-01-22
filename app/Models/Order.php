<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order_detail;

class Order extends Model
{
    use HasFactory;

    private static $order;
    public static function newOrder($request)
    {
         //dd($request);
        $lastOrder = Order::orderBy('id', 'desc')->first();
        if ($lastOrder) {
            $newOrderNumber = intval($lastOrder->order_number) + 1;
        }else {
            $newOrderNumber = 1;
        }
        $formattedOrderNumber = str_pad($newOrderNumber, 5, '0', STR_PAD_LEFT);
        self::$order = new Order();
        self::$order->name = $request->name;
        self::$order->email = $request->email;
        self::$order->phone = $request->phone;
        self::$order->order_number = $formattedOrderNumber;
        self::$order->customer_id = $request->customer_id;
        self::$order->shipping_address = $request->delivery_address;
        self::$order->shipping_cost = $request->shipping_cost;
        self::$order->advance_payment = $request->advance_payment;
        self::$order->order_total = floatval($request->order_total);
        self::$order->payment_method = $request->payment_method;
        self::$order->order_date = $request->order_date;
        self::$order->post_code = $request->post_code;
        self::$order->country = $request->country;
        self::$order->save();
        return self::$order;
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function merchant_order()
    {
        return $this->belongsTo(Merchant_order::class);
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
    public function orderDetails()
    {
        return $this->hasMany(Order_detail::class, 'order_id'); // Assuming foreign key is order_id
    }




}
