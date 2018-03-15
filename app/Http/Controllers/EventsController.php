<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use Storage;
use File;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('user')->latest()->paginate(10);
        if(count($events)>0)
            return view('admin.events.index', compact('events'));
        else
            return view('errors.404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event_coordinator = User::where([
            ['role', '=', 'Event Coordinator'],
            ['status', '=', 1],
        ])->get();

        return view('admin.events.create', compact('event_coordinator'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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

        if($request->hasFile('attachment'))
        {
            $attachment = $request->file('attachment');
            $extension = $attachment->getClientOriginalExtension();
            
            $event->file_name = $attachment->getFilename().'.'.$extension;
            $event->file_mime = $attachment->getClientMimeType();
            $event->original_filename = $attachment->getClientOriginalName();
            Storage::put('events/'.$attachment->getFilename().'.'.$extension,  File::get($attachment));
        }
        $event->save();
        
        \Session::flash('create', 'Data stored successfully.');
        return redirect('admin/events/');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::with('user')->find($id);
        if($event)
        {
            $attachment = Storage::size('events/'.$event->file_name);
            return view('admin.events.view', compact('event', 'attachment'));
        }
        else
            return view('errors.404');
    }

    public function download($file_name)
    {
        $event = Event::where('file_name', '=', $file_name)->first();
        $header = [
            'Content-Type' => $event->file_mime,
        ];
        return response()->download(storage_path('app/events/'.$file_name), $event->original_filename, $header); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event_coordinator = User::where([
            ['role', '=', 'Event Coordinator'],
            ['status', '=', 1],
        ])->get();
        $event = Event::find($id);
        if($event)
        {
            $year = explode(',', $event->year);
            $branch = explode(',', $event->branch);
            return view('admin.events.edit', compact('event', 'year', 'branch', 'event_coordinator'));
        }
        else{
            return view('errors.404');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        $event = Event::find($id);
        if($event)
        {
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
            $event->issued_by = request('issued_by');
            $event->price = request('price');
            $event->contact_name = request('contact_name');
            $event->contact_no = request('contact_no');

            if($request->hasFile('attachment'))
            {
                if($event->file_name)
                    Storage::delete('events/'.$event->file_name);
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                
                $event->file_name = $attachment->getFilename().'.'.$extension;
                $event->file_mime = $attachment->getClientMimeType();
                $event->original_filename = $attachment->getClientOriginalName();
                Storage::put('events/'.$attachment->getFilename().'.'.$extension,  File::get($attachment));
            }

            $event->save();

            \Session :: flash('update','Updated Successfully!');
            return redirect('/admin/events/');
        }
        else
        {
            return view('errors.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if($event)
        {
            $event->status = 0;
            $event->save();

            \Session::flash('delete', 'Deleted successfully.');
            return redirect('admin/events/');
        }
        else
        {
            return view('errors.404');
        }
    }
}
