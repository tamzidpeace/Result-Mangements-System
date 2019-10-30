<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function redirectTo($request)
    {
        if(substr($request->path(),0,5)=='admin'){
            if(!\Auth::guard('admin')->check()) return route('adminlogin');
            return $next($request);
        }
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
