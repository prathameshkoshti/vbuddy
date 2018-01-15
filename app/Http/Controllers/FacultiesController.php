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
        $userId = Auth::user()->id;
        $announcement = Announcement::where([
            ['status', '=', 1],
            ['issued_by', '=', $userId]
        ])->paginate();
        return view('faculty.announcements.index');
    }

    public function announcementsCreate()
    {
        return view('faculty.announcements.create');
    }

    public function announcementsStore()
    {

    }

    public function announcementsEdit($id)
    {
        $announcement = Announcement::find($id);
        return view('faculty.announcements.edit', compact('announcement'));
    }

    public function announcementsUpdate()
    {

    }

    public function announcementsDestroy()
    {

    }

    /*
        functions for placements
    */

    public function placementsHome()
    {
        
    }

    public function placementsIndex()
    {
        $id = Auth::user()->id;
        $placements = Placement::where('status', '=', 1)
                                ->where('issued_by', '=', Auth::user()->id)
                                ->paginate(10);

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
            'date' => request('date'),
            'issued_by' => request('issued_by'), 
        ]);

        \Session::flash('create', 'Data stored successfully.');
        return redirect('admin/placements/');

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

    }

    public function placementsDestroy()
    {

    }
}
