<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsAgent
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
        if (Auth::check() && (Auth::user()->user_type == config("constants.user_type.agent")) ) {
            return $next($request);
        }
        else{
            session(['link' => url()->current()]);
            return redirect()->route('login');
        }
    }
}
