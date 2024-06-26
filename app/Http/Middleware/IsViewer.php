<?php

namespace App\Http\Middleware;

use Closure;

class IsViewer
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
        if (Auth::user() &&  Auth::user()->user_role == 3) 
        {
            return $next($request);
        }
       return redirect('home')->with('error','You have not admin access');
    }
}
