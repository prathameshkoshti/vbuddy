<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Faculty
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
        if($request->user()->role != 'Faculty' || 
            $request->user()->role != 'Event Coordinator' ||
            $request->user()->role != 'Placement Coordinator'
        ){
            return redirect('404');
        }
        return $next($request);
    }
}
