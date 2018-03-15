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
            <div class="col-md-6 col-md-offset-3 banner">
            <br>
            <h3 class="centered">{{$announcement->head}}</h3>
            <br>
            <h4>
                {{$announcement->body}}
            </h4>
            <br>
            <hr>
            <p>Year: {{$announcement->year}}</p>
            <p>Branch: {{$announcement->branch}}</p>
            <p>Branch: {{$announcement->division}}</p>
            @if($announcement->file_name)
                @for($i=0;$i<count($file_name);$i++)
                    <a href="/student/faculty_announcements/download/{{$announcement->id}}/{{$file_name[$i]}}">{{$original_filename[$i]}}</a><br>
                @endfor
            @else
                No file attached by issuer.
            @endif
            <hr>
            <br>
            <p style="text-align:right">Issued By: {{$issued_by->name}}</p>
            <br>
        </div>        
    </div>
</div>

@stop