<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;

class TimetablesController extends Controller
{
    
    public function index(){
        return view('admin.timetable.index');
    }

    public function view($branch,$semester,$div)
    {
        $timetable=Timetable::where('branch','=',$branch)->where('sem','=',$semester)->where('division','=',$div)->orderBy('day')->get();
        
        if($timetable)
            return view('admin.timetable.view',compact('timetable'));
        else
            return view('errors.404');
    }

    public function view_edit($branch,$semester,$div)
    {
        $timetable=Timetable::where('branch','=',$branch)->where('sem','=',$semester)->where('division','=',$div)->orderBy('day')->get();
        
        if($timetable)
            return view('admin.timetable.edit',compact('timetable'));
        else
            return view('errors.404');
    }

    public function edit($id)
    {
        $timetable=Timetable::find($id);

        if($timetable)
            return view('admin.timetable.update',compact('timetable'));
        else
            return view('errors.404');
    }

    public function update($id)
    {
        $timetable=Timetable::find($id);

        if($timetable)
        {
            $timetable->start_time = request('start_time');
            $timetable->end_time = request('end_time');
            $timetable->subject = request('subject');
            $timetable->teacher = request('teacher');
            $timetable->block = request('block');
            $timetable->save();

            \Session :: flash('update','Updated Successfully!');
            return redirect()->route('view_edit',[$timetable->branch,$timetable->sem,$timetable->division]);
        }
        else
        {
            return view('errors.404');
        }
    }

}
