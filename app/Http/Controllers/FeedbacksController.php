<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;
use App\Student;
use App\Question;

class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this -> validate($request, [
            'sem' => 'required',
            'branch' => 'required',
            'division' => 'required',
        ]);
        $feedbacks = Feedback::with('student')->where([
            ['sem', '=', request('sem')],
            ['branch', '=', request('branch')],
            ['division', '=', request('division')],
        ])->paginate(10);

        if(count($feedbacks)>0)
        {
            $sem = request('sem');
            $branch = request('branch');
            $division = request('division');

            return view('admin.feedbacks.index', compact('feedbacks', 'division', 'branch', 'sem'));
        }
        else
            return view('errors.404');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questions = Question::all();
        $feedback = Feedback::find($id);
        if($feedback)
        {
            /*
            Calculating average for faculties
            */
            if($feedback->subject5 == null && $feedback->subject6 == null)
            {
                $avg_faculty = (
                    $feedback->lgrade1 + $feedback->pgrade1 +
                    $feedback->lgrade2 + $feedback->pgrade2 +
                    $feedback->lgrade3 + $feedback->pgrade3 +
                    $feedback->lgrade4 + $feedback->pgrade4
                )/(float)8;
                
            }
            elseif($feedback->subject6 == null)
            {
                $avg_faculty = (
                    $feedback->lgrade1 + $feedback->pgrade1 +
                    $feedback->lgrade2 + $feedback->pgrade2 +
                    $feedback->lgrade3 + $feedback->pgrade3 +
                    $feedback->lgrade4 + $feedback->pgrade4 +
                    $feedback->lgrade5 + $feedback->pgrade5
                )/(float)10;
            }
            else
            {
                $avg_faculty = (
                    $feedback->lgrade1 + $feedback->pgrade1 +
                    $feedback->lgrade2 + $feedback->pgrade2 +
                    $feedback->lgrade3 + $feedback->pgrade3 +
                    $feedback->lgrade4 + $feedback->pgrade4 +
                    $feedback->lgrade5 + $feedback->pgrade5 +
                    $feedback->lgrade6 + $feedback->pgrade6
                )/(float)12;
            }
            
            /*
                Calculating average for study materials
            */
            $avg_faculty_notes = (
                $feedback->completeness1 + $feedback->systematic_approach1 +
                $feedback->comprehend1 + $feedback->relevance1
            )/(float)4;

            $avg_faculty_printed_notes = (
                $feedback->completeness2 + $feedback->systematic_approach2 +
                $feedback->comprehend2 + $feedback->relevance2
            )/(float)4;

            /*
                Calculating average for amenities
            */
            $avg_amenities = (
                $feedback->administrative_office + $feedback->examination_cell +
                $feedback->institute_library + $feedback->department_laboratory +
                $feedback->classrooms + $feedback->water_facility +
                $feedback->restroom + $feedback->canteen
            )/(float)8;

            $feedback_answers = Feedback::select('ques1', 'ques2', 'ques3', 'ques4', 'ques5', 'ques6')->find($id);
            $answers = array_values($feedback_answers->toArray());
            $student = Student::find($feedback->student_id);
            return view('admin.feedbacks.view', compact('feedback', 'student', 'questions', 'answers', 'avg_faculty', 'avg_faculty_notes', 'avg_faculty_printed_notes', 'avg_amenities'));
        }
        else
        {
            return view('errors.404');
        }
    }

    /**
     * Show the statistics for feedbacks.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stats()
    {
        return view('admin.feedbacks.stats');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
