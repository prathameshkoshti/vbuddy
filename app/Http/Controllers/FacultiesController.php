<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FacultiesController extends Controller
{
    public function home()
    {
        return view('faculty.home');
    }

    public function announcemntsHome(){
        return view('faculty.announcements.home');
    }

    public function announcementsCreate(){
        return view('faculty.anniuncements.create');
    }
}
