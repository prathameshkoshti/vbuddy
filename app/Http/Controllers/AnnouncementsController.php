<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        
        $announcement = new Announcement();
        $announcement->head = request('head');
        $announcement->body = request('body');
        $announcement->year = $year;
        $announcement->branch = $branch;
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
        if($announcement)
        {
            //$attachment = Storage::size('announcements/'.$announcement->file_name);
            $file_name = explode(',', $announcement->file_name);
            $original_filename = explode(',', $announcement->original_filename);
            return view('admin.announcements.view', compact('announcement', 'attachment', 'file_name', 'original_filename'));
        }
        else
            return view('errors.404');
    }

    public function download($id, $file_name)
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
