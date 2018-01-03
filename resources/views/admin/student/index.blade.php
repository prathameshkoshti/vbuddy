@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Faculty Users</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-10">
            <button onClick="parent.location='/admin/students/create'" type="button" class="btn btn-success">
                <span class="fa fa-plus" aria-hidden="true"></span> Create
             </button>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Roll No.</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Year</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($students as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->roll }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->password }}</td>
                    <td>{{ $value->year }}</td>
                    <td>{{ $value->branch }}</td>
                    <td>{{ $value->division }}</td>  
                    @if( $value->status == 1)
                        <td>Active</td>
                    @else
                        <td>Inactive</td>
                    @endif
                    <td>
                        <a href="/admin/students/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="/admin/students/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    @include('layouts.resource')
@stop