@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Profile : Change Password</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <form method="post" action="/admin/profile/update_password/" class="form form-group box-body">
                <input type="hidden" name="id" value="{{$profile}}">
                <table class="table table-hover">
                    <tr>
                        <td>
                            <input placeholder="Old Password" class="form-control" type="password" name="old_password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input placeholder="Old Password" class="form-control" type="password" name="new_password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input class="btn btn-success form-control" type="submit" value="Update">
                        </td>
                    </tr>
                </table>
                {{csrf_field()}}
		        {{method_field('PUT')}}
            </form>
        </div>
    </div>
    @include('layouts.resource')
@stop