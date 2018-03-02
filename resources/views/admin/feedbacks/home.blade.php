@extends('adminlte::page')

@section('title', 'AdminLTE :: V-Buddy')

@section('content_header')
    <h1 style="text-align:center">Feedbacks</h1>
@stop

@section('content')
    <div class="row">
        <br>
        <br>
        <br>
        <div class="col-md-4 col-md-offset-4">
            <form method="post" action="/admin/feedbacks/index">
                <select name="branch" class="form-control" required>
                    <option selected disabled value="null">Branch</option>
                    <option value="INFT">INFT</option>
                    <option value="CMPN">CMPN</option>
                    <option value="EXTC">EXTC</option>
                    <option value="ETRX">ETRX</option>
                    <option value="BIOM">BIOM</option>
                </select><br>
                <select name="sem" class="form-control" required>
                    <option selected disabled value="null">Semester</option>
                    <option value="1">Sem 1</option>
                    <option value="2">Sem 2</option>
                    <option value="3">Sem 3</option>
                    <option value="4">Sem 4</option>
                    <option value="5">Sem 5</option>
                    <option value="6">Sem 6</option>
                    <option value="7">Sem 7</option>
                    <option value="8">Sem 8</option>
                </select><br>
                <select name="division" class="form-control" required>
                    <option value="null" disabled selected>Division</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
                <br>
                <input name="submit" type="submit" class="btn btn-success form-control" value="Get Feedbacks">
                {{csrf_field()}}
		        {{method_field('PUT')}}
            </form>
        </div>
    </div><br><br>
    @include('layouts.resource')
@stop