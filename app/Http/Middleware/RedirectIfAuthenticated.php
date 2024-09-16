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
    public function handle($request, Closure $next,)
    {
        if(Auth::guard('web')->check()){
            return redirect(RouteServiceProvider::HOME);
        }

        if(Auth::guard('student')->check()){
            return redirect(RouteServiceProvider::STUDENT);
        }

        if(Auth::guard('teacher')->check()){
            return redirect(RouteServiceProvider::TEACHER);
        }

        if(Auth::guard('parent')->check()){
            return redirect(RouteServiceProvider::PARENT);
        }
        return $next($request);
    }
}
