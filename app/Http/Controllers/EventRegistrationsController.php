<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventRegistration;

class EventRegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::withCount('event_registration')
                ->where('status', '=', 1)
                ->paginate(10);
        if(count($events)>0)
            return view('admin.event_registrations.index', compact('events'));
        else
            return view('errors.404');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = EventRegistration::with('student')
                    ->where('event_id', '=', $id)->get();
        $count = Event::withCount('event_registration')->find($id);
        if($count && $students)       
            return view('admin.event_registrations.view', compact('students', 'count'));
        else
            return view('errors.404');
    }

}
