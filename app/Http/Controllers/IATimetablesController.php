<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\IATimetable;

class IATimetablesController extends Controller
{
    public function index()
    {
        return view('admin.ia_timetables.index');
    }

    public function view($branch, $sem)
    {
        $exam = IATimetable::where([
            ['sem', '=', $sem],
            ['branch', '=', $branch],
            ])->get();
        if(count($exam)>0){
            return view('admin.ia_timetables.view',compact('exam'));
        }
        else{
            return view('errors.404');
        }
    }
    public function edit($id){
        $day = IATimetable::find($id);
        if($day)
            return view('admin.ia_timetables.edit',compact('day'));
        else
            return view('errors.404');
    }
    public function update($id){
        $exam = IATimetable::find($id);
        if($exam)
        {
            $exam->date = request('date');
            $exam->start_time = request('start_time');
            $exam->end_time=request('end_time');
            $exam->subject=strtoupper(request('subject'))   ;
            $exam -> save();

            \Session :: flash('update','Updated Successfully!');

            return redirect('admin/ia_timetables/view/'.$exam->branch.'/'.$exam->sem);
        }
        else
            return view('errors.404');
    }


    public function findex()
    {
        return view('faculty.ia_timetables.index');
    }
    public function fview($branch,$id){
        $exam = IATimetable::get()->where('sem', '=', $id)->where('branch', '=', $branch);
        if(count($exam)>0){
            return view('faculty.ia_timetables.view',compact('exam'));
        }
        else{
            return redirect('404');
        }

    }

    public function fedit($id){
        $day = IATimetable::find($id);
        if($day)
            return view('faculty.ia_timetables.edit',compact('day'));
        else
            return view('errors.404');
    }
    public function fupdate($id){
        $exam = IATimetable::find($id);
        
        if($exam)
        {
            $exam->date = request('date');
            $exam->start_time = request('start_time');
            $exam->end_time=request('end_time');
            $exam->subject=strtoupper(request('subject'));
            $exam -> save();

            \Session :: flash('update','Updated Successfully!');
            return redirect()->route('view_faculty_ia_timetable',[$exam->branch,$exam->sem]);
        }
        else
            return view('errors.404');
    }

}
