@extends('adminlte::page')

@section('title', 'AdminLTE :: Timetable')

@section('content_header')
    <h1 style="text-align:center">Edit Timetable</h1><br>
@stop

<style>
    .submit{
        margin-top:300px; !important;
    }
</style>

@section('content')

    <div class="row">
        <form method="post" action="" class="form form-group">
            <div class="col-md-offset-3 col-md-5 ">
                <table class="table table-responsive">

                    <tr>
                        <th>Start Time:</th>
                        <td>
                            <input type="time" class="form-control" name="start_time" value="{{$timetable->start_time}}">
                        </td>
                    </tr>

                    <tr>
                        <th>End Time:</th>
                        <td>
                            <input type="time" class="form-control" name="end_time" value="{{$timetable->end_time}}">
                        </td>
                    </tr>

                    <tr>
                        <th>Subject:</th>
                        <td>
                            <input type="text" class="form-control" name="subject" value="{{$timetable->subject}}">
                        </td>
                    </tr>

                    <tr>
                        <th>Faculty:</th>
                        <td>
                            <input type="text" class="form-control" name="teacher" value="{{$timetable->teacher}}">
                        </td>
                    </tr>

                    <tr>
                        <th>Block</th>
                        <td>
                            <input type="text" class="form-control" name="block" value="{{$timetable->block}}">

                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td><br>
                            <div style="width: 50%; margin-left: 25%">
                                <button type="submit" formaction="/admin/timetable/update/{{$timetable->id}}" class="form-control btn btn-success" name="submit">Update</button>
                            </div>
                        </td>
                    </tr>




                </table>
            </div>




            {{csrf_field()}}
            {{method_field('PUT')}}
        </form>
    </div>
@stop





