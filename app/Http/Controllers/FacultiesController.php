<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Announcement;
use \App\Placement;
use \App\PlacementRegistration;
use \App\Event;
use \App\EventRegistration;
use Auth;
use App\User;

class FacultiesController extends Controller
{
    public function home()
    {
        return view('faculty.home');
    }

    /*
        functions for announcements
    */
    public function announcementsHome()
    {
        return view('faculty.announcements.home');
    }

    public function announcementsIndex()
    {
        $announcements = Auth::user()->announcements()->paginate(10);
        return view('faculty.announcements.index', compact('announcements'));
    }

    public function announcementsCreate()
    {
        return view('faculty.announcements.create');
    }

    public function announcementsStore(Request $request)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'division' => 'required',
            'issued_by' => 'required',
        ]);

        $year = implode(',', $request->get('year'));
        $division = implode(',', $request->get('division'));

        Announcement::create([
            'head' => request('head'),
            'body' => request('body'),
            'year' => $year,
            'branch' => Auth::user()->branch,
            'division' => $division,
            'issued_by' => request('issued_by'), 
        ]);

        \Session::flash('create', 'Data stored successfully.');
        return redirect('/faculty/faculty_announcements/index');
    }

    public function announcementsShow($id)
    {
        $announcement = Announcement::find($id);

        if($announcement)
        {
            return view('faculty.announcements.view', compact('announcement'));
        }
        else
            return view('errors.404');
    }

    public function announcementsEdit($id)
    {
        $announcement = Announcement::find($id);
        if($announcement)
        {
            if(Auth::user()->id != $announcement->issued_by)
                return view('errors.401'); 
            $year = explode(',', $announcement->year);
            $division = explode(',', $announcement->division);
            return view('faculty.announcements.edit', compact('announcement', 'year', 'branch', 'division'));
        }
        else
            return view('errors.404');
    }

    public function announcementsUpdate(Request $request, $id)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'division' => 'required',
        ]);

        $announcement = Announcement::find($id);

        if($announcement)
        {
            if(Auth::user()->id != $announcement->issued_by)
                return view('errors.401'); 
            $year = implode(',', $request->get('year'));
            $division = implode(',', $request->get('division'));

            $announcement->head = request('head');
            $announcement->body = request('body');
            $announcement->year = $year;
            $announcement->division = $division;

            $announcement->save();

            \Session :: flash('update','Updated Successfully!');
            return redirect('/faculty/faculty_announcements/index');
        }
        else
            return view('errors.404');
    }

    public function announcementsDestroy($id)
    {
        $announcement = Announcement::find($id);
        if($announcement)
        {
            if(Auth::user()->id != $announcement->issued_by)
                return view('errors.401'); 

            $announcement->status=0;
            $announcement->save();

            \Session::flash('delete', 'Deleted successfully.');
            return redirect('faculty/faculty_announcements/index');
        }
        else
            return view('errors.404');
    }

    /*
        functions for placements
    */

    public function placementsHome()
    {
        return view('faculty.placements.home');
    }

    public function placementsIndex()
    {
        $user = Auth::user();
        $placements = $user->placements()->where('status', '1')->paginate(10);

        return view('faculty.placements.index', compact('placements'));
    }

    public function placementsShow($id)
    {
        $placement = Placement::find($id);
        if($placement)
            return view('faculty.placements.view', compact('placement'));
        else
            return view('errors.404');
    }

    public function placementsCreate()
    {
        return view('faculty.placements.create');
    }

    public function placementsStore(Request $request)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'issued_by' => 'required',
        ]);

        $year = implode(',', $request->get('year'));
        $branch = implode(',', $request->get('branch'));

        Placement::create([
            'head' => request('head'),
            'body' => request('body'),
            'year' => $year,
            'branch' => $branch,
            'date' => request('date'),
            'issued_by' => request('issued_by'), 
        ]);

        \Session::flash('create', 'Data stored successfully.');
        return redirect('faculty/placements/index');

    }

    public function placementsEdit($id)
    {
        $placement = Placement::find($id);
        if($placement)
        {
            if(Auth::user()->id != $placement->issued_by)
                return view('errors.401'); 
            $year = explode(',', $placement->year);
            $branch = explode(',', $placement->branch);
            return view('faculty.placements.edit', compact('placement', 'year', 'branch'));
        }
        else
            return view('errors.404');
    }

    public function placementsUpdate(Request $request, $id)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'date' => 'required',
        ]);

        $placement = Placement::find($id);

        if($placement)
        {
            if(Auth::user()->id != $placement->issued_by)
                return view('errors.401'); 
            $year = implode(',', $request->get('year'));
            $branch = implode(',', $request->get('branch'));

            $placement->head = request('head');
            $placement->body = request('body');
            $placement->year = $year;
            $placement->branch = $branch;
            $placement->date = request('date');

            $placement->save();

            \Session :: flash('update','Updated Successfully!');
            return redirect('/faculty/placements/index');
        }
        else
            return view('errors.404');
    }

    public function placementsDestroy($id)
    {
        $placement = Placement::find($id);
        if($placement)
        {
            if(Auth::user()->id != $placement->issued_by)
                return view('errors.401'); 

            $placement->status = 0;
            $placement->save();

            \Session::flash('delete', 'Deleted successfully.');
            return redirect('faculty/placements/index');
        }
        else
            return view('errors.404');
    }

    public function placementRegistrationsIndex()
    {
        $placements = Placement::withCount('placement_registration')
                    ->where([
                        ['status', '=', 1],
                        ['issued_by', '=', Auth::user()->id],
                    ])->paginate(10);

        return view('faculty.placement_registrations.index', compact('placements'));
    }

    public function placementRegistrationsShow($id)
    {
        $count = Placement::withCount('placement_registration')->find($id);
        if($count)
        {
            if($count->issued_by == Auth::user()->id)
            {
                $students = PlacementRegistration::with('student')
                            ->where('placement_id', '=', $id)
                            ->paginate(10);
                return view('faculty.placement_registrations.view', compact('students', 'count'));
            }
            else
            {
                return view('errors.401');
            }
        }
        else
        {
            return view('errors.404');
        }
    }

    public function eventsIndex()
    {
        $events = Event::withCount('event_registration')->where([
            ['status', '=', 1],
            ['issued_by', '=', Auth::user()->id ],
        ])->paginate(10);
        return view('faculty.events.index', compact('events'));
    }

    public function eventsStore(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required',
            'details' => 'required',
            'commitee_name' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'price' => 'required',
            'issued_by' => 'required',
            'contact_name' => 'required',
            'contact_no' => 'required',
        ]);

        $year = implode(',', $request->get('year'));
        $branch = implode(',', $request->get('branch'));

        Event::Create([
            'name' => request('name'),
            'details' => request('details'),
            'commitee_name' => request('commitee_name'),
            'year' => $year,
            'branch' => $branch,
            'date' => request('date'),
            'time' => request('time'),
            'location' => request('location'),
            'issued_by' => request('issued_by'),
            'price' => request('price'),
            'contact_name' => request('contact_name'),
            'contact_no' => request('contact_no'),
        ]);
        
        \Session::flash('create', 'Data stored successfully.');
        return redirect('faculty/events/index');
    }
    
    public function eventsEdit($id)
    {
        $event_coordinator = User::where([
            ['role', '=', 'Event Coordinator'],
            ['status', '=', 1],
        ])->get();
        $event = Event::find($id);

        if($event)
        {
            if(Auth::user()->id != $event->issued_by)
                return view('errors.404');  
            $year = explode(',', $event->year);
            $branch = explode(',', $event->branch);
            return view('faculty.events.edit', compact('event', 'year', 'branch', 'event_coordinator'));
        }
        else
            return view('errors.404');
    }

    public function eventsUpdate(Request $request, $id)
    {
        $this -> validate($request, [
            'name' => 'required',
            'details' => 'required',
            'commitee_name' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'date' => 'required',
            'time' => 'required',
            'location' => 'required',
            'price' => 'required',
            'contact_name' => 'required',
            'contact_no' => 'required',
        ]);

        $event = Event::find($id);          

        if($event)
        {
            if(Auth::user()->id != $event->issued_by)
                return view('errors.401');

            $year = implode(',', $request->get('year'));
            $branch = implode(',', $request->get('branch'));

            $event->name = request('name');
            $event->details = request('details');
            $event->commitee_name = request('commitee_name');
            $event->year = $year;
            $event->branch = $branch;
            $event->date = request('date');
            $event->time = request('time');
            $event->location = request('location');
            $event->price = request('price');
            $event->contact_name = request('contact_name');
            $event->contact_no = request('contact_no');

            $event->save();

            \Session :: flash('update','Updated Successfully!');
            return redirect('/faculty/events/index');
        }
        else
            return view('errors.404');
    }

    public function eventsDestroy($id)
    {
        $event = Event::find($id);

        if($event)
        {
            if(Auth::user()->id != $event->issued_by)
                return view('errors.401');

            $event->status = 0;
            $event->save();

            \Session::flash('delete', 'Deleted successfully.');
            return redirect('faculty/events/index');
        }
        else
            return view('errors.404');
    }

    public function eventsShow($id)
    {
        $event = Event::find($id);
        
        if($event)
        {
            if(Auth::user()->id != $event->issued_by)
                return view('errors.401');

            return view('faculty.events.view', compact('event'));
        }
        else
            return view('errors.404');
    }

    public function eventRegistrationsIndex()
    {
        $events = Event::withCount('event_registration')
                ->where([
                    ['status', '=', 1],
                    ['issued_by', '=', Auth::user()->id]
                ])->paginate(10);
        return view('faculty.event_registrations.index', compact('events'));
    }

    public function eventRegistrationsShow($id)
    {
        $count = Event::withCount('event_registration')->find($id); 
        if($count)
        {
            if($count->issued_by == Auth::user()->id)
            {
                $students = EventRegistration::with('student')
                            ->where('event_id', '=', $id)
                            ->paginate(20);
                return view('faculty.event_registrations.view', compact('students', 'count'));
            }
            else
            {
                return view('errors.401');
            }
        }
        else
        {
            return view('errors.404');
        }      
    }
}
