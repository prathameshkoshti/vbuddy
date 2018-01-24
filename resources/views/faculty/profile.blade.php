@extends('layouts.faculty_layout')

@section('title', 'AdminLTE :: Profile')

@section('content_header')
    <h1 style="text-align:center">Profile</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-3 col-md-6">
            <form method="post" action="/faculty/profile/update/" class="form form-group box-body">
                <input type="hidden" name="id" value="{{$profile->id}}">
                <table class="table table-borderless">
                    <tr>
                        <td colspan=2 align="center">
                                <i class="fa fa-user-circle-o fa-5x" aria-hidden="true"></i>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Name:
                        </td>
                        <td>
                            <input class="form-control" type="text" name="name" value="{{$profile->name}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td>
                            <input class="form-control" type="text" name="email" value="{{$profile->email}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="btn btn-success" type="submit" value="Update"><br><br>
                            <a href="/faculty/profile/change_password">Change Password</a>
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