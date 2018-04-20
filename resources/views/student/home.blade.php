@extends('layouts.student_layout')
@section('title', 'Student :: Home')
@section('content_header')
    <h1 style="text-align:center">Student Portal</h1>
@stop
@section('content')
@include('layouts.cards_style')
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-xs-offset-2 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/student/faculty_announcements">
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
                    <a href="/student/placements">
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
                    <a href="/student/events">
                        <div class="event card">
                            <i class="fa fa-5x fa-calendar-check-o"></i>
                            <div class="card-title">
                                <h3>Events</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-2 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/student/timetable">
                        <div class="registration card">
                            <i class="fa fa-5x fa-calendar"></i>
                            <div class="card-title">
                                <h3>Timetable</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-1 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/student/ia_timetable/">
                        <div class="exam card">
                            <i class="fa fa-5x fa-pencil-square-o"></i>
                            <div class="card-title">
                                <h3>Exam Timetable</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-1 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/student/holidays/">
                        <div class="exam card">
                            <i class="fa fa-5x fa-calendar-plus-o"></i>
                            <div class="card-title">
                                <h3>Holiday</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-xs-offset-2 col-md-offset-2 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/student/feedback">
                        <div class="registration card">
                            <i class="fa fa-5x fa-comments"></i>
                            <div class="card-title">
                                <h3>Feedback</h3><br>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@include('layouts.resource')    
@stop