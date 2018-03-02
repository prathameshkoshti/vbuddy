@extends('adminlte::page')

@section('title', 'AdminLTE :: V-Buddy')

@section('content_header')
    <h1 style="text-align:center">Feedbacks</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 alert alert-blue" style="margin:20px">
            <table class="table table-borderless">
                <tr>
                    <td>Name:</td><td>{{$student->name}}</td>
                </tr>
                <tr>
                    <td>Roll No.:</td> <td>{{$student->roll}}</td><br>
                </tr>
                <tr>
                    <td>Year/Sem:</td><td>{{$student->year}}/{{$student->sem}}</td><br>
                </tr>
                <tr>
                    <td>Branch:</td><td>{{$student->branch}}</td><br>
                </tr>
                <tr>
                    <td>Email Id:</td><td>{{$student->email}}</td>
                </tr>
                <br>
            </table>
        </div>
        <div class="col-md-7 alert alert-teal" style="margin:20px">
                <h5><strong>Self Assessment of Learning Process:    </strong></h5>
                <table class="table table-borderless">
                    <?php $i=0?>
                    @foreach($questions as $question)
                        <tr>
                            <th>
                                {{$question->question}}
                            </th>
                            <td>
                                @if($answers[$i] == 1)
                                    {{$question->option1}}
                                @elseif($answers[$i] == 2)
                                    {{$question->option2}}
                                @elseif($answers[$i] == 3)
                                    {{$question->option3}}
                                @else
                                    {{$question->option4}}
                                @endif
                                <?php $i++ ?>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
    </div>
    <div class="row">
        
    </div>
    <div class="row">
        <div class="col-md-4 alert alert-green" style="margin:20px;margin-left:20px;">
            <h5><strong>Assessment of the faculties teaching in your class:</strong></h5>
            <table class="table table-bordered">
                <tr>
                    <th>Subjects</th>
                    <th colspan="2">Faculty Name</th>
                    <th>Teaching Skills Grade (4 to 0)</th>
                </tr>
                <tr>
                    <td rowspan="2">{{$feedback->subject1}}</td>
                    <td>Lecture</td>
                    <td>{{$feedback->lecture1}}</td>
                    <td align="center">{{$feedback->lgrade1}}</td>
                </tr>
                <tr>
                    <td>Practical/Tutorial</td>
                    <td>{{$feedback->practical1}}</td>
                    <td align="center">{{$feedback->pgrade1}}</td>
                </tr>
                <tr>
                    <td rowspan="2">{{$feedback->subject2}}</td>
                    <td>Lecture</td>
                    <td>{{$feedback->lecture2}}</td>
                    <td align="center">{{$feedback->lgrade2}}</td>
                </tr>
                <tr>
                    <td>Practical/Tutorial</td>
                    <td>{{$feedback->practical2}}</td>
                    <td align="center">{{$feedback->pgrade2}}</td>
                </tr>
                <tr>
                    <td rowspan="2">{{$feedback->subject3}}</td>
                    <td>Lecture</td>
                    <td>{{$feedback->lecture3}}</td>
                    <td align="center">{{$feedback->lgrade3}}</td>
                </tr>
                <tr>
                    <td>Practical/Tutorial</td>
                    <td>{{$feedback->practical3}}</td>
                    <td align="center">{{$feedback->pgrade3}}</td>
                </tr>
                <tr>
                    <td rowspan="2">{{$feedback->subject4}}</td>
                    <td>Lecture</td>
                    <td>{{$feedback->lecture4}}</td>
                    <td align="center">{{$feedback->lgrade4}}</td>
                </tr>
                <tr>
                    <td>Practical/Tutorial</td>
                    <td>{{$feedback->practical4}}</td>
                    <td align="center">{{$feedback->pgrade4}}</td>
                </tr>
                @if($feedback->subject5)
                <tr>
                    <td rowspan="2">{{$feedback->subject5}}</td>
                    <td>Lecture</td>
                    <td>{{$feedback->lecture5}}</td>
                    <td align="center">{{$feedback->lgrade5}}</td>
                </tr>
                <tr>
                    <td>Practical/Tutorial</td>
                    <td>{{$feedback->practical5}}</td>
                    <td align="center">{{$feedback->pgrade5}}</td>
                </tr>
                @endif
                @if($feedback->subject6)
                <tr>
                    <td rowspan="2">{{$feedback->subject6}}</td>
                    <td>Lecture</td>
                    <td>{{$feedback->lecture6}}</td>
                    <td align="center">{{$feedback->lgrade6}}</td>
                </tr>
                <tr>
                    <td>Practical/Tutorial</td>
                    <td>{{$feedback->practical6}}</td>
                    <td align="center">{{$feedback->pgrade6}}</td>
                </tr>
                @endif
            </table>
        </div>
        <div class="col-md-7 col-md-offset- alert alert-orange" style="margin:20px">
            <h5><strong>Assessment of the study materials:</strong></h5>
            <table class="table table-bordered">
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
                    <td align="center">
                        {{$feedback->completeness1}}
                    </td>
                    <td align="center">
                        {{$feedback->completeness2}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Do they have systematic approach
                    </td>
                    <td align="center">
                        {{$feedback->systematic_approach1}}
                    </td>
                    <td align="center">
                        {{$feedback->systematic_approach2}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Are they simple to comprehend
                    </td>
                    <td align="center">
                        {{$feedback->comprehend1}}
                    </td>
                    <td align="center">
                        {{$feedback->comprehend2}}
                    </td>
                </tr>
                <tr>
                    <td>
                        Relevance of notes to classroom teaching
                    </td>
                    <td align="center">
                        {{$feedback->relevance1}}
                    </td>
                    <td align="center">
                        {{$feedback->relevance2}}
                    </td>
                </tr>
            </table>
            <div class="alert">
                <strong>Suggestions:</strong><br>
                @if($feedback->suggestion)
                    {{$feedback->suggestion}}
                @else
                    Student did not provide any suggestion.<br><br><br><br>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 alert alert-purple" style="margin:20px">
            <h5><strong>Assessment of amenities:</strong></h5>
            <table class="table table-bordered">
                <tr>
                    <th align="center">Amenities</th>
                    <td  align="center"><strong>Grade</strong></td>
                </tr>
                <tr>
                    <td>Co-operation of non-teaching staff from Administrative office</td>
                    <td align="center">{{$feedback->administrative_office}}</td>
                </tr>
                <tr>
                    <td>Co-operation of non-teaching staff from Examination cell</td>
                    <td align="center">{{$feedback->examination_cell}}</td>
                </tr>
                <tr>
                    <td>Co-operation of non-teaching staff from Institute library</td>
                    <td align="center">{{$feedback->institute_library}}</td>
                </tr>
                <tr>
                    <td>Co-operation of non-teaching staff from Department laboratory</td>
                    <td align="center">{{$feedback->department_laboratory}}</td>
                </tr>
                <tr>
                    <td>Cleanliness of classroom</td>
                    <td align="center">{{$feedback->classrooms}}</td>
                </tr>
                <tr>
                    <td>Drinking water facility</td>
                    <td align="center">{{$feedback->water_facility}}</td>
                </tr>
                <tr>
                    <td>Upkeep of restrooms</td>
                    <td align="center">{{$feedback->restroom}}</td>
                </tr>
                <tr>
                    <td>Canteen facility</td>
                    <td align="center">{{$feedback->canteen}}</td>
                </tr>
            </table>
            <br>
        </div>
        <div class="col-md-3 alert alert-cyan" style="margin:20px;">
            <h5><strong>Ratings given by {{$student->name}}</strong></h5>
            <table class="table table-bordered">
                <tr>
                    <td>
                        Average rating for faculties
                    </td>
                    <td align="center">
                        {{$avg_faculty}}
                    </td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td colspan="2">
                        Average rating for study materials
                    </td>
                </tr>
                <tr>
                    <td>
                        Study materials by teacher
                    </td>
                    <td>
                        Printed notes
                    </td>
                </tr>
                <tr>
                    <td align="center">{{$avg_faculty_notes}}</td>
                    <td align="center">{{$avg_faculty_printed_notes}}</td>
                </tr>
            </table>
            <table class="table table-bordered">
                <tr>
                    <td>
                        Average rating for amenities
                    </td>
                    <td align="center">
                        {{$avg_amenities}}
                    </td>
                </tr>
            </table>
            <div>
                <strong>Overall rating given by {{$student->name}}</strong>
                <br>
                <br>
                <?php
                    $average = (
                        $avg_faculty + $avg_faculty_notes + 
                        $avg_faculty_printed_notes + $avg_amenities
                    )/(float)4;

                    $avg = sprintf('%0.1f', $average);
                ?>
                <h4 style="text-align:center">{{(float)$avg}}</h4>
                <p style="text-align:center">
                    @for($i=1; $i<=$average; $i++)
                    <i class="fa fa-star fa-2x" style="color:yellow" aria-hidden="true"></i>
                    @endfor
                    @if(
                        ($average > 0.01 && $average < 0.99) ||
                        ($average > 1.01 && $average < 1.99) ||
                        ($average > 2.01 && $average < 2.99) ||
                        ($average >= 3.01 && $average <= 3.99)
                    )
                    <i class="fa fa-star-half fa-2x" style="color:yellow" aria-hidden="true"></i>
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>
    @include('layouts.resource')
    <style>
        .table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th{
            border:1px solid white !important;
        }
        .alert{
            color: #fff;
        }
        .alert-purple{
            background-color: #4527A0 !important;
        }
        .alert-green{
            background-color: #43A047 !important;
        }
        .alert-orange{
            background-color: #EF6C00 !important;
        }
        .alert-teal{
            background-color: #009688 !important;
        }
        .alert-blue{
            background-color: #0288D1;
        }
        .alert-cyan{
            background-color: #00ACC1;
        }
    </style>
@stop