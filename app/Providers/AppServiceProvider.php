<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Category;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['website.layouts.master'],function ($view){
            $view->with('categories',Category::where('status',1)->get());
            $view->with('wishlistCount',Wishlist::where('customer_id',Auth::guard('customer')->id())->count());
            $view->with('setting',Setting::first());
        });
    }
}
