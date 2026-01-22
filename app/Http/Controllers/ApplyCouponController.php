<?php

namespace App\Http\Controllers;

use Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\DiscountCoupon;


class ApplyCouponController extends Controller
{

    public function getCoupon(Request $request)
{
    $request->validate([
        'coupon_code' => 'required|string',
    ]);
    
    $couponCode = $request->coupon_code;
    $coupon = DiscountCoupon::where('code', $couponCode)
        ->where('status', 1)
        ->first();

    if (!$coupon) {
        return redirect()->back()->with('error', 'Invalid coupon code.');
    }

    // Check if the coupon is valid based on the current date
    $currentDate = Carbon::now();
    if ($currentDate < Carbon::parse($coupon->start_day) || $currentDate > Carbon::parse($coupon->end_day)) {
        return redirect()->back()->with('error', 'Coupon is expired or not valid yet.');
    }

    // Get cart total and remove any formatting to ensure it's a numeric value
    $cartTotal = floatval(preg_replace('/[^\d.]/', '', Cart::subtotal()));
    // return $coupon->cart_amount;

    // Check if the cart total meets the minimum requirement for the coupon
    if ($cartTotal < $coupon->cart_amount) { 
        
        // Use < instead of <= to avoid the issue
        return redirect()->back()->with('error', 'Minimum cart amount for this coupon is ' . $coupon->cart_amount);
    }

    // Initialize variables for the discount amount and new total
    $discountAmount = 0;
    $newTotal = $cartTotal;

    // Apply the discount based on the type of coupon
    if ($coupon->coupon_type == 'fixed') {
        // Fixed discount
        $discountAmount = $coupon->coupon_amount;
        $newTotal = $cartTotal - $discountAmount;
    } elseif ($coupon->coupon_type == 'percentage') {
        // Percentage discount
        $discountAmount = ($coupon->coupon_amount * $cartTotal) / 100;
        $newTotal = $cartTotal - $discountAmount;
    }

    // Ensure the new total doesn't go below zero
    if ($newTotal < 0) {
        $newTotal = 0;
    }

    // Calculate tax and shipping cost
    // $tax = $newTotal * 0.15;
    $shippingCost = $request->shipping_cost;
    $grandTotal = $newTotal  + $shippingCost;

    // Store the coupon details and the discount in the session
    session()->put('coupon', [
        'name' => $coupon->name,
        'code' => $coupon->code,
        'type' => $coupon->coupon_type,
        'amount' => $coupon->coupon_amount,
        'discount' => $discountAmount,
        'new_total' => $newTotal,
        // 'tax' => $tax,
        'shippingCost' => $shippingCost,
        'grand_total' => $grandTotal,
    ]); 
    return redirect()->back()->with('applied', 'Coupon applied successfully!');
}

public function removeCoupon(Request $request) {
    $cartCount = Cart::count();

    if ($cartCount == 0) {
        session()->forget('coupon');
        return redirect()->back()->with('success', 'Coupon removed automatically because your cart is empty.');
    }
    session()->forget('coupon');
    return redirect()->back()->with('success', 'Coupon removed successfully.');
}




}