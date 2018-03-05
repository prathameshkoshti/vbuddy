@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculties')

@section('content_header')
    <h1 style="text-align:center">Student Users</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Student Details</h4>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>Name:</td>
                        <td>{{$student->name}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$student->email}}</td>
                    </tr>
                    <tr>
                        <td>
                            Password:
                        </td>
                        <td>
                            {{$student->password}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Roll No.:
                        </td>
                        <td>
                            {{$student->roll}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Year/Sem:
                        </td>
                        <td>
                            {{$student->year}}/{{$student->sem}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Branch:
                        </td>
                        <td>
                            {{$student->branch}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Division:
                        </td>
                        <td>
                            {{$student->division}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Admission Year:
                        </td>
                        <td>
                            {{$student->admission_year}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <button class="btn btn-danger" onClick="window.history.back()">Go Back</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @include('layouts.resource')
@stop