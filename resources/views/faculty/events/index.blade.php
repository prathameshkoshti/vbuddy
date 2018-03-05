@extends('layouts.faculty_layout')

@section('title', 'V-buddy :: Events')

@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop
<style>
    hr{
        border-color: rgba(225,225,225,0.5) !important;
        margin: 10px;
        position:relative;
        top: 15
        
    }
    h6{
        color: rgba(225,225,225,0.7) !important;
    }
    .fa-eye{
        color: #0277BD;
    }
    .card{
        border: solid 1px rgba(225,225,225,0.5);
        background-color:rgba(0,0,0,0.4);
    }
    .count{
        width:30px;
        height:30px;
        position: absolute;
        right:10px;
        background-color: rgba(225,225,225,0.2);
        color: #fff !important;
        border-radius: 100px;
        padding:4;
    }
    a{
        color:#fff !important;
    }
    .count:hover{
        background-color: #fff;
    }
    .count:hover > .a{
        color: #000 !important;
    }
    a:hover{
        color: rgba(0,0,0,0.8) !important;
    }
</style>
@section('content')
    @include('layouts.cards_style')
    <div class="row">
        <div class="col-md-8 col-md-offset-1">
            <div class="row">
                <div class="col-sm-offset-4 col-md-offset-12">
                    <button onClick="parent.location='/faculty/events/create'" class="btn btn-success"><i class="fa fa-1x fa-plus"></i> Create</button>
                </div>
            </div>
            <div class="row">
                @foreach($events as $event)
                    <div class="col-md-2 col-xs-offset-2 col-xs-6 col-sm-2 card-holder">
                        <div class="form-group animate">
                            <div class="card" style="">
                                <div class="card-header">
                                    <h6>Event Name</h6>
                                    <h4>{{$event->name}}</h4>
                                    <div class="count">
                                        <a class="a" href="/faculty/event_registrations/view/{{$event->id}}">{{$event->event_registration_count}}</a>
                                    </div>
                                    <br><hr>
                                    <div class="row tasks">
                                        <div class="col-md-offset-2 col-xs-offset-2">
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td><a href="/faculty/events/edit/{{$event->id}}"><i class="fa fa-pencil fa-2x"></i></a></td>
                                                    <td><a href="/faculty/events/delete/{{$event->id}}"><i class="fa fa-trash fa-2x"></i></a></td>
                                                    <td><a href="/faculty/events/view/{{$event->id}}"><i class="fa fa-eye fa-2x"></i></a></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{$events->render()}}
    @include('layouts.resource')
@stop