<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
use App\Event;
use App\EventRegistration;
use App\Placement;
use App\Announcement;
use App\Student;
use App\IATimetable;
use App\Timetable;
use App\Feedback;
use Illuminate\Support\Facades\Hash;

class APIsController extends Controller
{
    public function login($email, $password)
    {
        $auth_user = Student::where('email', '=', $email)->first();
        if($auth_user && Hash::check($password, $auth_user->password))
        {
            return response()->json([
                'MESSAGE' => 'Login Successful.',
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
            if(in_array($year, explode(',', $event->year)) && in_array($branch, explode(',', $event->branch)))
            {
                array_push($result, $event);
            }
        }
        return response()->json(['events' => $result], 200);
    }

    public function viewEvent($year, $branch, $commitee, $id)
    {
        $event = Event::where([
            ['status', '=', '1'],
            ['commitee_name', '=', $commitee ],
            ['id', '=', $id]
        ])->first();

        if(in_array($year, explode(',', $event->year)) && in_array($branch, explode(',', $event->branch)))
        {
            return response()->json(['event' => $event], 200);
        }

        return response()->json(['event' => 'Oops! Data not found.']);
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

    public function viewPlacement($year, $branch, $id)
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

    public function viewAnnouncement($year, $branch, $div, $id)
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

    public function viewIATimetable($branch, $sem)
    {
        $ia_timetable = IATimetable::where([
            ['branch', '=', $branch],
            ['sem', '=', $sem]      
        ])->get();

        return response()->json(['ia_timetable' => $ia_timetable], 200);
    }

    public function viewTimetable($sem, $branch, $division, $day)
    {
        $timetable = Timetable::where([
            ['sem', '=', $sem],
            ['branch', '=', $branch],
            ['division', '=', $division],
            ['day', '=', $day],
        ])->get();

        return response()->json(['timetable' => $timetable], 200);
    }

    public function feedback(Request $request)
    {
        $student = Student::find($request->student_id);
        $feedback = Feedback::where('student_id', '=', $request->student_id)->latest()->first();
        if($feedback)
        {
            if($request->sem != $student->sem)
                return response()->json(['data' => 'You cannot submit your feedback. Because you do not belong to this sem'], 200);
            
            if($feedback->feedback_no == 2)
                return response()->json(['You already submitted your both feedbacks for this sem.'], 200);
            elseif($feedback->feedback_no == 1)
            {
                $feedback_no = 2;
            }
        }
        else{
            $feedback_no = 1;
        }
        Feedback::Create([
            'student_id' => request('student_id'),
            'sem' => $student->sem,
            'division' => $student->division,
            'branch' => $student->branch,
            'feedback_no' => $feedback_no,

            'subject1' => request('subject1'),
            'lecture1' => request('lecture1'),
            'lgrade1' => request('lgrade1'),
            'practical1' => request('practical1'),
            'pgrade1' => request('pgrade1'),

            'subject2' => request('subject2'),
            'lecture2' => request('lecture2'),
            'lgrade2' => request('lgrade2'),
            'practical2' => request('practical2'),
            'pgrade2' => request('pgrade2'),

            'subject3' => request('subject3'),
            'lecture3' => request('lecture3'),
            'lgrade3' => request('lgrade3'),
            'practical3' => request('practical3'),
            'pgrade3' => request('pgrade3'),

            'subject4' => request('subject4'),
            'lecture4' => request('lecture4'),
            'lgrade4' => request('lgrade4'),
            'practical4' => request('practical4'),
            'pgrade4' => request('pgrade4'),
            
            'subject5' => request('subject5'),
            'lecture5' => request('lecture5'),
            'lgrade5' => request('lgrade5'),
            'practical5' => request('practical5'),
            'pgrade5' => request('pgrade5'),
            
            'subject6' => request('subject6'),
            'lecture6' => request('lecture6'),
            'lgrade6' => request('lgrade6'),
            'practical6' => request('practical6'),
            'pgrade6' => request('pgrade6'),

            'administrative_office' => request('administrative_office'),
            'examination_cell' => request('examination_cell'),
            'institute_library' => request('institute_library'),
            'department_laboratory' => request('department_laboratory'),
            'classrooms' => request('classrooms'),
            'water_facility' => request('water_facility'),
            'restroom' => request('restroom'),
            'canteen' => request('canteen'),
            'suggestion' => request('suggestion'),

            'completeness1' => request('completeness1'),
            'systematic_approach1' => request('systematic_approach1'),
            'comprehend1' => request('comprehend1'),
            'relevance1' => request('relevance1'),
            
            'completeness2' => request('completeness2'),
            'systematic_approach2' => request('systematic_approach2'),
            'comprehend2' => request('comprehend2'),
            'relevance2' => request('relevance2'),

            'ques1' =>request('ques1'),
            'ques2' =>request('ques2'),
            'ques3' =>request('ques3'),
            'ques4' =>request('ques4'),
            'ques5' =>request('ques5'),
            'ques6' =>request('ques6'),
        ]);

        return response()->json(['MESSAGE' => 'Feedback successfully stored.'], 200);
    }

}
