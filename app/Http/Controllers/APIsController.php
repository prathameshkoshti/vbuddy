<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
use App\Event;
use App\EventRegistration;
use App\PlacementRegistration;
use App\Placement;
use App\Announcement;
use App\Student;
use App\IATimetable;
use App\Timetable;
use App\ReplacementTimetable;
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
            ])->latest()->get();
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
        $event = Event::with('user')->where([
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
    public function downloadEvent($id, $file_name)
    {
        $event = Event::find($id);
        $filename = explode(',', $event->file_name);
        $filemime = explode(',', $event->file_mime);
        $original = explode(',', $event->original_filename);

        for($i=0; $i<count($filename); $i++)
        {
            if($file_name == $filename[$i])
            {
                $header = [
                    'Content-Type' => $filemime[$i],
                ];
                return response()->download(storage_path('app/events/'.$file_name), $original[$i], $header); 
            }
        }
    }
    //anyone can do registration bug
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
        $placements = Placement::where('status', '=', '1')->latest()->get();
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

    public function downloadPlacement($id, $file_name)
    {
        $placement = Placement::find($id);
        $filename = explode(',', $placement->file_name);
        $filemime = explode(',', $placement->file_mime);
        $original = explode(',', $placement->original_filename);

        for($i=0; $i<count($filename); $i++)
        {
            if($file_name == $filename[$i])
            {
                $header = [
                    'Content-Type' => $filemime[$i],
                ];
                return response()->download(storage_path('app/placements/'.$file_name), $original[$i], $header); 
            }
        }
    }

    public function viewPlacement($year, $branch, $id)
    {
        $placement = Placement::with('user')->where([
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

    public function registerToPlacement($placement_id, $student_id)
    {
        $reg = PlacementRegistration::where([
            ['student_id', '=', $student_id],
            ['placement_id', '=', $placement_id],
        ])->first();
        if($reg)
        {
            return response()->json(['MESSAGE' => 'Already registered.'], 200);
        }
        else
        {
            PlacementRegistration::create([
                'placement_id' => $placement_id,
                'student_id' => $student_id,
            ]);
            return response()->json(['MESSAGE' => 'Registered Successfully'], 200);
        }
    }

    public function announcement($year, $branch, $div)
    {
        $announcements = Announcement::where('status', '=', '1')->latest()->get();
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
        $announcement = Announcement::with('user')->where([
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

    public function downloadAnnouncement($id, $file_name)
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
        $timetables = Timetable::where([
            ['sem', '=', $sem],
            ['branch', '=', $branch],
            ['division', '=', $division],
            ['day', '=', $day],
        ])->get();

        $day = date('l', strtotime(date('Y-m-d')));
        if($day == 'SATURDAY' || $day == 'SUNDAY')
            return response()->json(['timetable' => 'No college today!'], 200);
        $replacements = array();
        foreach($timetables as $timetable)
        {
            $temp = ReplacementTimetable::where([
                ['replacement_id', '=', $timetable->id],
                ['date', '=', date('Y-m-d')],//change this date for to 2018-01-19 show replacement
                ['status', '=', 1],
            ])->first();
            if($temp)
                array_push($replacements, $temp);
        }
        foreach($timetables as $timetable)
        {
            foreach($replacements as $replacement)
            {
                if($replacement->replacement_id == $timetable->id)
                {
                    $timetable->subject = $replacement->replacement_subject;
                    $timetable->teacher = $replacement->replacement_faculty;
                }
            }
        }
        return response()->json(['timetable' => $timetables], 200);
    }

    public function feedback(Request $request)
    {
        $student = Student::find($request->student_id);
        $feedbacks = Feedback::where([
                ['branch', '=', $student->branch],
                ['sem', '=', $student->sem],
                ['division', '=', $student->division],
            ])->get();
        $count = 0;
        foreach($feedbacks as $feedback)
        {
            if(Hash::check($student->id, $feedback->student_id))
            {
                $count++;
            }
        }
        $feedback_no = 0;
        if($count > 0)
        {
            if($request->sem != $student->sem)
                return response()->json(['MESSAGE' => 'You cannot submit your feedback. Because you do not belong to this sem'], 200);
            
            if($count == 2 || $count > 2)
                return response()->json(['MESSAGE' => 'You already submitted your both feedbacks for this sem.'], 200);
            
            if($count == 1)
            {
                $feedback_no = 2;
            }
        }
        else
        {
            $feedback_no = 1;
        }
        $suggestion = request('suggestion');
        Feedback::Create([
            'student_id' => bcrypt(request('student_id')),
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
            'suggestion' => $suggestion,

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
