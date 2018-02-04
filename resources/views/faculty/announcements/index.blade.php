@extends('layouts.faculty_layout')

@section('title', 'V-buddy :: Faculty Announcements')

@section('content_header')
    <h1 style="text-align:center">Faculty Announcements</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <tr>
                        <td colspan=7>
                            <button onClick="parent.location='/faculty/faculty_announcements/create'" type="button" class="btn btn-success table-btn">
                                <span class="fa fa-plus" aria-hidden="true"></span> Create
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th>Head</th>
                        <th>Body</th>
                        <th>Year</th>
                        <th>Branch</th>
                        <th>Division</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($announcements as $value)
                    <tr>
                        <td>{{ $value->head }}</td>
                        <td>{{ $value->body }}</td>
                        <td>{{ $value->year }}</td>
                        <td>{{ $value->branch }}</td>
                        <td>{{ $value->division }}</td> 
                        @if( $value->status == 1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td>
                            <a href="/faculty/faculty_announcements/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp; 
                            <a href="/faculty/faculty_announcements/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{$announcements->render()}}
    @include('layouts.resource')
@stop