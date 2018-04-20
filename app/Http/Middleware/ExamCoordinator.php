<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ExamCoordinator
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
        if($request->user()->role != 'Exam Coordinator'){
            return redirect('401');
        }
        return $next($request);
    }
}
