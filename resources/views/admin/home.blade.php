@extends('adminlte::page')

@section('title', 'AdminLTE :: V-Buddy')

@section('content_header')
    <h1 style="text-align:center">Dashboard</h1>
@stop

@section('content')
{!! Charts::styles() !!}
    <div class="row">
        <div class="col-md-8">
            {!! $events_chart->html() !!}
        </div>
        <div class="col-md-4">
            <div class="alert alert-info" role="alert">
                <h3>{{$event->name}}</h3>
                <h4>{{$event->details}}</h4>
                <p>Issued-By:&nbsp;{{$user_event->name}}</p>
                <p>{{$event->date}}</p><br>
                <p>Registrations done: {{$event->event_registration_count}}</p>
                <a style="float:right;" class="alert-link" href="/admin/events">more..</a><br>
            </div>
        </div>
        <div class="col-md-4">
                <div class="alert alert-warning" role="alert">
                    <h3>{{$placement->head}}</h3>
                    <h4>{{$placement->body}}</h4>
                    <p>Issued-By:&nbsp;{{$user_placement->name}}</p>
                    <p>{{$event->date}}</p><br>
                    <a style="float:right;" class="alert-link" href="/admin/events">more..</a><br>
                </div>
            </div>  
    </div>    
    <div class="row">
    </div>
    
    {!! Charts::scripts() !!}
    {!! $events_chart->script() !!}
@stop