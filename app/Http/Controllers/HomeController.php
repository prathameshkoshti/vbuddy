<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\EventRegistration;
use \App\Event;
use \App\Placement;
use \App\Feedback;
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
        $feedbacks = array();
        $counts = array();
        $branch = ['INFT', 'CMPN', 'EXTC', 'ETRX', 'BIOM'];
        for($i=0; $i<sizeof($branch); $i++)
        {
            for($j=1; $j<=8; $j++)
            {
                $count = Feedback::where([
                    ['branch', '=', $branch[$i]],
                    ['sem', '=', $j],
                ])->count();
                array_push($counts, $count);
            }
            $feedbacks[$branch[$i]] = $counts;
            unset($counts);
            $counts = array();
        }
        //dd($feedbacks['INFT']);
        $events = Event::withCount('event_registration')->where('status', '=', 1)->take(5)->get();

        $placements =Placement::withCount('placement_registration')->where('status', '=', 1)->take(5)->latest()->get();

        $events_chart = Charts::create('bar', 'highcharts')
                ->title('Event registrations')
                ->elementLabel('No. of registrations')
                ->labels($events->pluck('name'))
                ->values($events->pluck('event_registration_count'))
                ->responsive(true)->legend(true);

        $placements_chart = Charts::create('pie', 'highcharts')
                ->title('Placement registrations')
                ->height(200)
                ->elementLabel('No. of registrations')
                ->labels($placements->pluck('head'))
                ->values($placements->pluck('placement_registration_count'))
                ->responsive(true)->legend(true);

        $feedbacks_chart = Charts::multi('area', 'highcharts')
                ->title('Feedbacks Stats')
                ->responsive(true)
                ->labels(['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4', 'Sem 5', 'Sem 6', 'Sem 7', 'Sem 8'])
                ->dataset('INFT', $feedbacks['INFT'])
                ->dataset('CMPN', $feedbacks['CMPN'])
                ->dataset('EXTC', $feedbacks['EXTC'])
                ->dataset('ETRX', $feedbacks['ETRX'])
                ->dataset('BIOM', $feedbacks['BIOM']);

        $placement = Placement::withCount('placement_registration')->where('status', '=', 1)->latest()->first();
        $event = Event::withCount('event_registration')->where('status', '=', 1)->latest()->first();
        $user_event = User::find($event->issued_by);
        $user_placement = User::find($placement->issued_by);
        return view('/admin/home', ['events_chart' => $events_chart, 'placements_chart' => $placements_chart, 'feedbacks_chart' => $feedbacks_chart, ], compact('event', 'placement', 'user_event', 'user_placement'));
    }
}
