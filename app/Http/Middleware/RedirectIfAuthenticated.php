<?php

namespace App\Http\Middleware;

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
        switch($guard){
            case 'student':
                if(Auth::guard($guard)->check()){
                    return redirect('/student/home');
                }
                break;

            default :
                if (Auth::guard($guard)->check()) {
                    if(Auth::user()->role == 'Admin')
                        return redirect('/admin/home');
                    else
                        return redirect('/faculty/home');
                }
                break;
        }

        return $next($request);
    }
}
