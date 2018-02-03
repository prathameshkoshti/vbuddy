<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IATimetablesController extends Controller
{
    public function index()
    {
        return view('admin.ia_timetable.index');
    }
}
