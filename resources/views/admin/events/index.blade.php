@extends('adminlte::page')

@section('title', 'AdminLTE :: Events')

@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-9 col-md-offset-2">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td colspan="13">
                            <div class="col-md-offset-8">
                                <button onClick="parent.location='/admin/events/create'" type="button" class="btn btn-success table-btn">
                                    <span class="fa fa-plus" aria-hidden="true"></span> Create
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Event Name</th>
                        <th>Commitee Name</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($events as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->commitee_name }}</td>
                        @if( $value->status == 1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td>
                            <a href="/admin/events/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;                             
                            <a href="/admin/events/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp; 
                            <a href="/admin/events/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{$events->render()}}
    @include('layouts.resource')
    <style>
        .table-btn{
            margin-left:60%;            
        }
    </style>
@stop