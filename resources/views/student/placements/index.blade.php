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
        <div class="col-md-6 col-md-offset-3">
            @foreach($placements as $placement)      
                <div class="col-md-12 banner">
                    <br>
                    <h4>{{$placement->head}}</h4>
                    <p style="text-align:right">Year: {{$placement->year}}</p>
                    <p style="text-align:right">Branch: {{$placement->branch}}</p>
                    <hr>
                    <button onClick="parent.location='/student/placements/view/{{$placement->id}}'" type="button" class="student-btn btn btn-success table-btn">
                        <span class="fa fa-eye" aria-hidden="true"></span>  View
                    </button>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="pagination-wrapper">
            <div class="paginate">
                {{$placements->links()}}
            </div>
        </div>
    </div>
</div>

@stop