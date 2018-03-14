@extends('layouts.student_layout')
@section('title', 'Student :: Placements')
@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop
@section('content')

<div class="container-fluid">
    <br>
        <div class="row">    
                <div class="col-md-6 col-md-offset-3">
                    <div class="banner">
                        <br>
                        <h3 class="centered">{{$event->name}}</h3>
                        <br>
                        <h4>
                            {{$event->details}}
                        </h4>
                        <br>
                        <hr>
                        <p>Date: {{$event->date}}</p>
                        <p>Location/Room No.: {{$event->location}}</p>
                        <p>Year: {{$event->year}}</p>
                        <p>Branch: {{$event->branch}}</p>
                        <p style="text-align:right">Issued By: {{$issued_by->name}}</p>
                        @if($event->file_name)
                        <a href="/student/events/download/{{$event->file_name}}">
                            <p>Attached File: {{$event->original_filename}}</p>
                        </a>
                        @endif
                        <hr>
                        @if($isEnrolled)
                        <button onClick="parent.location='/student/events/enroll/{{$event->id}}'" type="button" class="student-btn btn btn-success">
                            <span class="fa fa-check" aria-hidden="true"></span>  Registered
                        </button>
                        @else
                        <button onClick="parent.location='/student/events/enroll/{{$event->id}}'" type="button" class="student-btn btn btn-success">
                            <span class="fa fa-plus" aria-hidden="true"></span>  Register
                        </button>
                        @endif   
                        <br>    
                    </div>      
                </div>        
        </div>
</div>
@include('layouts.resource')
@stop