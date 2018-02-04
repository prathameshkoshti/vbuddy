<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IATimetable;

class IATimetablesController extends Controller
{
    public function index()
    {
        return view('admin.ia_timetable.index');
    }

    public function view($branch,$id)
    {
        $exam=IATimetable::get()->where('sem','=',$id)->where('branch','=',$branch);
        return view('admin.ia_timetable.view',compact('exam'));
    }
}
