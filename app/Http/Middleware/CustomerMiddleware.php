<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(!Auth::guard('customer')->check()){
        //     Session::flash('success',' Please Login First');
        //     return redirect()->route('customer.login');
        // }
        
            // if (!$request->is('login') && !$request->is('register') && !$request->is('password/*')) {
            //     session(['url.intended' => url()->full()]); // Correct previous URL store koro
            // }


        if(!Auth::guard('customer')->check()){
             if (!$request->is('login') && !$request->is('register') && !$request->is('password/*')) {
                session(['url.intended' => url()->full()]); // Correct previous URL store koro
            }

            Session::flash('success',' Please Login First');
            return redirect()->guest(route('customer.login'));
        }
        return $next($request);
    }
}