@extends('layouts.student_layout')
@section('title', 'Student :: Placements')
@section('content_header')
    <h1 style="text-align:center">Placements</h1>
@stop
@include('layouts.resource')
@section('content')

<div class="container-fluid">
    <br>
        <div class="row">    
                <div class="col-md-6 col-md-offset-3 banner">
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
                    <hr>
                    @if($isRegistered)
                    <button type="button" class="btn btn-success button table-btn">
                        <span class="fa fa-check" aria-hidden="true"></span>  Registered
                    </button>
                    @else
                    <button onClick="parent.location='/student/placement/register/{{$placement->id}}'" type="button" class="btn btn-success button table-btn">
                        <span class="fa fa-plus" aria-hidden="true"></span>  Register
                    </button>
                    @endif
                </div>        
        </div>
</div>

@stop