<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\ComboProduct;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\DiscountCoupon;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public static $product;

    public function cart(){
       
        // return Cart::content();
        session(['url.intended' => url()->current()]);
        return view('website.cart.cart',[
            'products'=>Cart::content(),
        ]);
    }

    // for regullar product
    public function cartStore(Request $request) {
        if (session()->has('coupon')) {
            session()->forget('coupon');
        }
        $product = Product::find($request->product_id);

        if ($product->discount_amount !=null || $product->discount_amount > 0  ) {
            $price = $product->selling_price;
        }else{
            $price = $product->regular_price;
        }

        $sizeName = Size::find($request->size)->name ?? 'default';
        $colorName = Color::find($request->color)->name ?? 'default';

        $cartItem = Cart::content()->firstWhere('id', $request->product_id);
        $cartQty = $cartItem ? $cartItem->qty : 0;
        $newQty = $cartQty + $request->qty;
//        return $newQty;
        // if ( $product->stock_amount > 0) {
        if ( ($newQty > $product->stock_amount)) {
            Session::flash('stockOut', 'Product is out of stock. Please choose another product or reduce the quantity.');
            return back();
        } else{
            Cart::add([
                'id'      => $request->product_id,
                'name'    => $product->name,
                'qty'     => $request->qty,
                'price'   => $price,
                'weight'  => 0,
                'options' => [
                    'merchant_id'=>$product->merchant_id,
                    'image' => $product->image,
                    'code'  => $product->code,
                    'size'  =>$sizeName,
                    'color' => $colorName,
                    'regular_price' => $product->regular_price,
                    'type' => 'product',
                    'advance_pay' => $product->advance_pay,
                    'advance_pay_amount' => $product->advance_pay_amount,
                ],
            ]);
        }
        if ($request->has('buyNow')) {
            Session::flash('success', 'Product added to cart. Proceed to checkout.');
            return redirect()->route('checkout');
        } else {
            Session::flash('success', 'Cart product added successfully.');
            return back();
        }
    }


    // for combo products
    public function ComboCartStore(Request $request){
        if (session()->has('coupon')) {
            session()->forget('coupon');
        }
       $product = ComboProduct::find($request->combo_product_id);

        // Check stock availability
        $cartItem = Cart::content()->firstWhere('id', $request->combo_product_id);
        $cartQty = $cartItem ? $cartItem->qty : 0;
        $newQty = $cartQty + $request->qty;

        if ($newQty > $product->stock_amount) {
            Session::flash('stockOut', 'Product is out of stock. Please choose another product or reduce the quantity.');
            return back();
        }

        if($product->discount_amount !=null || $product->discount_amount  > 0 ){
            $price  = $product->selling_price;
        }else{
            $price = $product->regular_price;
        }
        Cart::add([
            'id'      => $product->id,
            'name'    => $product->name,
            'qty'     => $request->qty,
            'price'   => $price,
            'weight'  => 0,
            'options' => [
                'combo_p_id'=>$request->combo_product_id,
                'merchant_id'=>$product->merchant_id,
                'image' => $product->image,
                'code'  => $product->code,
                'size'  =>$request->size,
                'color' => $request->color,
                'regular_price' => $product->regular_price,
                'type' => 'combo',
            ],
        ]);
        if ($request->has('buyNow')) {
            Session::flash('success', 'Product added to cart. Proceed to checkout.');
            return redirect()->route('checkout');
        } else {
            Session::flash('success', 'Cart product added successfully.');
            return back();
        }
    }
    

    public function updateQty(Request $request, $id)
    {
        $product = Product::find($request->product_id);
        $cartItem = Cart::content()->firstWhere('id', $request->product_id);
        $cartQty = $cartItem->qty;
        $newQty = $cartQty + $request->qty;
        if ($newQty > $product->stock_amount) {
            Session::flash('stockOut', 'Product is out of stock. Please choose another product or reduce the quantity.');
            return back();
        }else{
            Cart::update($id, $request->qty);
            if (session()->has('coupon')) {
                $coupon = DiscountCoupon::select('cart_amount')->first();
                if ($coupon->cart_amount > Cart::subtotal() && $coupon->cart_amount !== Cart::subtotal()) {
                    session()->forget('coupon');
                }
            }
            if (session()->has('coupon')) {
                session()->forget(['grand_total', 'tax', 'shippingCost', 'new_total']);
                $cartTotal = floatval(preg_replace('/[^\d.]/', '', Cart::subtotal()));

                $coupon = session('coupon');
                $discountAmount = 0;
                $couponAmount = floatval($coupon['amount']);

                if ($coupon['type'] === 'percentage') {
                    if ($couponAmount >= 0 && $couponAmount <= 100) {
                        $discountAmount = ($cartTotal * $couponAmount) / 100;
                    } else {
                        $discountAmount = 0;
                    }
                } elseif ($coupon['type'] === 'fixed') {
                    $discountAmount = min($cartTotal, $couponAmount);
                }
                $newTotal = $cartTotal - $discountAmount;

                // $tax = $newTotal * 0.1;
                $shippingCost = 100;
                $grandTotal = $newTotal + $shippingCost;

                // Update the coupon session with new values
                session()->put('coupon', [
                    'name' => $coupon['name'],
                    'code' => $coupon['code'],
                    'type' => $coupon['type'],
                    'amount' => $couponAmount,
                    'discount' => $discountAmount,
                    'new_total' => $newTotal,
                    // 'tax' => $tax,
                    'shippingCost' => $shippingCost,
                    'grand_total' => $grandTotal,
                ]);
            }
            Session::flash('success','Cart Updated successfully');
            return back();
        }

    }

    public function cartRowDelete($rowId){
        Cart::remove($rowId);
        if (Cart::count() < 1) {
            Session()->forget('coupon');
        }
        if (session()->has('coupon')) {
            $coupon = DiscountCoupon::select('cart_amount')->first();
            if ($coupon->cart_amount > Cart::subtotal()) {
                session()->forget('coupon');
            }
        }

        if (session()->has('coupon')) {
            session()->forget(['grand_total', 'tax', 'shippingCost', 'new_total']);
            $cartTotal = floatval(preg_replace('/[^\d.]/', '', Cart::subtotal()));

            $coupon = session('coupon');
            $discountAmount = 0;
            $couponAmount = floatval($coupon['amount']);

            if ($coupon['type'] === 'percentage') {
                if ($couponAmount >= 0 && $couponAmount <= 100) {
                    $discountAmount = ($cartTotal * $couponAmount) / 100;
                } else {
                    $discountAmount = 0;
                }
            } elseif ($coupon['type'] === 'fixed') {
                $discountAmount = min($cartTotal, $couponAmount);
            }
            $newTotal = $cartTotal - $discountAmount;

            // $tax = $newTotal * 0.1;
            $shippingCost = 100;
            $grandTotal = $newTotal + $shippingCost;

            // Update the coupon session with new values
            session()->put('coupon', [
                'name' => $coupon['name'],
                'code' => $coupon['code'],
                'type' => $coupon['type'],
                'amount' => $couponAmount,
                'discount' => $discountAmount,
                'new_total' => $newTotal,
                // 'tax' => $tax,
                'shippingCost' => $shippingCost,
                'grand_total' => $grandTotal,
            ]);
        }

        Session::flash('success','Cart Item Delete successfully');
        return back();
    }

    public function cartAllDestroy(){
        Cart::destroy();
        session()->forget('coupon');
        Session::flash('success','Cart all item delete successfully');
        return redirect()->route('home');
    }
}
