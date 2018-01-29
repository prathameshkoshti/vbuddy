<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
use App\Event;
use App\Placement;
use App\Announcement;
class APIsController extends Controller
{
    public function holiday()
    {
        $holiday = Holiday::where('status', '=', '1')->get();
        return response()->json(['holiday'=>$holiday],200);
    }

    public function event()
    {
        $event = Event::where('status', '=', '1')->get();
        return response()->json(['event'=>$event],200);
    }

    public function placement($year, $branch)
    {
        $placements = Placement::where('status', '=', '1')->get();
        $result = [];
        foreach($placements as $placement)
        {
            if(in_array($year,explode(',', $placement->year)) && in_array($branch,explode(',', $placement->branch)))
            {
                array_push($result, $placement);
            }
        }
        return response()->json(['placement'=>$placement],200);
        
    }

    public function announcement($year, $branch)
    {
        $announcements = Announcement::where('status', '=', '1')->get();
        $result = [];
        foreach($announcements as $announcement)
        {
            if(in_array($year,explode(',', $announcement->year)) && in_array($branch,explode(',', $announcement->branch)))
            {
                array_push($result, $announcement);
            }
        }
        return response()->json(['announcement'=>$result],200);
        
    }

}
