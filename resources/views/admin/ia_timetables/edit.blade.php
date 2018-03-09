@extends('adminlte::page')

@section('title', 'AdminLTE :: Placements News')

@section('content_header')

@stop
<style>

</style>

@section('content')
<h3 style="text-align: center">Edit Exam Details</h3>
<div class="row">
    <div class="col-md-offset-2 col-md-7">

        <form method="post" action="/admin/ia_timetables/update/{{$day->id}}" class="form form-group box-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-4">
                    <table class="table">

                        <tr>
                            <th>
                                <label for="date">Date</label>
                            </th>
                            <td>
                                <input type="Date" class="form-control" value="{{$day->date}}" placeholder="" name="date">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="start_time">Start Time</label>
                            </th>
                            <td>
                                <input type="time" class="form-control" value="{{$day->start_time}}" placeholder="Time" name="start_time">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="end_time">End Time</label>
                            </th>
                            <td>
                                <input type="time" class="form-control" value="{{$day->end_time}}" placeholder="Time" name="end_time">
                            </td>
                        </tr>

                        <tr>
                            <th>
                                <label for="subject">Subject</label>
                            </th>
                            <td>
                                <input type="text" style="text-transform: uppercase" class="form-control" value="{{$day->subject}}" placeholder="Subject" name="subject">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2>
                                <br>
                                <input type="submit" class="form-control btn btn-success" value="Submit" name="submit">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @include('layouts.resource')
    </div>
</div>
@stop