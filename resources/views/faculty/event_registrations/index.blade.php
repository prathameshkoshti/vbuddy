@extends('layouts.faculty_layout')

@section('title', 'Faculty :: Event Registrations')

@section('content_header')
    <h1 style="text-align:center">Event Registrations</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <tr>
                        <th>Event Name</th>
                        <th>Commitee Name</th>
                        <th>Registration Count</th>
                        <th>View Records</th>
                    </tr>
                    @foreach($events as $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->commitee_name }}</td>
                        <td>{{ $value->event_registration_count }}</td>
                        <td>
                            <a href="/faculty/event_registrations/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
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