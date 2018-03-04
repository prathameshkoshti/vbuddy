@extends('layouts.faculty_layout')

@section('title', 'AdminLTE :: Events')

@section('content_header')
    <h1 style="text-align:center">Events Registrations : {{$count->name}}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <tr>
                        <td align="right" colspan=5><b>Registrations Count:{{$count->event_registration_count}}</b>  </td>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Roll No.</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Branch</th>
                    </tr>
                    @foreach($students as $data)
                        <tr>
                            <td>{{ $data->student->id }}</td>
                            <td>{{ $data->student->roll }}</td>
                            <td>{{ $data->student->name }}</td>
                            <td>{{ $data->student->year }}</td>
                            <td>{{ $data->student->branch }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        {{$students->render()}}
    </div>
    @include('layouts.resource')
@stop