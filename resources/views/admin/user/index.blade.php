@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Faculty Users</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-10">
            <button onClick="parent.location='/admin/users/create'" type="button" class="btn btn-success">
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
                    <th>Faculty Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->password }}</td>
                    <td>{{ $value->role }}</td>
                    @if( $value->status == 1)
                        <td>Active</td>
                    @else
                        <td>Inactive</td>
                    @endif
                    <td>
                        <a href="/admin/users/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        <a href="/admin/users/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="col-md-4">
            @if(Session :: has('update'))
                    <p class="flash label label-warning"><h5>{{Session :: get('update')}}</p></div>
            @endif
            @if(Session :: has('create'))
                    <p class="flash label label-success"><h5>{{Session :: get('create')}}</p></div>
            @endif
            @if(Session :: has('delete'))
                    <p class="flash label label-danger"><h5>{{Session :: get('delete')}}</p></div>
            @endif
    </div>
    <style>
        .fa-trash{
            color: red;
        }
        .fa-pencil{
            color:orange;
        }
        h5{
            color:black !important;
        }
    </style>
@stop