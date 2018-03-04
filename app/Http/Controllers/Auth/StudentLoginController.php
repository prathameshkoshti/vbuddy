<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class StudentLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'sudentLogout']);
    }

    public function showLoginForm()
    {
        return view('auth.student_login');
    }

    public function login(Request $request)
    {
        //validate the login data
        $this->validate($request, [
           'email' => 'required|email',
           'password' => 'required', 
        ]);

        //attempt to log user in
        if(Auth::guard('student')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember))
        {
            //if successful
            return redirect()->intended('/student/home');
        }
        else
        {
            return redirect()->back()->withInput($request->only('email', 'remember'));
        }
    }

    public function studentLogout()
    {
        Auth::guard('student')->logout();
        return redirect('/');
    }
}
