<?php

require __DIR__ . '/admin.php';

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompareController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ApplyCouponController;
use App\Http\Controllers\BillingAddressController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\MerchantAccountController;
use App\Http\Controllers\SmsController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\PathaoCourierController;
use App\Http\Controllers\OrderController;


Route::controller(HomeController::class)->group(function () {
    Route::get('/',  'home')->name('home');
    Route::get('/about',  'about')->name('about');
    Route::get('/faqs',  'faq')->name('faq');
    Route::get('/contact',  'contact')->name('contact');
    Route::get('/shop/{id}/{type?}', 'ShopProductList')->name('shop_product.list');
    Route::get('/product/details/{id}/{category_id?}',  'productItemDetails')->name('product_item.details');
    Route::get('/blog/{id}',  'blog')->name('blog');
    Route::get('/blog/details/{id}',  'blogDetails')->name('blog.details');

    Route::get('getSearchProductList',  'getSearchProductList');
    Route::post('searchProductByPrice',  'searchProductByPrice')->name('searchProductByPrice');
    Route::get('/order/track',  'orderTrack')->name('order.track');
    Route::get('searchOrderTracking',  'searchOrderTracking')->name('searchOrderTracking');
    Route::get('/store_list',  'storeList')->name('store.list');
    Route::get('/combo_products/{id}',  'comboProductDetails')->name('comboProduct.details');

    Route::get('/terms_and_condition',  'termsAndCondition')->name('terms.condition');
    Route::get('/termsType/{terms_type}/{user_type}',  'termsType')->name('termsType');


});


// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

Route::controller(CustomerAuthController::class)->group(function () {
    Route::middleware(['customer'])->group(function () {
        Route::get('/customer/dashboard',  'dashboard')->name('customer.dashboard');
        Route::get('/customer/logout',  'logout')->name('customer.logout');
        Route::get('/order/details/{id}',  'orderDetails')->name('order.details');

    });

    Route::get('/customer/login',  'customerLogin')->name('customer.login');
    // Route::get('/customer/register',  'customerRegister')->name('customer.register');
    Route::post('/info/store',  'infoStore')->name('info.store');
    Route::post('/info/check',  'infoCheck')->name('info.check');
    Route::post('/change/password',  'changePass')->name('change.password');

    Route::get('/forgot/password',  'forgotForm')->name('forgot.password');
    Route::post('/sent/link',  'sentLink')->name('sent.link');
    Route::get('/reset/form/{token}',  'resetForm')->name('password_reset.form');
});


Route::controller(WishlistController::class)->group(function () {
    Route::get('/wishlist',  'wishlist')->name('wishlist')->middleware('customer');
    Route::get('/wishlist/add/{customer_id?}/{product_id?}',  'wishlistAdd')->name('wishlist.add');
    Route::get('/wishlist/delete/{id}',  'wishlistDelete')->name('wishlist.delete');
    Route::post('/wishlist/delete-multiple',  'deleteMultiple')->name('wishlist.deleteMultiple');


});

Route::controller(CartController::class)->group(function () {
    Route::get('/cart/index',  'cart')->name('carts.index');
    Route::post('/cart/store',  'cartStore')->name('carts.store');
    Route::get('/cart/destroy',  'cartAllDestroy')->name('carts.destroy');
    Route::get('/cart/row-delete/{rowId}',  'cartRowDelete')->name('carts.rowDelete');
    Route::post('/update/qty/{rowId}',  'updateQty')->name('update.qty');


    Route::post('/combo_product_cart/store',  'ComboCartStore')->name('combo_carts.store');



});

Route::controller(CheckoutController::class)->group(function(){
    Route::get('/checkout',  'checkout')->name('checkout')->middleware('customer');
    Route::post('/new/order',  'newOrder')->name('new.order');
    Route::get('/get_policeStations',  'getPoliceStations')->name('get.policeStations');

    Route::get('/get/confirmation',  'getConfirmation')->name('get.confirmation');
    Route::get('/get/cancel',  'getCancel')->name('get.cancel');
    // combo order
//    Route::post('/new/combo/order',  'newOrder')->name('new.combo.order');
    Route::get('/get-shipping-cost',  'getShippingCost')->name('get.shipping.cost');

});

Route::controller(CompareController::class)->group(function(){
    Route::get('/compare',  'compare')->name('compare')->middleware('customer');
    Route::get('/compare/store/{customer_id}/{product_id}',  'compareStore')->name('compare.store');
    Route::post('/compare/delete/{id}',  'compareDelete')->name('compare.delete');

});
Route::controller(ApplyCouponController::class)->group(function(){
    Route::post('/get_coupon',  'getCoupon')->name('get.coupon')->middleware('customer');
    Route::post('/remove_coupon',  'removeCoupon')->name('remove.coupon');

});
Route::controller(MerchantAccountController::class)->group(function(){
    Route::get('/merchant_register',  'merchantRegister')->name('merchant.apply');
    Route::post('/merchant_store',  'merchantStore')->name('merchant.store');
    Route::get('/thanks_you',  'thanksYou')->name('thanks.you');

});

Route::controller(BillingAddressController::class)->group(function(){
    Route::post('/billing_address/store',  'billingAddressStore')->name('store.billing_address');
    Route::get('/billing_address/destroy/{id}',  'billingAddressDestroy')->name('destroy.billing_address');

});

Route::get('/sms/send', [SmsController::class, 'sendSms']);
Route::post('/send.opt', [SmsController::class, 'sendOpt'])->name('send.opt');
Route::get('/check/otp', [CustomerAuthController::class, 'checkOtpForm'])->name('check.otp');
Route::post('/check/otp', [CustomerAuthController::class, 'checkOtp'])->name('check.otp');
Route::post('/check/register/otp', [CustomerAuthController::class, 'checkRegisterOtp'])->name('check.register.otp');
Route::get('/customer/password', [CustomerAuthController::class, 'customerPasswordUpdateForm'])->name('customer.password');
Route::post('/customer/password', [CustomerAuthController::class, 'customerPasswordUpdate'])->name('customer.password.update');


//Pathao-api
Route::get('/admin/pathao/order/{orderId}', [PathaoCourierController::class, 'createOrder'])->name('admin.pathao.order');
Route::post('admin/pathao/order/{id}/place', [OrderController::class, 'placeOrder'])->name('admin.pathao.placeOrder');
Route::get('pathao/api/zones/{cityId}', [PathaoCourierController::class, 'getZonesByCity']);
Route::get('pathao/api/areas/{zoneId}', [PathaoCourierController::class, 'getAreasByZone']);
