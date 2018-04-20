@extends('layouts.student_layout')
@section('title', 'Student :: Placements')
@section('content_header')
    <h1 style="text-align:center">Announcements</h1>
@stop
@include('layouts.resource')
@section('content')

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @foreach($announcements as $announcement)      
                <div class="col-md-12 banner">
                    <br>
                    <h3>{{$announcement->head}}</h3>
                    <p style="text-align:right">Year: {{$announcement->year}}</p>
                    <p style="text-align:right">Branch: {{$announcement->branch}}</p>
                    <hr>
                    <button onClick="parent.location='/student/faculty_announcements/view/{{$announcement->id}}'" type="button" class="student-btn btn btn-success table-btn">
                        <span class="fa fa-eye" aria-hidden="true"></span>  View
                    </button>
                </div>
            @endforeach
            <div class="row">
                <div class="pagination-wrapper">
                    <div class="paginate">
                        {{$announcements->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop