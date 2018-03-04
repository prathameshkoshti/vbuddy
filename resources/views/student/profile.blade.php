@extends('layouts.student_layout')

@section('title', 'Student :: Profile')

@section('content_header')
    <h1 style="text-align:center">Profile</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-offset-4 col-md-4">
            <form method="post" action="/faculty/profile/update/" class="form form-group box-body">
                <input type="hidden" name="id" value="{{$user->id}}">
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
                            {{$user->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Email:
                        </td>
                        <td>
                            {{$user->email}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Roll No.:
                        </td>
                        <td>
                            {{$user->roll}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Branch:
                        </td>
                        <td>
                            {{$user->branch}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Year/Sem:
                        </td>
                        <td>
                            {{$user->year}}/{{$user->sem}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Division:
                        </td>
                        <td>
                            {{$user->division}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Admission Year:
                        </td>
                        <td>
                            {{$user->admission_year}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                                <a href="/student/profile/change_password">Change Password</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    @include('layouts.resource')
@stop