<?php

namespace App\Http\Middleware;

use Closure;    
use Auth;

class IsAdministration
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
        if (Auth::user() &&  Auth::user()->user_role == 1) 
        {
            return $next($request);
        }
       return redirect('home')->with('error','You have not admin access');
    }
}
