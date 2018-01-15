@extends('layouts.faculty_layout')
    
@section('content')
<div class="row">
        <div class="col-md-offset-9">
            <button onClick="parent.location='/faculty/placements/create'" type="button" class="btn btn-success">
                <span class="fa fa-plus" aria-hidden="true"></span> Create
             </button>
        </div>
    </div>
    
    <br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <table class="table table-hover">
                <tr>
                    <th>Head</th>
                    <th>Body</th>
                    <th>Year</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                @foreach ($placements as $value)
                <tr>
                    <td>{{ $value->head }}</td>
                    <td>{{ $value->body }}</td>
                    <td>{{ $value->year }}</td>
                    <td>{{ $value->branch }}</td>
                    @if( $value->status == 1)
                        <td>Active</td>
                    @else
                        <td>Inactive</td>
                    @endif
                    <td>
                        <a href="/faculty/placements/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        <a href="/faculty/placements/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @include('layouts.resource')
@stop