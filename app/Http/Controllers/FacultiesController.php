<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultiesController extends Controller
{
    public function home()
    {
        return view('faculty.home');
    }
}
