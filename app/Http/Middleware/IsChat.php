<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsChat
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
        $user = Auth::user();
        if (Auth::check() && ($user->user_type == config("constants.user_type.company")
                || $user->user_type == config("constants.user_type.agent")
                || $user->user_type == config("constants.user_type.engineer")) ) {
            return $next($request);
        } else {
            session(['link' => url()->current()]);
            return redirect()->route('login');
        }
    }
}
