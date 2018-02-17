<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;

class TimetablesController extends Controller
{
    //
    public function index(){
        return view('admin.timetable.index');
    }
    public function view($branch,$semester,$div){

        $timetable=Timetable::get()->where('branch','=',$branch)->where('sem','=',$semester)->where('division','=',$div);
        return view('admin.timetable.view',compact('timetable'));

    }
}
