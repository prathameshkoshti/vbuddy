@extends('layouts.faculty_layout')
@section('title', 'Faculty :: Home')
@section('content_header')
    <h1 style="text-align:center">Faculty Portal</h1>
@stop
@section('content')
@include('layouts.cards_style')
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-xs-offset-2 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/faculty/faculty_announcements">
                        <div class="announcement card">
                            <i class="fa fa-5x fa-bullhorn"></i>
                            <div class="card-title">
                                <h3>Announcements</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-1 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/faculty/placements">
                        <div class="placement card">
                            <i class="fa fa-5x fa-briefcase"></i>
                            <div class="card-title">
                                <h3>Placements</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-1 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/faculty/placement_registrations">
                        <div class="placementregistration card">
                            <i class="fa fa-5x fa-briefcase"></i>
                            <div class="card-title">
                                <h3>Placement Registrations</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-2 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/faculty/events">
                        <div class="event card">
                            <i class="fa fa-5x fa-calendar-o"></i>
                            <div class="card-title">
                                <h3>Events</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-1 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/faculty/event_registrations">
                        <div class="registration card">
                            <i class="fa fa-5x fa-calendar-check-o"></i>
                            <div class="card-title">
                                <h3>Event Registrations</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-1 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/faculty/ia_timetables/">
                        <div class="exam card">
                            <i class="fa fa-5x fa-pencil-square-o"></i>
                            <div class="card-title">
                                <h3>Exam Timetable</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop