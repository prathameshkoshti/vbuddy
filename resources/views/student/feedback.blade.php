@extends('layouts.student_layout')

@section('title', 'Student :: Submit Feedback')

@section('content_header')
    <h1 style="text-align:center">Submit Feedback</h1>
@stop

@section('content')
    <div class="container-fluid">
        <form method="POST" action="/student/feedback/store" class="form form-group box-body">
            {{csrf_field()}}
            {{method_field('PUT')}}
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-4">
                        <h4>
                            <strong>Self Assessment of Learning Process:</strong>
                        </h4>
                        @php
                        $i=1;
                        @endphp
                        @foreach($questions as $question)
                            <p>{{$question->question}}</p>
                            <select class="form-control" name="ques{{$i}}">
                                <option value="1">{{$question->option1}}</option>
                                <option value="2">{{$question->option2}}</option>
                                <option value="3">{{$question->option3}}</option>
                                <option value="4">{{$question->option4}}</option>
                            </select>
                            <br>
                            @php $i++ @endphp
                        @endforeach
                    </div>
                    <div class="col-md-8">
                        <h4>
                            <strong>Self Assessment of Learning Process:</strong>
                        </h4>
                        <table class="table table-borderless">
                            <tr>
                                <th colspan="2">Subjects</th>
                                <th colspan="2">Faculty Name</th>
                                <th>Teaching Skills (0 to 4)</th>
                            </tr>
                            @for($i=1; $i<=6; $i++)
                            <tr>
                                <td rowspan="2">
                                    Subject {{$i}}
                                </td>
                                <td rowspan="2">
                                    <input type="text" class="form-control" name="subject{{$i}}">
                                </td>
                                <td>Lecture</td>
                                <td>
                                    <input type="text" name="lecture{{$i}}" class="form-control">
                                </td>
                                <td>
                                    <select name="lgrade{{$i}}" class="form-control">
                                        <option value="null" disabled selected>Rating</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Practical
                                </td>
                                <td>
                                    <input type="text" class="form-control" name="practical{{$i}}">
                                </td>
                                <td>
                                    <select name="pgrade{{$i}}" class="form-control">
                                        <option value="null" disabled selected>Rating</option>                                        
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </td>
                            </tr>
                            @endfor
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <h4><strong>Assessment of the study materials:</strong></h4>
                    <table class="table table-borderless">
                        <tr>
                            <th>
                                Quality of assessment tool for the study material provided
                            </th>
                            <th>
                                Study material given by course teacher
                            </th>
                            <th>
                                Printed study materials distributed
                            </th>
                        </tr>
                        <tr>
                            <td>
                                Do they cover complete syllabus
                            </td>
                            <td>
                                <select name="completeness1" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td>
                                <select name="completeness2" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Do they have systematic approach
                            </td>
                            <td>
                                <select name="systematic_approach1" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td>
                                <select name="systematic_approach2" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Are they simple to comprehend
                            </td>
                            <td>
                                <select name="comprehend1" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td>
                                <select name="comprehend2" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Relevance of notes to classroom teaching
                            </td>
                            <td>
                                <select name="relevance1" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                            <td>
                                <select name="relevance2" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <h4><strong>Suggestion</strong></h4>
                    <textarea rows="4" name="suggestion" class="form-control"></textarea>
                </div>
                <div class="col-md-6">
                    <h4><strong>Assessment of the aminities:</strong></h4>
                    <table class="table table-borderless">
                        <tr>
                            <th>Amenities</th>
                            <th>Rating</th>
                        </tr>
                        <tr>
                            <td>
                                Co-operation of non-teaching staff from Administrative office
                            </td>
                            <td>
                                <select name="administrative_office" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Co-operation of non-teaching staff from Examination cell
                            </td>
                            <td>
                                <select name="examination_cell" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Co-operation of non-teaching staff from Institute library
                            </td>
                            <td>
                                <select name="institute_library" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Co-operation of non-teaching staff from Department laboratory
                            </td>
                            <td>
                                <select name="department_laboratory" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Cleanliness of classroom
                            </td>
                            <td>
                                <select name="classrooms" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Drinking water facility
                            </td>
                            <td>
                                <select name="water_facility" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Upkeep of restrooms
                            </td>
                            <td>
                                <select name="restroom" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Canteen facility
                            </td>
                            <td>
                                <select name="canteen" class="form-control">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-md-offset-5">
                    <input type="submit" class="btn btn-warning form-control">
                </div>
            </div>
        </form>
    </div>
    @include('layouts.resource')    
@stop