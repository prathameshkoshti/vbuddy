@extends('layouts.student_layout')
@section('title', 'Student :: Placements')
@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop
@include('layouts.resource')
@section('content')

<div class="container-fluid">
    <br>
        <div class="row">    
                <div class="col-md-6 col-md-offset-3 banner">
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
                    <hr>
                    @if($isEnrolled)
                    <button type="button" class="btn btn-success button table-btn">
                        <span class="fa fa-check" aria-hidden="true"></span>  Enrolled
                    </button>
                    @else
                    <button onClick="parent.location='/student/event/enroll/{{$event->id}}'" type="button" class="btn btn-success table-btn">
                        <span class="fa fa-plus" aria-hidden="true"></span>  Enroll
                    </button>
                    @endif   
                    <br>          
                </div>        
        </div>
</div>

@stop