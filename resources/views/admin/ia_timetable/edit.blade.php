@extends('adminlte::page')

@section('title', 'AdminLTE :: Placements News')

@section('content_header')

@stop
<style>

</style>

@section('content')
<h3 style="text-align: center">Edit Exam Details</h3>
<div class="row">
    <div class="col-md-offset-2 col-md-4">

        <form method="post" action="/admin/ia_timetable/update/{{$day->id}}" class="form form-group box-body">
            <div class="row">
                <div class="col-md-6 col-md-offset-4">
                    <table class="table">
                        <tr>
                            <td>
                                <input type="Date" class="form-control" value="{{$day->date}}" placeholder="" name="date">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="time" class="form-control" value="{{$day->start_time}}" placeholder="Time" name="start_time">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="time" class="form-control" value="{{$day->end_time}}" placeholder="Time" name="end_time">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="text" class="form-control" value="{{$day->subject}}" placeholder="Subject" name="subject">
                            </td>
                        </tr>
                        <tr>
                            <td colspan=2>
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