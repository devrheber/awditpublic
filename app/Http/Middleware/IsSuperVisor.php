<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperVisor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->user_role == 2) 
        {
            return $next($request);
        }
       return redirect('home')->with('error','You have not admin access');
        
    }
}
