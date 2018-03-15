@extends('layouts.student_layout')
@section('title', 'Student :: Placements')
@section('content_header')
    <h1 style="text-align:center">Placements</h1>
@stop
@section('content')

<div class="container-fluid">
    <br>
        <div class="row">    
                <div class="col-md-6 col-md-offset-3">
                    <div class="banner">
                        <br>
                        <h3 class="centered">{{$placement->head}}</h3>
                        <br>
                        <h4>
                            {{$placement->body}}
                        </h4>
                        <br>
                        <hr>
                        <p>Year: {{$placement->year}}</p>
                        <p>Branch: {{$placement->branch}}</p>
                        <p style="text-align:right">Issued By: {{$issued_by->name}}</p>
                        @if($placement->file_name)
                            @for($i=0;$i<count($file_name);$i++)
                                <a href="/student/placements/download/{{$placement->id}}/{{$file_name[$i]}}">{{$original_filename[$i]}}</a><br>
                            @endfor
                        @else
                            No file attached by issuer.
                        @endif
                        <hr>
                        @if($isRegistered)
                        <button onClick="parent.location='/student/placements/register/{{$placement->id}}'" type="button" class="student-btn btn btn-success">
                            <span class="fa fa-check" aria-hidden="true"></span>  Registered
                        </button>
                        @else
                        <button onClick="parent.location='/student/placements/register/{{$placement->id}}'" type="button" class="student-btn btn btn-success">
                            <span class="fa fa-plus" aria-hidden="true"></span>  Register
                        </button>
                        @endif
                        <br>
                        <br>
                    </div>
                </div>        
        </div>
</div>
@include('layouts.resource')

@stop