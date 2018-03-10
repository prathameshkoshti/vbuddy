@extends('adminlte::page')

@section('title', 'AdminLTE :: Replacement Timetable')

@section('content_header')
    <h1 style="text-align:center">Replacement Timetable</h1>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <br>
        <div class="col-md-6 col-md-offset-3">
            <table class="table table-borderless">
                <tr>
                    <form method="post" action="/admin/replacement_timetables/make_replacement">
                        <td colspan="2">
                            <select name="sem" class="form-control">
                                <option disabled selected>Semester</option>                                
                                <option value="1">Sem 1</option>
                                <option value="2">Sem 2</option>
                                <option value="3">Sem 3</option>
                                <option value="4">Sem 4</option>
                                <option value="5">Sem 5</option>
                                <option value="6">Sem 6</option>
                                <option value="7">Sem 7</option>
                                <option value="8">Sem 8</option>
                            </select>
                        </td>
                        <td colspan="2">
                            <select name="branch" class="form-control">
                                <option disabled selected>Branch</option>                                
                                <option value="INFT">INFT</option>
                                <option value="CMPN">CMPN</option>
                                <option value="EXTC">EXTC</option>
                                <option value="ETRX">ETRX</option>
                                <option value="BIOM">BIOM</option>
                            </select>
                        </td>
                        <td>
                            <select name="division" class="form-control">
                                <option disabled selected>Division</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>
                        </td>
                        <td colspan="2" style="text-align:right">
                            <input type="date" name="date" class="form-control">
                        </td>                        
                        <td>
                            <button onClick="parent.location=''" type="submit" class="btn table-btn btn-success">
                                <span class="fa fa-plus" aria-hidden="true"></span> Create
                            </button>
                        </td>
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                    </form>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Replacement ID</th>
                    <th>Date</th>
                    <th>Replacement Subject</th>
                    <th>Replacement Faculty</th>
                    <th>Issued By</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($replacement_timetables as $replacement)
                    <tr>
                        <td>
                            {{$replacement->id}}
                        </td>
                        <td>
                            {{$replacement->replacement_id}}
                        </td>
                        <td>
                            {{$replacement->date}}
                        </td>
                        <td>
                            {{$replacement->replacement_subject}}
                        </td>
                        <td>
                            {{$replacement->replacement_faculty}}
                        </td>
                        <td>
                            {{$replacement->issued_by}}
                        </td>
                        <td>
                            @if($replacement->status === 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>
                            <a href="/admin/replacement_timetables/edit/{{$replacement->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                            &nbsp;
                            <a href="/admin/replacement_timetables/delete/{{$replacement->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@include('layouts.resource')
@stop