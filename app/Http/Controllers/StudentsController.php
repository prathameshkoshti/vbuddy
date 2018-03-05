<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::paginate(10);
        return view('admin.students.index', compact('students'));
        
    }

    /**
     * Show the form for viewing a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        if($student)
            return view('admin.students.view', compact('student'));
        else
            return view('errors.404');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required',
            'roll' => 'required|unique:students',
            'email' => 'required|unique:students|email',
            'password' => 'required',
            'year' => 'required',
            'sem' => 'required',
            'branch' => 'required',
            'division' => 'required',
            'admission_year' => 'required',
        ]);

        Student::create([
            'name' => request('name'),
            'roll' => request('roll'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'year' => request('year'),
            'sem' => request('sem'),
            'branch' => request('branch'),
            'division' => request('division'),
            'admission_year' => request('admission_year'),
        ]);

        \Session::flash('create', 'Data stored successfully.');
        return redirect('admin/students/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Student::find($id);
        if($student)
            return view('admin.students.edit', compact('student'));
        else
            return view('errors.404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->name = request('name');
            $student->roll = request('roll');
            $student->email = request('email');
            $student->password = bcrypt(request('password'));
            $student->year = request('year');
            $student->sem = request('sem');
            $student->branch = request('branch');
            $student->division = request('division');
            $student->admission_year = request('admission_year');
    
            $student->save();
    
            \Session :: flash('update','Updated Successfully!');
            return redirect('/admin/students/');
        }
        else
        {
            return view('errors.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student)
        {
            $student->status = 0;
            $student->save();
    
            \Session :: flash('delete','Deleted Successfully!');
            return redirect('/admin/students/');            
        }
        else
        {
            return view('errors.404');
        }   
    }
}
