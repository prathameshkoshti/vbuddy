@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="text-align:center">Faculty Users</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Create New Faculty User</h4>
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
                            <select name="role" class="form-control">
                                <option disabled selected>Role</option>
                                <option value="Admin">Admin</option>
                                <option value="Faculty">Faculty</option>
                                <option value="Exam Coordinator">Exam Coordinator</option>
                                <option value="Placement Coordinator">Placement Coordinator</option>
                                <option value="Event Coordinator">Event Coordinator</option>
                                <option value="Academic Coordinator">Academic Coordinator</option>
                            </select>
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