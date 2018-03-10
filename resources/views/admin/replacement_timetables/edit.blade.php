@extends('adminlte::page')

@section('title', 'AdminLTE :: Replacement Timetable')

@section('content_header')
    <h1 style="text-align:center">Replacement Timetable</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <form action="/admin/replacement_timetables/update/{{$replacement->id}}" method="POST">
            <div class="centered col-md-12">
                <h4>Edit replacement lecture</h4>
            </div>
            <div class="col-md-4 col-md-offset-4">
                <table class="table table-bordered">
                    <tr>
                        <td>Time</td>
                        <td>{{$timetable->start_time.' - '.$timetable->end_time}}</td>
                        <td>Replacement</td>
                    </tr>
                    <tr>
                        <td>
                            Subject
                        </td>
                        <td>
                            {{$timetable->subject}}
                        </td>
                        <td>
                            <input type="text" class="form-control" name="replacement_subject" value="{{$replacement->replacement_subject}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Faculty                        
                        </td>
                        <td>
                            {{$timetable->teacher}}
                        </td>
                        <td>
                            <select class="form-control" name="replacement_faculty">
                                @foreach($users as $user)
                                    <option value="{{ $user->abbrevation }}"
                                        @if($replacement->replacement_faculty == $user->abbrevation)
                                            selected="selected"
                                        @endif
                                    >{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="centered">
                            <div>
                                {{csrf_field()}}
                                {{method_field('PUT')}}
                                <input type="submit" class="btn btn-success">
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>
@include('layouts.resource')
@stop