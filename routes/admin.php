<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogTagController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ComboProductController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\CourierDistrictController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\PopUpController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DiscountCouponController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PoliceStationController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOfferController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StockManagementController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubSubCategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\UnitController;



Route::middleware([ 'auth:sanctum',config('jetstream.auth_session'), 'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


    Route::resource('user', UserController::class);
    Route::resource('role', RoleController::class);


    Route::get('/get-subcategories/{categoryId}', [CategoryController::class, 'getSubcategories']);
    Route::get('/get-subsubcategories/{subcategoryId}', [CategoryController::class, 'getSubsubcategories']);
    Route::get('/get-colors/{categoryId}', [ProductController::class, 'getColors'])->name('get.colors');
    Route::get('/products/sort', [ProductController::class, 'sortByCategory'])->name('products.sortByCategory');
    Route::get('/product-comperison/{id}', [ProductController::class, 'productCompareEdit'])->name('products.productCompareEdit');



    Route::get('/products/status/{id}', [ProductController::class, 'productStatus'])->name('products.status');
    Route::get('/products_offers/status/{id}', [ProductOfferController::class, 'productOfferStatus'])->name('product_offer.status');
    Route::get('/blogs/status/{id}', [BlogController::class, 'blogStatus'])->name('blog.status');
    Route::get('/combo/status/{id}', [ComboProductController::class, 'comboStatus'])->name('combo_product.status');

    Route::get('/cache/clear', [SettingController::class, 'cacheClear'])->name('cache.clear');
    Route::get('/invoice/{id}', [OrderController::class, 'invoice'])->name('invoice');

    Route::get('/banner-positions', [BannerController::class, 'getBannerPositions'])->name('banner.positions');
    Route::get('/term-positions', [TermsController::class, 'getTermPositions'])->name('term.positions');

    Route::resource('categories', CategoryController::class);
    Route::resource('sub_categories', SubCategoryController::class);
    Route::resource('sub_subcategories', SubSubCategoryController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('units', UnitController::class);
    Route::resource('sizes', SizeController::class);
    Route::resource('colors', ColorController::class);
    Route::resource('products', ProductController::class);
    Route::resource('products_offers', ProductOfferController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('couriers', CourierController::class);
    Route::resource('settings', SettingController::class);
    Route::resource('tags', TagController::class);
    Route::resource('carousels', CarouselController::class);
    Route::resource('popups', PopUpController::class);
    Route::resource('blog_categories', BlogCategoryController::class);
    Route::resource('blog_tags', BlogTagController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('district', CourierDistrictController::class);
    Route::resource('coupon', DiscountCouponController::class);
    Route::resource('combo_product', ComboProductController::class);
    Route::resource('police_station', PoliceStationController::class);
    Route::resource('policy', PolicyController::class);
    Route::resource('banner', BannerController::class);
    Route::resource('contact_message', ContactMessageController::class);
    Route::resource('abouts', AboutController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('terms', TermsController::class);
    Route::resource('delivery_charge', DeliveryChargeController::class);


    Route::controller(StockManagementController::class)->group(function(){
    Route::get('/stock_manage',  'stockManage')->name('stock.index');
    Route::post('/stock_update/{id}',  'stockUpdate')->name('stock.update');

    });

    Route::controller(ReportController::class)->group(function(){
        Route::get('/sales_report',  'salesReport')->name('sales.report');
        Route::get('/daily/sales/report',  'dailySales')->name('daily.sales.report');
        Route::get('/monthly/sales/report',  'monthlySales')->name('monthly.sales.report');
    });
    Route::controller(AccountsController::class)->group(function(){
        Route::get('/merchant_payble',  'merchantPayble')->name('merchant.payble');
        Route::get('/merchant_pay',  'merchantPay')->name('merchant.pay.index');
        Route::get('/get_merchant_paid_amount',  'getMerchantPaidAmount')->name('merchant.paid.amount');
        Route::post('/merchant_pay/store',  'merchantPayStore')->name('merchant.pay.store');
    });
    Route::resource('customers', CustomerController::class);
});

Route::resource('rating',RatingController::class);


Route::get('/order/detail/{id}', [OrderController::class, 'orderDetail'])->name('order.detail');
