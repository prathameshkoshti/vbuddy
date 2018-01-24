<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Announcement;

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::paginate(10);
        //dd($announcements);
        return view('admin.announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.announcements.create');
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

        Announcement::create([
            'head' => request('head'),
            'body' => request('body'),
            'year' => $year,
            'branch' => $branch,
            'division' => $division,
            'issued_by' => request('issued_by'), 
        ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $announcement = Announcement::find($id);
        $year = explode(',', $announcement->year);
        $branch = explode(',', $announcement->branch);
        $division = explode(',', $announcement->division);
        return view('admin.announcements.edit', compact('announcement', 'year', 'branch', 'division'));
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

        $year = implode(',', $request->get('year'));
        $branch = implode(',', $request->get('branch'));
        $division = implode(',', $request->get('division'));

        $announcement->head = request('head');
        $announcement->body = request('body');
        $announcement->year = $year;
        $announcement->branch = $branch;
        $announcement->division = $division;
        $announcement->issued_by = request('issued_by');

        $announcement->save();

        \Session :: flash('update','Updated Successfully!');
        return redirect('/admin/faculty_announcements/');
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

        $announcement->status=0;
        $announcement->save();

        \Session::flash('delete', 'Deleted successfully.');
        return redirect('admin/faculty_announcements/');
    }
}
