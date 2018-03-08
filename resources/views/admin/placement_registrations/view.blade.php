@extends('adminlte::page')

@section('title', 'AdminLTE :: Placements')

@section('content_header')
    <h1 style="text-align:center">Placement Registrations: {{$count->head}}</h1>
@stop
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <tr>
                        <td align="right" colspan=5><b>Registrations Count: {{$count->placement_registration_count}}</b>  </td>
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
        <div class="pagination-wrapper">
            <div class="paginate">
                {{$students->render()}}
            </div>
        </div>
    </div>
    @include('layouts.resource')
@stop