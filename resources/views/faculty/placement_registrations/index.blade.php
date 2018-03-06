@extends('layouts.faculty_layout')

@section('title', 'Faculty :: Placements')

@section('content_header')
    <h1 style="text-align:center">Placements</h1>
@stop

@section('content')
<br>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <tr>
                        <th>Placement Name</th>
                        <th>Registration Count</th>
                        <th>View Records</th>
                    </tr>
                    @foreach($placements as $value)
                    <tr>
                        <td>{{ $value->head }}</td>
                        <td>{{ $value->placement_registration_count }}</td>
                        <td>
                            <a href="/faculty/placement_registrations/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{$placements->render()}}
    @include('layouts.resource')
@stop