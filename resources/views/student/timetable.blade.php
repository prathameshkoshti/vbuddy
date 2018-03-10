@extends('layouts.student_layout')

@section('title', 'Student :: Timetable')

@section('content_header')
    <h1 style="text-align:center">Today's Timetable</h1>
@stop
<style>
    td{
        text-align: center;'
    }
</style>
@section('content')
<div class="conatiner-fluid">
    <div class="col-md-12 table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>{{$day}}</th>
                @foreach($timetables as $lecture)
                    <td>
                        {{$lecture->start_time.' - '.$lecture->end_time}}<br>                            
                        @php  $temp1= explode(",",$lecture->subject)@endphp
                        @php  $temp2= explode(",",$lecture->teacher)@endphp
                        @php  $temp3= explode(",",$lecture->block)@endphp
                        @php $i=0;@endphp
                        <table class="table" style="background-color:rgba(0, 0, 0, 0);">
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
                @endforeach
            </tr>
        </table>
    </div>
</div>
@stop