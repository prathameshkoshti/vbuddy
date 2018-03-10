@extends('adminlte::page')

@section('title', 'AdminLTE :: Replacement Timetable')

@section('content_header')
    <h1 style="text-align:center">Replacement Timetable</h1>
@stop
<script>
    function myFunction() {
        var day = document.getElementById("day").value;
        var date = document.getElementById("date").value;
        var sem = document.getElementById("sem").value;
        var branch = document.getElementById("branch").value;
        var div = document.getElementById("division").value;
        var subject = document.getElementById("subject").value;
        window.location.href="/admin/replacement_timetables/create/"+day+"/"+date+"/"+sem+"/"+branch+"/"+div+"/"+subject;
    }
</script>
@section('content')
<div class="container-fluid">
    <form>
        <div class="row">
            <div class="centered col-md-12">
                <h4>Timetable for {{$date}}/{{$day}}</h4>
            </div>
            <div class="col-md-12">
                <br>
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <table class="table table-borderless" style="background-color: rgba(0,0,0,0);">
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
                                                <td>Faculty</td>
                                            </tr>
                                        </table>
                                    </td>
                                    @php
                                        $i=1;
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
                                                    @php
                                                        $temp1 = explode(',', $timetable->subject);
                                                        $temp2 = explode(',', $timetable->teacher);
                                                    @endphp
                                                    @foreach($temp1 as $subject)
                                                        <td>
                                                            <input type="hidden" name="replacement_id{{$i}}" value="{{$timetable->id}}">
                                                            {{$subject}}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach($temp2 as $teacher)
                                                        <td>
                                                            {{$teacher}}
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            </table>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            Select Subject:
                        </td>
                        <td>
                            <select id="subject" name="subject" class="form-control">
                                @foreach($timetables as $timetable)
                                    @if($timetable->subject != null)
                                        <option value="{{$timetable->subject}}">{{'('.$timetable->start_time.' - '.$timetable->end_time.') '.$timetable->subject}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="hidden" id="day" value="{{$day}}">
                            <input type="hidden" id="date" value="{{$date}}">
                            <input type="hidden" id="sem" value="{{$sem}}">
                            <input type="hidden" id="branch" value="{{$branch}}">
                            <input type="hidden" id="division" value="{{$division}}">
                            <button type="button" class="form-control btn btn-success"  onclick="myFunction()">Make Replacement</button>                
                        </td>
                    </tr>
                </table>
            </div>
        </div> 
    </form>
</div>
@include('layouts.resource')
@stop