@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculties')

@section('content_header')
    <h1 style="text-align:center">Faculty Users</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Edit User Details</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/admin/users/update/{{$user->id}}" class="form form-group box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Faculty Name" value="{{$user->name}}" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="branch">
                                <option disabled>Branch</option>
                                @if($user->branch == "INFT")
                                    <option value="INFT" selected>INFT</option>
                                    <option value="CMPN">CMPN</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                    <option value="BIOM">BIOM</option>
                                @elseif($user->branch == "CMPN")
                                    <option value="INFT">INFT</option>
                                    <option value="CMPN" selected>CMPN</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                    <option value="BIOM">BIOM</option>
                                @elseif($user->branch == "EXTC")
                                    <option value="INFT">INFT</option>
                                    <option value="CMPN">CMPN</option>
                                    <option value="EXTC" selected>EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                    <option value="BIOM">BIOM</option>
                                @elseif($user->branch == "ETRX")
                                    <option value="INFT">INFT</option>
                                    <option value="CMPN">CMPN</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX" selected>ETRX</option>
                                    <option value="BIOM">BIOM</option>
                                @elseif($user->branch == "BIOM")
                                    <option value="INFT">INFT</option>
                                    <option value="CMPN">CMPN</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                    <option value="BIOM" selected>BIOM</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="abbreviation" value="{{$user->abbreviation}}" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" class="form-control" placeholder="Email ID" value="{{$user->email}}" name="email">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" class="form-control" placeholder="Password (Change only if it is necessary)" value="" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="role">
                                <option disabled>Role</option>
                                @if($user->role == "Admin")
                                    <option value="Admin" selected>Admin</option>
                                    <option value="Faculty">Faculty</option>
                                    <option value="Exam Coordinator">Exam Coordinator</option>
                                    <option value="Placement Coordinator">Placement Coordinator</option>
                                    <option value="Event Coordinator">Event Coordinator</option>
                                    <option value="Academic Coordinator">Academic Coordinator</option>
                                @elseif($user->role == "Faculty")
                                    <option value="Admin">Admin</option>
                                    <option value="Faculty" selected>Faculty</option>
                                    <option value="Exam Coordinator">Exam Coordinator</option>
                                    <option value="Placement Coordinator">Placement Coordinator</option>
                                    <option value="Event Coordinator">Event Coordinator</option>
                                    <option value="Academic Coordinator">Academic Coordinator</option>
                                @elseif($user->role == "Exam Coordinator")
                                    <option value="Admin">Admin</option>
                                    <option value="Faculty">Faculty</option>
                                    <option value="Exam Coordinator" selected>Exam Coordinator</option>
                                    <option value="Placement Coordinator">Placement Coordinator</option>
                                    <option value="Event Coordinator">Event Coordinator</option>
                                    <option value="Academic Coordinator">Academic Coordinator</option>
                                @elseif($user->role == "Placement Coordinator")
                                    <option value="Admin">Admin</option>
                                    <option value="Faculty">Faculty</option>
                                    <option value="Exam Coordinator">Exam Coordinator</option>
                                    <option value="Placement Coordinator" selected>Placement Coordinator</option>
                                    <option value="Event Coordinator">Event Coordinator</option>
                                    <option value="Academic Coordinator">Academic Coordinator</option>
                                @elseif($user->role == "Event Coordinator")
                                    <option value="Admin">Admin</option>
                                    <option value="Faculty">Faculty</option>
                                    <option value="Exam Coordinator">Exam Coordinator</option>
                                    <option value="Placement Coordinator">Placement Coordinator</option>
                                    <option value="Event Coordinator" selected>Event Coordinator</option>
                                    <option value="Academic Coordinator">Academic Coordinator</option>
                                @else
                                    <option value="Admin">Admin</option>
                                    <option value="Faculty">Faculty</option>
                                    <option value="Exam Coordinator">Exam Coordinator</option>
                                    <option value="Placement Coordinator">Placement Coordinator</option>
                                    <option value="Event Coordinator">Event Coordinator</option>
                                    <option value="Academic Coordinator" selected>Academic Coordinator</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" class="form-control btn btn-success" value="Update" name="submit">
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