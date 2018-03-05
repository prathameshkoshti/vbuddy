@extends('adminlte::page')

@section('title', 'AdminLTE :: Placements News')

@section('content_header')
    <h1 style="text-align:center">Placements News</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <table class="table table-hover">
                <tr>
                    <td colspan=8>
                        <div class="col-md-offset-9">
                            <button onClick="parent.location='/admin/placements/create'" type="button" class="btn btn-success table-btn">
                                <span class="fa fa-plus" aria-hidden="true"></span> Create
                            </button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Branch</th>
                    <th>Issued By</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                @foreach ($placements as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->head }}</td>
                    <td>{{ $value->year }}</td>
                    <td>{{ $value->branch }}</td>
                    <td>{{ $value->issued_by }}</td>
                    @if( $value->status == 1)
                        <td>Active</td>
                    @else
                        <td>Inactive</td>
                    @endif
                    <td>
                        <a href="/admin/placements/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;                         
                        <a href="/admin/placements/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        <a href="/admin/placements/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{$placements->render()}}
    @include('layouts.resource')
    <style>
        .table-btn{
            margin-left:60%;
        }
    </style>
@stop