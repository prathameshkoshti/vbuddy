@extends('adminlte::page')

@section('title', 'AdminLTE :: Replacement Timetable')

@section('content_header')
    <h1 style="text-align:center">Replacement Timetable</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="centered col-md-12">
            <h4>Create replacement lecture</h4>
        </div>
        <div class="col-md-8 col-md-offset-2 table-responsive">
            <form method="POST" action="/admin/replacement_timetables/store" class="form form-group box-body">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <table class="table table-borderless" style="background-color: rgba(0,0,0,0);">
                                <tr>
                                    <td>Time</td>
                                </tr>
                                <tr>
                                    <td>Subject</td>
                                </tr>
                                <tr>
                                    <td>faculty</td>
                                </tr>
                            </table>
                        </td>
                        @php
                            $i = 1;
                        @endphp
                        @foreach($timetables as $timetable)
                            <td>
                                <table class="table table-borderless" style="background-color: rgba(0,0,0,0);">
                                    <tr>
                                        <td>
                                            {{$timetable->start_time}} - {{$timetable->end_time}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="replacement_id{{$i}}" value="{{$timetable->id}}">
                                            {{$timetable->subject}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {{$timetable->teacher}}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-borderless" style="background-color: rgba(0,0,0,0)">
                                    <tr>
                                        <td>
                                            Replacement
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input placeholder="Subject" type="text" name="subject{{$i}}" class="form-control">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="faculty{{$i}}" class="form-control">
                                                <option value="null" disabled selected>Select Faculty</option>
                                                @foreach($users as $user)
                                                    <option value="{{$user->abbrevation}}">{{$user->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            @php 
                                $i++;
                            @endphp
                        @endforeach
                    </tr>
                </table>
                <div class="centered">
                    {{method_field('PUT')}}
                    {{csrf_field()}}
                    <input type="hidden" name="date" value="{{$date}}">
                    <input type="submit" value="Make Replacement" class="btn btn-success">                    
                </div>
            </form>
        </div>
    </div>
</div>
@include('layouts.resource')
@stop