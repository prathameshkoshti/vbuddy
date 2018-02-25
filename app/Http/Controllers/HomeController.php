<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\EventRegistration;
use \App\Event;
use \App\User;
use Charts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::withCount('event_registration')->where('status', '=', 1)->get();

        $events_chart = Charts::create('bar', 'highcharts')
                ->title('Event registrations')
                ->elementLabel('No. of registrations')
                ->labels($events->pluck('name'))
                ->values($events->pluck('event_registration_count'))
                ->responsive(true)
                ->dimensions(0,400);

        $event = Event::where('status', '=', 1)->latest()->first();
        $user = User::find($event->issued_by);
        return view('/admin/home', ['events_chart' => $events_chart], compact('event', 'user'));
    }
}
