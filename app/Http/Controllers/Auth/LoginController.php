<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;   

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = 'admin/home';

    protected function authenticated($request, $user)
    {
        if($user->role == 'Admin')
            return redirect()->intended('/admin/home');
        elseif($user->role == 'Faculty'
            || $user->role == 'Event Coordinator'
            || $user->role == 'Placement Coordinator'
            || $user->role == 'Academic Coordinator'
            || $user->role == 'Exam Coordinator'
        )
            return redirect()->intended('/faculty/home');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'studentLogout');
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/');
    }
}
