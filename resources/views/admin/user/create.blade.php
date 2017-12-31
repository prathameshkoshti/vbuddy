@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Holiday</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Create New Holiday</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/admin/users/store" class="form form-group box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Faculty Name" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" class="form-control" placeholder="Email ID" name="email">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" class="form-control" placeholder="Password" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Role" name="role">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="form-control btn btn-success" value="Submit" name="submit">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        {{csrf_field()}}
		{{method_field('PUT')}}
    </form>
@stop