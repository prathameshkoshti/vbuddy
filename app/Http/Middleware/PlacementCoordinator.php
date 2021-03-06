<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class PlacementCoordinator
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
        if($request->user()->role != 'Placement Coordinator'){
            return redirect('401');
        }
        return $next($request);
    }
}
