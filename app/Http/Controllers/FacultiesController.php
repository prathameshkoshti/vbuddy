<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Announcement;
use \App\Placement;
use \App\PlacementRegistration;
use \App\Event;
use \App\Student;
use \App\DeviceToken;
use Edujugon\PushNotification\PushNotification;
use \App\EventRegistration;
use Auth;
use Storage;
use File;
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
        $announcements = Announcement::latest()->paginate(10);
        if(count($announcements)>0)
            return view('faculty.announcements.index', compact('announcements'));
        else
            return view('errors.404');
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

        $announcement = new Announcement();
        $announcement->head = request('head');
        $announcement->body = request('body');
        $announcement->year = $year;
        $announcement->branch = Auth::user()->branch;
        $announcement->division = $division;
        $announcement->issued_by = request('issued_by');
        
        $file_name = array();
        $file_mime = array();
        $original_filename = array();

        if($request->hasFile('attachment'))
        {
            foreach($request->attachment as $file)
            {
                $extension = $file->getClientOriginalExtension();
                array_push($file_name, $file->getFilename().'.'.$extension);
                array_push($file_mime, $file->getClientMimeType());
                array_push($original_filename, $file->getClientOriginalName());
                Storage::put('announcements/'.$file->getFilename().'.'.$extension,  File::get($file));            
            }
            
            $announcement->file_name = implode(',', $file_name);
            $announcement->file_mime = implode(',', $file_mime);
            $announcement->original_filename = implode(',', $original_filename);
        }

        $announcement->save();    

        $devices = array();
        $result = array();

        foreach($request->year as $year)
        {
            foreach($request->division as $div)
            {
                $device = DeviceToken::where([
                    ['year', '=', $year],
                    ['branch', '=', Auth::user()->branch],
                    ['division', '=', $div],
                ])->pluck('token')->toArray();
                array_push($devices, $device);
            }
        }
        foreach ($devices as $key => $value) { 
            if (is_array($value)) { 
                $result = array_merge($result, array_flatten($value)); 
            } 
            else { 
                $result[$key] = $value; 
            } 
        }

        
        $push = new PushNotification('fcm');
        $response = $push->setMessage([
                    'notification' => [
                            'title' => $announcement->head,
                            'body' => $announcement->body,
                            'sound' => 'default'
                            ]
                    ])
                ->setDevicesToken($result)
                ->send();

        \Session::flash('create', 'Data stored successfully.');
        return redirect('/faculty/faculty_announcements/index');
    }

    public function announcementsShow($id)
    {
        $announcement = Announcement::find($id);

        if($announcement)
        {
            $attachment = array();
            $file = explode(',', $announcement->file_name);
            $size = 0;
            for($i=0; $i<count($file); $i++)
            {
                $bytes = Storage::size('announcements/'.$file[$i]);
                if ($bytes > 0)
                {
                    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                    $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
                    $size = number_format($bytes / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                }
                if($size)
                    array_push($attachment, $size);
            }
            $file_name = explode(',', $announcement->file_name);
            $original_filename = explode(',', $announcement->original_filename);
            return view('faculty.announcements.view', compact('announcement', 'attachment', 'file_name', 'original_filename'));
        }
        else
            return view('errors.404');
    }

    public function announcementsDownload($id, $file_name)
    {
        $announcement = Announcement::find($id);
        $filename = explode(',', $announcement->file_name);
        $filemime = explode(',', $announcement->file_mime);
        $original = explode(',', $announcement->original_filename);

        for($i=0; $i<count($filename); $i++)
        {
            if($file_name == $filename[$i])
            {
                $header = [
                    'Content-Type' => $filemime[$i],
                ];
                return response()->download(storage_path('app/announcements/'.$file_name), $original[$i], $header); 
            }
        }
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

            if($request->hasFile('attachment'))
            {
                $file_name = array();
                $file_mime = array();
                $original_filename = array();
                if($announcement->file_name)
                {
                    $file_name = explode(',', $announcement->file_name);
                    for($i=0; $i<count($file_name); $i++)
                    {
                        Storage::delete('announcements/'.$file_name[$i]);
                    }
                }
                $file_name = array();                
                foreach($request->attachment as $file)
                {
                    $extension = $file->getClientOriginalExtension();
                    array_push($file_name, $file->getFilename().'.'.$extension);
                    array_push($file_mime, $file->getClientMimeType());
                    array_push($original_filename, $file->getClientOriginalName());
                    Storage::put('announcements/'.$file->getFilename().'.'.$extension,  File::get($file));            
                }
                $announcement->file_name = implode(',', $file_name);
                $announcement->file_mime = implode(',', $file_mime);
                $announcement->original_filename = implode(',', $original_filename);
            }

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
        $placements = Placement::latest()->paginate(10);

        if(count($placements)>0)
            return view('faculty.placements.index', compact('placements'));
        else
            return view('errors.404');
    }

    public function placementsShow($id)
    {
        $placement = Placement::find($id);
        if($placement)
        {
            $attachment = array();
            $file = explode(',', $placement->file_name);
            $size = 0;
            for($i=0; $i<count($file); $i++)
            {
                $bytes = Storage::size('placements/'.$file[$i]);
                if ($bytes > 0)
                {
                    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                    $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
                    $size = number_format($bytes / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                }
                if($size)
                    array_push($attachment, $size);
            }
            $file_name = explode(',', $placement->file_name);
            $original_filename = explode(',', $placement->original_filename);
            return view('faculty.placements.view', compact('placement', 'attachment', 'file_name', 'original_filename'));
        }
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

        $placement = new Placement();
        $placement->head = request('head');
        $placement->body = request('body');
        $placement->date = request('date');
        $placement->year = $year;
        $placement->branch = $branch;
        $placement->issued_by = request('issued_by');

        $file_name = array();
        $file_mime = array();
        $original_filename = array();

        if($request->hasFile('attachment'))
        {
            foreach($request->attachment as $file)
            {
                $extension = $file->getClientOriginalExtension();
                array_push($file_name, $file->getFilename().'.'.$extension);
                array_push($file_mime, $file->getClientMimeType());
                array_push($original_filename, $file->getClientOriginalName());
                Storage::put('placements/'.$file->getFilename().'.'.$extension,  File::get($file));            
            }
            
            $placement->file_name = implode(',', $file_name);
            $placement->file_mime = implode(',', $file_mime);
            $placement->original_filename = implode(',', $original_filename);
        }

        $devices = array();
        $result = array();

        foreach($request->year as $year)
        {
            foreach($request->branch as $branch)
            {
                $device = DeviceToken::where([
                    ['year', '=', $year],
                    ['branch', '=', $branch],
                ])->pluck('token')->toArray();
                array_push($devices, $device);
            }
        }
        foreach ($devices as $key => $value) { 
            if (is_array($value)) { 
                $result = array_merge($result, array_flatten($value)); 
            } 
            else { 
                $result[$key] = $value; 
            } 
        }

        
        $push = new PushNotification('fcm');
        $response = $push->setMessage([
                    'notification' => [
                            'title' => $placement->head,
                            'body' => $placement->body,
                            'sound' => 'default'
                            ]
                    ])
                ->setDevicesToken($result)
                ->send();

        $placement->save();

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

            if($request->hasFile('attachment'))
            {
                $file_name = array();
                $file_mime = array();
                $original_filename = array();
                if($placement->file_name)
                {
                    $file_name = explode(',', $placement->file_name);
                    for($i=0; $i<count($file_name); $i++)
                    {
                        Storage::delete('placements/'.$file_name[$i]);
                    }
                }
                $file_name = array();                
                foreach($request->attachment as $file)
                {
                    $extension = $file->getClientOriginalExtension();
                    array_push($file_name, $file->getFilename().'.'.$extension);
                    array_push($file_mime, $file->getClientMimeType());
                    array_push($original_filename, $file->getClientOriginalName());
                    Storage::put('placements/'.$file->getFilename().'.'.$extension,  File::get($file));            
                }
                $placement->file_name = implode(',', $file_name);
                $placement->file_mime = implode(',', $file_mime);
                $placement->original_filename = implode(',', $original_filename);
            }

            $placement->save();

            \Session :: flash('update','Updated Successfully!');
            return redirect('/faculty/placements/index');
        }
        else
            return view('errors.404');
    }

    public function placementsDownload($id, $file_name)
    {
        $placement = Placement::find($id);
        $filename = explode(',', $placement->file_name);
        $filemime = explode(',', $placement->file_mime);
        $original = explode(',', $placement->original_filename);

        for($i=0; $i<count($filename); $i++)
        {
            if($file_name == $filename[$i])
            {
                $header = [
                    'Content-Type' => $filemime[$i],
                ];
                return response()->download(storage_path('app/placements/'.$file_name), $original[$i], $header); 
            }
        }
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

        if(count($placements)>0)
            return view('faculty.placement_registrations.index', compact('placements'));
        else
            return view('errors.404');
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
                            ->get();
                if(count($students)>0)
                    return view('faculty.placement_registrations.view', compact('students', 'count'));
                else
                    return view('errors.404');
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
        ])->latest()->paginate(10);
        if(count($events)>0)
            return view('faculty.events.index', compact('events'));
        else
            return view('errors.404');
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

        $event = new Event();
        $event->name = request('name');
        $event->details = request('details');
        $event->commitee_name = request('commitee_name');
        $event->year = $year;
        $event->branch = $branch;
        $event->date = request('date');
        $event->time = request('time');
        $event->location = request('location');
        $event->issued_by = request('issued_by');
        $event->price = request('price');
        $event->contact_name = request('contact_name');
        $event->contact_no = request('contact_no');

        $file_name = array();
        $file_mime = array();
        $original_filename = array();

        if($request->hasFile('attachment'))
        {
            foreach($request->attachment as $file)
            {
                $extension = $file->getClientOriginalExtension();
                array_push($file_name, $file->getFilename().'.'.$extension);
                array_push($file_mime, $file->getClientMimeType());
                array_push($original_filename, $file->getClientOriginalName());
                Storage::put('events/'.$file->getFilename().'.'.$extension,  File::get($file));            
            }
            
            $event->file_name = implode(',', $file_name);
            $event->file_mime = implode(',', $file_mime);
            $event->original_filename = implode(',', $original_filename);
        }

        $event->save();

        $devices = array();
        $result = array();

        foreach($request->year as $year)
        {
            foreach($request->branch as $branch)
            {
                $device = DeviceToken::where([
                    ['year', '=', $year],
                    ['branch', '=', $branch],
                ])->pluck('token')->toArray();
                array_push($devices, $device);
            }
        }
        foreach ($devices as $key => $value) { 
            if (is_array($value)) { 
                $result = array_merge($result, array_flatten($value)); 
            } 
            else { 
                $result[$key] = $value; 
            } 
        }

        
        $push = new PushNotification('fcm');
        $response = $push->setMessage([
                    'notification' => [
                            'title' => $event->name,
                            'body' => $event->details,
                            'sound' => 'default'
                            ]
                    ])
                ->setDevicesToken($result)
                ->send();

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
                return view('errors.401');  
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

            if($request->hasFile('attachment'))
            {
                $file_name = array();
                $file_mime = array();
                $original_filename = array();
                if($event->file_name)
                {
                    $file_name = explode(',', $event->file_name);
                    for($i=0; $i<count($file_name); $i++)
                    {
                        Storage::delete('events/'.$file_name[$i]);
                    }
                }
                $file_name = array();                
                foreach($request->attachment as $file)
                {
                    $extension = $file->getClientOriginalExtension();
                    array_push($file_name, $file->getFilename().'.'.$extension);
                    array_push($file_mime, $file->getClientMimeType());
                    array_push($original_filename, $file->getClientOriginalName());
                    Storage::put('events/'.$file->getFilename().'.'.$extension,  File::get($file));            
                }
                $event->file_name = implode(',', $file_name);
                $event->file_mime = implode(',', $file_mime);
                $event->original_filename = implode(',', $original_filename);
            }

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
            $attachment = array();
            $file = explode(',', $event->file_name);
            $size = 0;
            for($i=0; $i<count($file); $i++)
            {
                $bytes = Storage::size('events/'.$file[$i]);
                if ($bytes > 0)
                {
                    $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
                    $power = $bytes > 0 ? floor(log($bytes, 1024)) : 0;
                    $size = number_format($bytes / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
                }
                if($size)
                    array_push($attachment, $size);
            }
            $file_name = explode(',', $event->file_name);
            $original_filename = explode(',', $event->original_filename);
            return view('faculty.events.view', compact('event', 'attachment', 'file_name', 'original_filename'));
        }
        else
            return view('errors.404');
    }

    public function eventsDownload($id, $file_name)
    {
        $event = Event::find($id);
        $filename = explode(',', $event->file_name);
        $filemime = explode(',', $event->file_mime);
        $original = explode(',', $event->original_filename);

        for($i=0; $i<count($filename); $i++)
        {
            if($file_name == $filename[$i])
            {
                $header = [
                    'Content-Type' => $filemime[$i],
                ];
                return response()->download(storage_path('app/events/'.$file_name), $original[$i], $header); 
            }
        }
    }

    public function eventRegistrationsIndex()
    {
        $events = Event::withCount('event_registration')
                ->where([
                    ['status', '=', 1],
                    ['issued_by', '=', Auth::user()->id]
                ])->paginate(10);

        if(count($events)>0)
            return view('faculty.event_registrations.index', compact('events'));
        else
            return view('errors.404');
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
                            ->get();

                if(count($students)>0)
                    return view('faculty.event_registrations.view', compact('students', 'count'));
                else
                    return view('errors.404');
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
