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

        $timetable=Timetable::where('branch','=',$branch)->where('sem','=',$semester)->where('division','=',$div)->orderBy('day')->get();
        return view('admin.timetable.view',compact('timetable'));

    }

    public function edit($id){
        $timetable=Timetable::find($id);
        return view('admin.timetable.edit',compact('timetable'));

    }

    public function update($id){

        $timetable=Timetable::find($id);

        $timetable->start_time = request('start_time');
        $timetable->end_time = request('end_time');
        $timetable->subject = request('subject');
        $timetable->teacher = request('teacher');
        $timetable->block = request('block');
        $timetable->save();

        \Session :: flash('update','Updated Successfully!');
        return redirect('/admin/timetable/');



        /*
        return view(dd($request));

        $j=$i;

        foreach($timetable as $lecture) {
            $timetable->start_time = $request->input('start_time.0');

            $timetable->end_time = $request->input['end_time'][$i];
            $timetable->subject = $request->input('subject.0');
            $timetable->teacher = $request->input('teacher.0');
            $timetable->block = $request->input('block.0');

        }
        $timetable->save();

        \Session :: flash('update','Updated Successfully!');
        return redirect('/admin/timetable/');


        //   return view(dd($request));

        //Code for single update button
        /*
         * $i=0;
        foreach($timetable as $lecture) {

            $lecture->start_time = $request->input('start_time[$i]');
            $lecture->end_time = $request->input('end_time.$i');
            $lecture->subject = $request->input['subject'][$i];
            $lecture->teacher = $request->input['teacher'][$i];
            $lecture->block = $request->input('block.$i');
            return view(dd($lecture));
            $i++;
        }
            for ($i=0; $i < count($input['teacher']); ++$i)
            {
                $timetable= new timetable;
                $timetable->start_time= $input['start_time'][$i];
                $timetable->end_time= $input['end_time'][$i];
                $timetable->subject= $input['subject'][$i];
                $timetable->teacher= $input['teacher'][$i];
                $timetable->block= $input['block'][$i];
                $timetable->save();
            }
            */





    }



}
