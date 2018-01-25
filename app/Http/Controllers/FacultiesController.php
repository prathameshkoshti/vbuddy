<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Announcement;
use \App\Placement;
use Auth;

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
        $user = Auth::user();
        $announcements = $user->announcements()->where('status', '1')->paginate();
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
        return redirect('/faculty/faculty_announcements/index');
    }

    public function announcementsEdit($id)
    {
        $announcement = Announcement::find($id);
        $year = explode(',', $announcement->year);
        $branch = explode(',', $announcement->branch);
        $division = explode(',', $announcement->division);
        return view('faculty.announcements.edit', compact('announcement', 'year', 'branch', 'division'));
    }

    public function announcementsUpdate(Request $request, $id)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'division' => 'required',
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

        $announcement->save();

        \Session :: flash('update','Updated Successfully!');
        return redirect('/faculty/faculty_announcements/index');
    }

    public function announcementsDestroy($id)
    {
        $announcement = Announcement::find($id);

        $announcement->status=0;
        $announcement->save();

        \Session::flash('delete', 'Deleted successfully.');
        return redirect('faculty/faculty_announcements/index');
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
            'issued_by' => request('issued_by'), 
        ]);

        \Session::flash('create', 'Data stored successfully.');
        return redirect('faculty/placements/index');

    }

    public function placementsEdit($id)
    {
        $placement = Placement::find($id);
        $year = explode(',', $placement->year);
        $branch = explode(',', $placement->branch);
        return view('faculty.placements.edit', compact('placement', 'year', 'branch'));
    }

    public function placementsUpdate(Request $request, $id)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
        ]);

        $placement = Placement::find($id);

        $year = implode(',', $request->get('year'));
        $branch = implode(',', $request->get('branch'));

        $placement->head = request('head');
        $placement->body = request('body');
        $placement->year = $year;
        $placement->branch = $branch;

        $placement->save();

        \Session :: flash('update','Updated Successfully!');
        return redirect('/faculty/placements/index');
    }

    public function placementsDestroy($id)
    {
        $placement = Placement::find($id);

        $placement->status = 0;
        $placement->save();

        \Session::flash('delete', 'Deleted successfully.');
        return redirect('faculty/placements/index');
    }
}
