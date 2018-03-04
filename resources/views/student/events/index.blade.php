@extends('layouts.student_layout')
@section('title', 'Student :: Events')
@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop
@include('layouts.resource')
@section('content')

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($events as $event)      
                <div class="col-md-12 banner">
                    <br>
                    <h4>{{$event->name}}</h4>
                    <h5><strong>Commitee Name:  {{$event->commitee_name}}</strong></h5><br>
                    <p>Date: {{$event->date}}</p>
                    <p style="text-align:right">Year: {{$event->year}}</p>
                    <p style="text-align:right">Branch: {{$event->branch}}</p>
                    <hr>
                    <button onClick="parent.location='/student/events/view/{{$event->id}}'" type="button" class="btn button btn-success table-btn">
                        <span class="fa fa-eye" aria-hidden="true"></span>  View
                    </button>
                </div>
            @endforeach
            <div class="row">
                <div class="col-md-4 col-md-offset-5">
                    <div>
                        {{$events->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop