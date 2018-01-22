@extends('adminlte::page')

@section('title', 'AdminLTE :: Students')

@section('content_header')
    <h1 style="text-align:center">Students</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Create New Student</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/admin/students/store" class="form form-group box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Student Name" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Roll No." name="roll">
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
                            <select class="form-control" name="year">
                                <option selected disabled>Year</option>
                                <option value="FE">FE</option>
                                <option value="SE">SE</option>
                                <option value="TE">TE</option>
                                <option value="BE">BE</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="branch">
                                <option selected disabled>Branch</option>
                                <option value="INFT">INFT</option>
                                <option value="COMP">COMP</option>
                                <option value="EXTC">EXTC</option>
                                <option value="ETRX">ETRX</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="division">
                                <option selected disabled>Division</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Year of Admission" name="admission_year">
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
    @include('layouts.resource')
@stop