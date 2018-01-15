@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Faculty Announcements</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-9">
            <button onClick="parent.location='/admin/faculty_announcements/create'" type="button" class="btn btn-success">
                <span class="fa fa-plus" aria-hidden="true"></span> Create
             </button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Head</th>
                    <th>Body</th>
                    <th>Year</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Issued By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                @foreach ($announcements as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->head }}</td>
                    <td>{{ $value->body }}</td>
                    <td>{{ $value->year }}</td>
                    <td>{{ $value->branch }}</td>
                    <td>{{ $value->division }}</td>
                    <td>{{ $value->issued_by }}</td>
                    @if( $value->status == 1)
                        <td>Active</td>
                    @else
                        <td>Inactive</td>
                    @endif
                    <td>
                        <a href="/admin/faculty_announcements/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        <a href="/admin/faculty_announcements/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @include('layouts.resource')
@stop