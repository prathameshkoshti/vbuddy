@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculties')

@section('content_header')
    <h1 style="text-align:center">Faculty Users</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">User Details</h4>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>Name:</td>
                        <td>{{$user->name}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                        <td>
                            Password:
                        </td>
                        <td>
                            {{$user->password}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Abbreviation:
                        </td>
                        <td>
                            {{$user->abbreviation}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Role:
                        </td>
                        <td>
                            {{$user->role}}
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