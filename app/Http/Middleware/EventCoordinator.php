<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class EventCoordinator
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
        if(!Auth::user()){
            return redirect('login');
        }
        if($request->user()->role != 'Event Coordinator'){
            return redirect('404');
        }
        return $next($request);
    }
}
