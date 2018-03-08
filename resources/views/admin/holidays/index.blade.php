@extends('adminlte::page')

@section('title', 'AdminLTE :: Holidays')

@section('content_header')
    <h1 style="text-align:center">Holidays</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <td colspan="5">
                            <div class="col-md-offset-8">
                                <button onClick="parent.location='/admin/holidays/create'" type="button" class="btn btn-success table-btn">
                                    <span class="fa fa-plus" aria-hidden="true"></span> Create
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Holiday Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($holiday as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->date }}</td>
                        @if( $value->status == 1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td>
                            <a href="/admin/holidays/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp; 
                            <a href="/admin/holidays/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="pagination-wrapper">
        <div class="paginate">
            {{$holiday->render()}}
        </div>
    </div>
    @include('layouts.resource')
    <style>
        .table-btn{
            margin-left:60%;            
        }
    </style>
@stop