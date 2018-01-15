<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultiesController extends Controller
{
    public function home()
    {
        return view('faculty.home');
    }

    /*
        functions for announcements
    */
    public function announcemntsHome()
    {
        return view('faculty.announcements.home');
    }

    public function announcemntsIndex()
    {
        return view('faculty.announcements.home');
    }

    public function announcementsCreate()
    {
        return view('faculty.announcements.create');
    }

    public function announcementsStore()
    {

    }

    public function announcementsEdit()
    {

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

    }

    public function placementsUpdate()
    {

    }

    public function placementsDestroy()
    {

    }
}
