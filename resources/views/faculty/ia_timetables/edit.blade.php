@extends('layouts.faculty_layout')
@section('title', 'Faculty :: Home')

<style>

</style>

@section('content')
<h3 style="text-align: center">Edit Exam Details</h3>
<div class="row">
    <div class="col-md-offset-4 col-md-4">

        <form method="post" action="/faculty/ia_timetables/update/{{$day->id}}" class="form form-group box-body"><br>
            <div class="row">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <input type="Date" class="form-control" value="{{$day->date}}" placeholder="" name="date"><br>                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="time" class="form-control" value="{{$day->start_time}}" placeholder="Time" name="start_time"><br>                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="time" class="form-control" value="{{$day->end_time}}" placeholder="Time" name="end_time"><br>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{$day->subject}}" placeholder="Subject" name="subject"><br>                        
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="form-control btn btn-success" value="Submit" name="submit">
                        </td>
                    </tr>
                </table>
            </div>
            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
        @include('layouts.resource')

    </div>

</div>
@stop