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
        $userId = Auth::user()->id;
        $placement = Placement::where([
            ['status', '=', 1],
            ['issued_by', '=', $userId]
        ]);

        return view('faculty.placement.index');
    }

    public function placementsCreate()
    {
        return view('faculty.placements.create');
    }

    public function placementsStore()
    {

    }

    public function placementsEdit()
    {
        $placement = Placement::find($id);
        return view('faculty.placements.edit', compact('placement'));
    }

    public function placementsUpdate()
    {

    }

    public function placementsDestroy()
    {

    }
}
