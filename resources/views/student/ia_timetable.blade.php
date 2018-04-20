@extends('layouts.student_layout')
@section('title', 'Student :: IA Timetable')
@section('content_header')
    <h1 style="text-align:center">IA Timetable</h1>
@stop
@include('layouts.resource')
@section('content')

<div class="container-fluid">
    <br>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <th>
                        Date
                    </th>
                    <th>
                        Time
                    </th>
                    <th>
                        Subject
                    </th>
                </tr>
                @foreach($ia_timetable as $data)
                <tr>
                    <td>
                        {{$data->date}}
                    </td>
                    <td>
                        {{$data->start_time}} - {{$data->end_time}}
                    </td>
                    <td>
                        {{$data->subject}}
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

@stop