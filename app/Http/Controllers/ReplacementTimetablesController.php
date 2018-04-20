<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timetable;
use App\User;
use App\ReplacementTimetable;
use Auth;

class ReplacementTimetablesController extends Controller
{
    public function index()
    {
        $replacement_timetables = ReplacementTimetable::latest()->get();
        // if(count($replacemet_timetables)>0)
            return view('admin.replacement_timetables.index', compact('replacement_timetables'));
        // else
        //     return redirect('404');
    }
    public function makeReplacement(Request $request)
    {
        $this->validate($request,[
            'date' => 'required',
            'sem' => 'required',
            'branch' => 'required',
            'division' => 'required',
        ]);
        $now = date('Y-m-d');
        $timestamp = strtotime($request->date);
        $day = date('l', $timestamp);
        if($day == 'Sunday' || $day == 'Saturday')
        {
            \Session::flash('delete', 'Please select the day other than '.$day);
            return redirect('admin/replacement_timetables');
        }
        if($now > $request->date)
        {
            \Session::flash('delete', 'Please enter proper date from '. $now);
            return redirect('admin/replacement_timetables');
        }
        $date = request('date');
        $sem = request('sem');
        $branch = request('branch');
        $division = request('division');
        $day = date('l', strtotime($date));
        if($day == 'SUNDAY' || $day == 'SATURDAY')
        {
            \Session::flash('update', 'Please Selecte proper date!');
            return redirect('admin/replacement_timetables');
        }
        else
        {
            $timetables = Timetable::where([
                ['day', '=', $day],
                ['sem', '=', request('sem')],
                ['branch', '=', request('branch')],
                ['division', '=', request('division')],
            ])->get();
            return view('admin.replacement_timetables.make_replacement', compact('timetables', 'date', 'day', 'sem', 'branch', 'division'));
        }
    }

    public function create($day, $date, $sem, $branch, $div, $subject)
    {
        $users = User::where([
            ['status', '=', 1],
            ['branch', '=', $branch],
        ])->get();
        
        $timetables = Timetable::where([
            ['day', '=', $day],
            ['sem', '=', $sem],
            ['branch', '=', $branch],
            ['division', '=', $div],
            ['subject', '=', $subject],
        ])->get();

        $now = date("Y-m-d H:i:s");            
        foreach($timetables as $timetable)
        {
            $time = $date.' '.$timetable->start_time;
            if($now > $time)
            {
                \Session::flash('update', 'Please select proper date!');
                return redirect('admin/replacement_timetables');
            }
        }
        return view('admin.replacement_timetables.create', compact('users', 'timetables', 'date'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject1' => 'required',
            'faculty1' => 'required',
        ]);
        $date = date("H i");
        dd($date);
        if($date)
        {
            
        }
        $replacement = ReplacementTimetable::where([
            ['date', '=', request('date')],
            ['replacement_id', '=', request('replacement_id1')],
            ['status', '=', 1],
        ])->first();
        if($replacement)
        {
            \Session::flash('update', 'Replacement already exist!');
            return redirect('/admin/replacement_timetables/');
        }
        ReplacementTimetable::create([
            'replacement_id' => request('replacement_id1'),
            'date' => request('date'),
            'replacement_faculty' => request('faculty1'),
            'replacement_subject' => request('subject1'),
            'issued_by' => Auth::user()->name,
        ]);
        if(request('subject2') != null)
        {
            ReplacementTimetable::create([
                'replacement_id' => request('replacement_id2'),
                'date' => request('date'),
                'replacement_faculty' => request('faculty2'),
                'replacement_subject' => request('subject2'),
                'issued_by' => Auth::user()->name,
            ]);
        }
        \Session::flash('create', 'Replacement Created');
        return redirect('/admin/replacement_timetables/');
    }

    public function edit($id)
    {
        $replacement = ReplacementTimetable::find($id);
        if($replacement)
        {   
            $timetable = Timetable::find($replacement->replacement_id);
            $users = User::where([
                ['status', '=', 1],
                ['branch', '=', $timetable->branch],
            ])->get();
            return view('admin.replacement_timetables.edit', compact('timetable', 'replacement', 'users'));
        }
        else
        {
            return view('errors.404');
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'replacement_subject' => 'required',
        ]);
        $replacement = ReplacementTimetable::find($id);
        if($replacement)
        {
            $replacement->replacement_subject = request('replacement_subject');
            $replacement->replacement_faculty = request('replacement_faculty');
            $replacement->save();

            \Session::flash('update', 'Updated Sucessfully!');
            return redirect('/admin/replacement_timetables/');
        }
        else
        {
            return view('errors.404');
        }
    }

    public function destroy($id)
    {
        $replacement = ReplacementTimetable::find($id);
        if($replacement)
        {
            $replacement->status = 0;
            $replacement->save();

            \Session::flash('delete', 'Deleted Successfully!');
            return redirect('/admin/replacement_timetables/');
        }
        else
        {
            return view('errors.404');
        }
    }
}
