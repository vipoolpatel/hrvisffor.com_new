<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class SchoolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            if (Auth::user()->is_admin == 3) {
                return $next($request);
            } else {
                Auth::logout();
                return redirect(url('login'));
            }
        } else {
            Auth::logout();
            return redirect(url('login'));
        }
    }
}
