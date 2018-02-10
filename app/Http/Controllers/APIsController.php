<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
use App\Event;
use App\EventRegistration;
use App\Placement;
use App\Announcement;
use App\Student;
use Illuminate\Support\Facades\Hash;

class APIsController extends Controller
{
    public function login($email, $password)
    {
        $auth_user = Student::where('email', '=', $email)->first();
        if($auth_user && Hash::check($password, $auth_user->password))
        {
            return response()->json([
                'Profile' => $auth_user
            ], 200);
        }
        else
        {
            return response()->json([
                'STATUS'=> false,
                'MESSAGE'=>'Username or Password Incorrect.',
                'DATA' => null
            ], 200);
        }
    }

    public function holiday()
    {
        $holiday = Holiday::where('status', '=', '1')->get();
        return response()->json(['holiday' => $holiday], 200);
    }

    public function event($year, $branch, $commitee)
    {
        $events = Event::where([
            ['status', '=', '1'],
            ['commitee_name', '=', $commitee ],
            ])->get();
        $result = [];
        foreach($events as $event)
        {
            if(in_array($year,explode(',', $event->year)) && in_array($branch,explode(',', $event->branch)))
            {
                array_push($result, $event);
            }
        }
        return response()->json(['event' => $result], 200);
    }

    public function registerToEvent($event_id, $student_id)
    {
        $reg = EventRegistration::where([
            ['student_id', '=', $student_id],
            ['event_id', '=', $event_id],
        ])->first();
        if($reg)
        {
            return response()->json(['MESSAGE' => 'Do not worry! You are already in our list.'],200);
        }
        EventRegistration::Create([
            'event_id' => $event_id,
            'student_id' => $student_id,
        ]);
        return response()->json(['MESSAGE' => 'Registered Successfully'], 200);
    }

    public function placement($year, $branch)
    {
        $placements = Placement::where('status', '=', '1')->get();
        $result = [];
        foreach($placements as $placement)
        {
            if(in_array($year, explode(',', $placement->year)) && in_array($branch, explode(',', $placement->branch)))
            {
                array_push($result, $placement);
            }
        }
        return response()->json(['placement' => $result], 200);
    }

    public function placementView($year, $branch, $id)
    {
        $placement = Placement::where([
            ['status', '=', 1],
            ['id', '=', $id],
        ])->first();

        if($placement)
        {
            if(in_array($year, explode(',', $placement->year)) && in_array($branch, explode(',', $placement->branch)))
                return response()->json(['placement' => $placement], 200);
        }

        return response()->json(['placement' => 'Oops! Data not found'], 200);

    }

    public function announcement($year, $branch, $div)
    {
        $announcements = Announcement::where('status', '=', '1')->get();
        $result = [];
        foreach($announcements as $announcement)
        {
            if(in_array($year, explode(',', $announcement->year)) && in_array($branch, explode(',', $announcement->branch)) && in_array($div,explode(',', $announcement->division)))
            {
                array_push($result, $announcement);
            }
        }
        return response()->json(['announcement' => $result], 200);    
    }

    public function announcementView($year, $branch, $div, $id)
    {
        $announcement = Announcement::where([
            ['status', '=', 1],
            ['id', '=', $id],
        ])->first();
        
        if($announcement)
        {
            if(in_array($year, explode(',', $announcement->year)) && in_array($branch, explode(',', $announcement->branch)) && in_array($div,explode(',', $announcement->division)))
            {
                return response()->json(['announcement' => $announcement], 200);
            }
        }
        return response()->json(['announcement' => 'Oops! Data not found'], 200);
    }

}
