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
            return view('admin.events.view', compact('event', 'attachment', 'file_name', 'original_filename'));
        }
        else
            return view('errors.404');
    }

    public function download($id, $file_name)
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
