<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\EventRegistration;
use \App\Event;
use \App\Placement;
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

        $placements =Placement::withCount('placement_registration')->where('status', '=', 1)->get();

        $events_chart = Charts::create('bar', 'highcharts')
                ->title('Event registrations')
                ->elementLabel('No. of registrations')
                ->labels($events->pluck('name'))
                ->values($events->pluck('event_registration_count'))
                ->responsive(true)->legend(true);

        $placements_chart = Charts::create('pie', 'highcharts')
                ->title('Placement registrations')
                ->elementLabel('No. of registrations')
                ->labels($placements->pluck('head'))
                ->values($placements->pluck('placement_registration_count'))
                ->responsive(true)->legend(true);
        //dd($placements);

        $placement = Placement::withCount('placement_registration')->where('status', '=', 1)->latest()->first();
        $event = Event::withCount('event_registration')->where('status', '=', 1)->latest()->first();
        $user_event = User::find($event->issued_by);
        $user_placement = User::find($placement->issued_by);
        return view('/admin/home', ['events_chart' => $events_chart, 'placements_chart' => $placements_chart,], compact('event', 'placement', 'user_event', 'user_placement'));
    }
}
