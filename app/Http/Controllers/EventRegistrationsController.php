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
        $events = Event::withCount('event_registration')->where('status', '=', 1)->paginate(10);
        return view('admin.event_registrations.index', compact('events'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = EventRegistration::with('student')->where('event_id', '=', $id)->paginate(20);
        $count = Event::withCount('event_registration')->find($id);        
        return view('admin.event_registrations.view', compact('students', 'count'));
    }

}
