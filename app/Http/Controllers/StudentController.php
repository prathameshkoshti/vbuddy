<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Holiday;
use App\Placement;
use App\Announcement;
use Auth;
use App\User;
use App\IATimetable;
use App\Timetable;
use App\ReplacementTimetable;
use App\Event;
use App\EventRegistration;
use App\PlacementRegistration;
use App\Question;
use App\Feedback;
use Storage;
use File;
use Illuminate\Support\Facades\Hash;


class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:student');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.home');
    }

    public function holiday()
    {
        $holidays = Holiday::where('status', '=', 1)->paginate(10);
        if(count($holidays))
            return view ('student.holiday', compact('holidays'));
        else
            return view('errors.404');
    }

    public function placement(Request $request)
    {
        $year = Auth::user()->year;
        $branch = Auth::user()->branch;

        $results = Placement::where('status', '=', 1)->latest()->get();
        $data = [];

        foreach($results as $result)
        {
            if(in_array($year, explode(',', $result->year)) && in_array($branch, explode(',', $result->branch)))
            {
                array_push($data, $result);
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 3;
        $placements = collect($data);
        $currentPageItems = $placements->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($placements), $perPage);
        $paginatedItems->setPath($request->url());

        if($paginatedItems)
            return view('student.placements.index', ['placements' => $paginatedItems]);
        else
            return view('errors.404');
    }

    public function placementDownload($file_name)
    {
        return Storage::download('placements/'.$file_name);
    }

    public function placementView($id)
    {
        $year = Auth::user()->year;
        $branch = Auth::user()->branch;
        $placement = Placement::where([
            ['status', '=', 1],
            ['id', '=', $id],
        ])->first();
        if($placement)
        {
            if(in_array($year, explode(',', $placement->year)) && in_array($branch, explode(',', $placement->branch)))
            {
                $isRegistered = PlacementRegistration::where([
                    ['status', '=', 1],
                    ['placement_id', '=', $id],
                    ['student_id', '=', Auth::user()->id],
                ])->first();
                $issued_by = User::where('id', '=', $placement->issued_by)->first();        
                return view('student.placements.view', compact('placement','issued_by', 'isRegistered'));
            }
            else{
                return view('errors.401');
            }
        }
        else{
            return view('errors.404');
        }
    }

    public function registerToPlacement($id)
    {
        $year =Auth::user()->year;
        $branch =Auth::user()->branch;

        $placement = Placement::where([
            ['status', '=', 1],
            ['id', '=', $id],
        ])->first();

        if($placement)
        {
            if(in_array($year, explode(',', $placement->year)) && in_array($branch, explode(',', $placement->branch)))
            {
                $isRegistered = PlacementRegistration::where([
                    ['status', '=', 1],
                    ['placement_id', '=', $id],
                    ['student_id', '=', Auth::user()->id],
                ])->first();

                $url = 'student/placements/view/' . $id;
                
                if($isRegistered)
                {
                    \Session::flash('register', 'Already registered for this placmeent.');
                    return redirect($url);
                }
                else
                {
                    PlacementRegistration::create([
                        'placement_id' => $id,
                        'student_id' => Auth::user()->id,
                    ]);
                    \Session::flash('register', 'Successfully registered.');
                    return redirect($url);
                }
            }
            else
            {
                return view('errors.401');
            }
        }
        else
        {
            return view('errors.404');
        }
    }

    public function event(Request $request)
    {
        $year = Auth::user()->year;
        $branch = Auth::user()->branch;

        $results = Event::where('status', '=', 1)->latest()->get();
        $data = [];

        foreach($results as $result)
        {
            if(in_array($year, explode(',', $result->year)) && in_array($branch, explode(',', $result->branch)))
            {
                array_push($data, $result);
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 3;
        $events = collect($data);
        $currentPageItems = $events->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($events), $perPage);
        $paginatedItems->setPath($request->url());
        if($paginatedItems)
            return view('student.events.index', ['events' => $paginatedItems]);        
        else
            return view('errors.404');
    }

    public function eventDownload($file_name)
    {
        return Storage::download('events/'.$file_name);
    }

    public function eventView($id)
    {
        $year = Auth::user()->year;
        $branch = Auth::user()->branch;
        $event = Event::where([
            ['status', '=', 1],
            ['id', '=', $id],
        ])->first();
        if($event)
        {
            if(in_array($year, explode(',', $event->year)) && in_array($branch, explode(',', $event->branch)))
            {
                $issued_by = User::where('id', '=', $event->issued_by)->first();        
                $isEnrolled = EventRegistration::where([
                    ['status', '=', 1],
                    ['event_id', '=', $id],
                    ['student_id', '=', Auth::user()->id],
                ])->first();
                if($issued_by)
                    return view('student.events.view', compact('event','issued_by', 'isEnrolled'));
                else
                    return view('errors.404');
            }
            else{
                return view('errors.401');
            }
        }
        else{
            return view('errors.404');
        }
    }

    public function enrolToEvent($id)
    {
        $year = Auth::user()->year;
        $branch = Auth::user()->branch;

        $event = Event::where([
            ['status', '=', 1],
            ['id', '=', $id],
        ])->first();

        if($event)
        {
            if(in_array($year, explode(',', $event->year)) && in_array($branch, explode(',', $event->branch)))
            {     
                $isEnrolled = EventRegistration::where([
                    ['status', '=', 1],
                    ['event_id', '=', $id],
                    ['student_id', '=', Auth::user()->id],
                ])->first();
                $url = 'student/events/view/' . $id;                
                if($isEnrolled){
                    \Session::flash('register', 'Do not worry you are in our list!');
                    return redirect($url);
                }
                else{
                    EventRegistration::create([
                        'event_id' => $id,
                        'student_id' => Auth::user()->id,                        
                    ]);
                    \Session::flash('register', 'Registerd Successfully!');                    
                    return redirect($url);
                }
            }
            else{
                return view('errors.401');
            }
        }
        else{
            return view('errors.404');
        }
    }

    public function announcement(Request $request)
    {
        $year = Auth::user()->year;
        $branch = Auth::user()->branch;
        $division = Auth::user()->division;

        $results = Announcement::where('status', '=', 1)->latest()->get();
        $data = [];

        foreach($results as $result)
        {
            if(in_array($year, explode(',', $result->year)) && in_array($branch, explode(',', $result->branch)) && in_array($division, explode(',', $result->division)))
            {
                array_push($data, $result);
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 3;
        $announcements = collect($data);
        $currentPageItems = $announcements->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($announcements), $perPage);
        $paginatedItems->setPath($request->url());

        if($paginatedItems)
            return view('student.announcements.index', ['announcements' => $paginatedItems]);
        else
            return view('errors.404');
    }

    public function announcementDownload($file_name)
    {
        return Storage::download('announcements/'.$file_name);
    }

    public function announcementView($id)
    {
        $year = Auth::user()->year;
        $branch = Auth::user()->branch;
        $division = Auth::user()->division;
        $announcement = Announcement::where([
            ['status', '=', 1],
            ['id', '=', $id],
        ])->first();
        if($announcement)
        {
            if(in_array($year, explode(',', $announcement->year)) && in_array($branch, explode(',', $announcement->branch)) && in_array($division, explode(',', $announcement->division)))
            {
                $issued_by = User::where('id', '=', $announcement->issued_by)->first();
                return view('student.announcements.view', compact('announcement','issued_by'));
            }
            else{
                return view('errors.401');
            }
        }
        else{
            return view('errors.404');
        }
    }

    public function timetable()
    {
        $day = date('l', strtotime(date('Y-m-d')));
        //$day = 'Friday';
        if($day == 'Saturday' || $day == 'Sunday')
        {
            \Session::flash('create', 'No college today!');
            return redirect('/student/home');
        }
        $replacements = array();
        $timetables = Timetable::where([
            ['branch', '=', Auth::user()->branch],
            ['sem', '=', Auth::user()->sem],
            ['division', '=', Auth::user()->division],
            ['day', '=', $day],
        ])->get();
        if(count($timetables)>0)
        {
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
            return view('student.timetable', compact('timetables', 'day'));
        }
        else
            return view('errors.404');
    }

    public function iaTimetable()
    {
        $branch = Auth::user()->branch;
        $sem = Auth::user()->sem;

        $ia_timetable = IATimetable::where([
            ['branch', '=', $branch],
            ['sem', '=', $sem],
        ])->oldest()->get();
        if(count($ia_timetable)>0)
            return view('student.ia_timetable', compact('ia_timetable'));
        else
            return view('errors.404');
    }

    public function feedback()
    {
        $questions = Question::all();
        return view('student.feedback', compact('questions'));
    }

    public function storeFeedback(Request $request)
    {
        $this->validate($request, [
            'subject1' => 'required',
            'lecture1' => 'required',
            'lgrade1' => 'required',
            'practical1' => 'required',
            'pgrade1' => 'required',

            'subject2' => 'required',
            'lecture2' => 'required',
            'lgrade2' => 'required',
            'practical2' => 'required',
            'pgrade2' => 'required',

            'subject3' => 'required',
            'lecture3' => 'required',
            'lgrade3' => 'required',
            'practical3' => 'required',
            'pgrade3' => 'required',

            'subject4' => 'required',
            'lecture4' => 'required',
            'lgrade4' => 'required',
            'practical4' => 'required',
            'pgrade4' => 'required',

            'administrative_office' => 'required',
            'examination_cell' => 'required',
            'institute_library' => 'required',
            'department_laboratory'=> 'required',
            'classrooms' => 'required',
            'water_facility' => 'required',
            'restroom' => 'required',
            'canteen' => 'required',

            'completeness1' => 'required',
            'systematic_approach1' => 'required',
            'comprehend1' => 'required',
            'relevance1' => 'required',
            
            'completeness2' => 'required',
            'systematic_approach2' => 'required',
            'comprehend2' => 'required',
            'relevance2' => 'required',

            'ques1' => 'required',
            'ques2' => 'required',
            'ques3' => 'required',
            'ques4' => 'required',
            'ques5' => 'required',
            'ques6' => 'required',
        ]);

        $student = Auth::user();
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
            if($count == 2 || $count > 2)
            {
                \Session::flash('feedback', 'You have already submitted both feedbacks for this sem.');
                return redirect('/student/home');
            }
            elseif($count == 1)
            {
                $feedback_no = 2;
            }
        }
        else
        {
            $feedback_no = 1;           
        }

        Feedback::create([
            'student_id' => bcrypt($student->id),
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

            'ques1' => request('ques1'),
            'ques2' => request('ques2'),
            'ques3' => request('ques3'),
            'ques4' => request('ques4'),
            'ques5' => request('ques5'),
            'ques6' => request('ques6'),
        ]);
        \Session::flash('feedback', 'Feedback Submitted successfully.');        
        return redirect('/student/home');
    }
    public function profile()
    {
        $user = Auth::user();
        return view('student.profile', compact('user'));
    }

    public function changePassword()
    {
        $profile_id = Auth::user()->id;
        return view('student.change_password', compact('profile_id'));
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        $id = request('id');
        $password = Auth::user()->password;
        if(Hash::check(request('old_password'), $password))
        {
            $user->password = bcrypt(request('new_password'));
            $user->save();
            \Session::flash('update', 'Password updated successfully.');
            return redirect('/student/profile');
        }

        \Session::flash('update', 'Password update failed!.');
        return redirect('/student/profile/change_password');
    }

}
