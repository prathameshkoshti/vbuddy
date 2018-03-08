@extends('adminlte::page')

@section('title', 'AdminLTE :: Events')

@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <tr>
                        <th>ID</th>
                        <th>Event Name</th>
                        <th>Commitee Name</th>
                        <th>Registration Count</th>
                        <th>View Records</th>
                    </tr>
                    @foreach($events as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->commitee_name }}</td>
                        <td>{{ $value->event_registration_count }}</td>
                        <td>
                            <a href="/admin/event_registrations/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="pagination-wrapper">
        <div class="paginate">
            {{$events->render()}}
        </div>
    </div>
    @include('layouts.resource')
@stop