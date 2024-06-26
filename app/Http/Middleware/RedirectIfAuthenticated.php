<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if($guard == "admin")
                {
                    //user was authenticated with admin guard.
                    return redirect(RouteServiceProvider::ADMINHOME);
                } 
                elseif($guard == "supplier")
                {
                    //user was authenticated with supplier guard.
                    return redirect(RouteServiceProvider::SUPPLIERHOME);
                }
                else 
                {
                    //default guard.
                    return redirect(RouteServiceProvider::HOME);
                }
            }

        return $next($request);
    }
}
