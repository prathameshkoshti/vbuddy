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

    public function edit($id){
        $day=IATimetable::find($id);
        return view('admin.ia_timetable.edit',compact('day'));
    }
    public function update($id){
        $exam = IATimetable::find($id);
        $exam->date = request('date');
        $exam->start_time = request('start_time');
        $exam->end_time=request('end_time');
        $exam->subject=request('subject');
        $exam -> save();

        \Session :: flash('update','Updated Successfully!');
        return redirect('/admin/ia_timetable/');
    }


    public function findex()
    {
        return view('faculty.ia_timetables.index');
    }
    public function fview($branch,$id){
        $exam=IATimetable::get()->where('sem','=',$id)->where('branch','=',$branch);
        return view('faculty.ia_timetables.view',compact('exam'));

    }

    public function fedit($id){
        $day=IATimetable::find($id);
        return view('faculty.ia_timetables.edit',compact('day'));
    }
    public function fupdate($id){
        $exam = IATimetable::find($id);
        $exam->date = request('date');
        $exam->start_time = request('start_time');
        $exam->end_time=request('end_time');
        $exam->subject=request('subject');
        $exam -> save();

        \Session :: flash('update','Updated Successfully!');
        return redirect('/faculty/ia_timetables/');
    }

}
