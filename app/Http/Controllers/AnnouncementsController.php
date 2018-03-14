<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Announcement;
use App\User;
use Storage;
use File;

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::with('user')->latest()->paginate(10);
        if(count($announcements)>0)
            return view('admin.announcements.index', compact('announcements'));
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
        $users = User::where('status', '1')->get();
        return view('admin.announcements.create', compact('users'));
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
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'division' => 'required',
            'issued_by' => 'required',
        ]);
        $year = implode(',', $request->get('year'));
        $branch = implode(',', $request->get('branch'));
        $division = implode(',', $request->get('division'));
                 
        // Announcement::create([
        //     'head' => request('head'),
        //     'body' => request('body'),
        //     'year' => $year,
        //     'branch' => $branch,
        //     'division' => $division,
        //     'issued_by' => request('issued_by'), 
        // ]);
        $announcement = new Announcement();
        $announcement->head = request('head');
        $announcement->body = request('body');
        $announcement->year = $year;
        $announcement->branch = $branch;
        $announcement->division = $division;
        $announcement->issued_by = request('issued_by');
        if($request->hasFile('attachment'))
        {
            $attachment = $request->file('attachment');
            $extension = $attachment->getClientOriginalExtension();
            
            $announcement->file_name = $attachment->getFilename().'.'.$extension;
            $announcement->file_mime = $attachment->getClientMimeType();
            $announcement->original_filename = $attachment->getClientOriginalName();
            Storage::put('announcements/'.$attachment->getFilename().'.'.$extension,  File::get($attachment));
        }
        
        $announcement->save();

        \Session::flash('create', 'Data stored successfully.');
        return redirect('/admin/faculty_announcements');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $announcement = Announcement::with('user')->find($id);
        $attachment = Storage::size('announcements/'.$announcement->file_name);
        if($announcement)
            return view('admin.announcements.view', compact('announcement', 'attachment'));
        else
            return view('errors.404');
    }

    public function download($file_name)
    {
        return Storage::download('announcements/'.$file_name);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::where('status', '1')->get();
        $announcement = Announcement::find($id);
        if($announcement)
        {
            $issued_by = $announcement->issued_by;
            $year = explode(',', $announcement->year);
            $branch = explode(',', $announcement->branch);
            $division = explode(',', $announcement->division);
            return view('admin.announcements.edit', compact('announcement', 'year', 'branch', 'division', 'users', 'issued_by'));    
        }
        else
        {
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
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'division' => 'required',
            'issued_by' => 'required',
        ]);

        $announcement = Announcement::find($id);
        
        if($announcement)
        {
            $year = implode(',', $request->get('year'));
            $branch = implode(',', $request->get('branch'));
            $division = implode(',', $request->get('division'));

            $announcement->head = request('head');
            $announcement->body = request('body');
            $announcement->year = $year;
            $announcement->branch = $branch;
            $announcement->division = $division;
            $announcement->issued_by = request('issued_by');

            if($request->hasFile('attachment'))
            {
                Storage::delete('announcements/'.$announcement->file_name);
                $attachment = $request->file('attachment');
                $extension = $attachment->getClientOriginalExtension();
                
                $announcement->file_name = $attachment->getFilename().'.'.$extension;
                $announcement->file_mime = $attachment->getClientMimeType();
                $announcement->original_filename = $attachment->getClientOriginalName();
                Storage::put('announcements/'.$attachment->getFilename().'.'.$extension,  File::get($attachment));
            }

            $announcement->save();

            \Session :: flash('update','Updated Successfully!');
            return redirect('/admin/faculty_announcements/');
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
        $announcement = Announcement::find($id);

        if($announcement)
        {
            $announcement->status=0;
            $announcement->save();

            \Session::flash('delete', 'Deleted successfully.');
            return redirect('admin/faculty_announcements/');
        }
        else
        {
            return view('errors.view');
        }
    }
}
