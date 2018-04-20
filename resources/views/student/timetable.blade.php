@extends('layouts.student_layout')

@section('title', 'Student :: Timetable')

@section('content_header')
    <h1 style="text-align:center">Today's Timetable :: {{$day}}</h1>
@stop
<style>
    td{
        text-align: center;'
    }
</style>
@section('content')
<div class="conatiner-fluid">
    <div class="col-md-4 col-md-offset-4 table-responsive">
        <table class="table table-bordered">
                @foreach($timetables as $lecture)
                <tr>
                    <td>
                        {{$lecture->start_time.' - '.$lecture->end_time}}<br>                            
                        @php  $temp1= explode(",",$lecture->subject)@endphp
                        @php  $temp2= explode(",",$lecture->teacher)@endphp
                        @php  $temp3= explode(",",$lecture->block)@endphp
                        @php $i=0;@endphp
                    </td>
                    <td>
                        <table class="table table-borderless" style="background-color:rgba(0, 0, 0, 0);">
                            @foreach($temp1 as $sub)
                                <tr>
                                    <td>{{$sub}}</td>
                                    <td>{{$temp2[$i]}}</td>
                                    <td>{{$temp3[$i]}}</td>
                                </tr>                                    
                                @php $i++;@endphp
                            @endforeach
                        </table>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@stop