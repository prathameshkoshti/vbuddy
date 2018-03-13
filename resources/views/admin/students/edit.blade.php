@extends('adminlte::page')

@section('title', 'AdminLTE :: Students')

@section('content_header')
    <h1 style="text-align:center">Students</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Edit Student Details</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/admin/students/update/{{$student->id}}" class="form form-group box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Student Name" value="{{$student->name}}" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Roll No." value="{{$student->roll}}"  name="roll">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="email" class="form-control" placeholder="Email ID" value="{{$student->email}}" name="email">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" class="form-control" placeholder="Password(Change only if it is necessary.)" value="" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="year">
                                <option disabled>Year</option>
                                @if($student->year == "FE")    
                                    <option value="FE" selected>FE</option>
                                    <option value="SE">SE</option>
                                    <option value="TE">TE</option>
                                    <option value="BE">BE</option>
                                @elseif($student->year == "SE")
                                    <option value="FE">FE</option>
                                    <option value="SE" selected>SE</option>
                                    <option value="TE">TE</option>
                                    <option value="BE">BE</option>
                                @elseif($student->year == "TE")
                                    <option value="FE">FE</option>
                                    <option value="SE">SE</option>
                                    <option value="TE" selected>TE</option>
                                    <option value="BE">BE</option>
                                @else
                                    <option value="FE">FE</option>
                                    <option value="SE">SE</option>
                                    <option value="TE">TE</option>
                                    <option value="BE" selected>BE</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="sem">
                                <option disabled>Sem</option>
                                @if($student->sem == "1")    
                                    <option value="1" selected>Sem 1</option>
                                    <option value="2">Sem 2</option>
                                    <option value="3">Sem 3</option>
                                    <option value="4">Sem 4</option>
                                    <option value="5">Sem 5</option>
                                    <option value="6">Sem 6</option>
                                    <option value="7">Sem 7</option>
                                    <option value="8">Sem 8</option>
                                @elseif($student->sem == "2")
                                    <option value="1">Sem 1</option>
                                    <option value="2" selected>Sem 2</option>
                                    <option value="3">Sem 3</option>
                                    <option value="4">Sem 4</option>
                                    <option value="5">Sem 5</option>
                                    <option value="6">Sem 6</option>
                                    <option value="7">Sem 7</option>
                                    <option value="8">Sem 8</option>
                                @elseif($student->sem == "3")
                                    <option value="1">Sem 1</option>
                                    <option value="2">Sem 2</option>
                                    <option value="3" selected>Sem 3</option>
                                    <option value="4">Sem 4</option>
                                    <option value="5">Sem 5</option>
                                    <option value="6">Sem 6</option>
                                    <option value="7">Sem 7</option>
                                    <option value="8">Sem 8</option>
                                @elseif($student->sem == "4")
                                    <option value="1">Sem 1</option>
                                    <option value="2">Sem 2</option>
                                    <option value="3">Sem 3</option>
                                    <option value="4" selected>Sem 4</option>
                                    <option value="5">Sem 5</option>
                                    <option value="6">Sem 6</option>
                                    <option value="7">Sem 7</option>
                                    <option value="8">Sem 8</option>
                                @elseif($student->sem == "5")
                                    <option value="1">Sem 1</option>
                                    <option value="2">Sem 2</option>
                                    <option value="3">Sem 3</option>
                                    <option value="4">Sem 4</option>
                                    <option value="5" selected>Sem 5</option>
                                    <option value="6">Sem 6</option>
                                    <option value="7">Sem 7</option>
                                    <option value="8">Sem 8</option>
                                @elseif($student->sem == "6")
                                    <option value="1">Sem 1</option>
                                    <option value="2">Sem 2</option>
                                    <option value="3">Sem 3</option>
                                    <option value="4">Sem 4</option>
                                    <option value="5">Sem 5</option>
                                    <option value="6" selected>Sem 6</option>
                                    <option value="7">Sem 7</option>
                                    <option value="8">Sem 8</option>
                                @elseif($student->sem == "7")
                                    <option value="1">Sem 1</option>
                                    <option value="2">Sem 2</option>
                                    <option value="3">Sem 3</option>
                                    <option value="4">Sem 4</option>
                                    <option value="5">Sem 5</option>
                                    <option value="6">Sem 6</option>
                                    <option value="7" selected>Sem 7</option>
                                    <option value="8">Sem 8</option>
                                @elseif($student->sem == "8")
                                    <option value="1">Sem 1</option>
                                    <option value="2">Sem 2</option>
                                    <option value="3">Sem 3</option>
                                    <option value="4">Sem 4</option>
                                    <option value="5">Sem 5</option>
                                    <option value="6">Sem 6</option>
                                    <option value="7">Sem 7</option>
                                    <option value="8" selected>Sem 8</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="branch">
                                <option disabled>Branch</option>
                                @if($student->branch == "INFT")
                                    <option value="INFT" selected>INFT</option>
                                    <option value="COMP">CMPN</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                    <option value="BIOM">BIOM</option>
                                @elseif($student->branch == "CMPN")
                                    <option value="INFT">INFT</option>
                                    <option value="COMP" selected>CMPN</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                    <option value="BIOM">BIOM</option>
                                @elseif($student->branch == "EXTC")
                                    <option value="INFT">INFT</option>
                                    <option value="COMP">CMPN</option>
                                    <option value="EXTC" selected>EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                    <option value="BIOM">BIOM</option>
                                @elseif($student->branch == "BIOM")
                                    <option value="INFT">INFT</option>
                                    <option value="COMP">CMPN</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                    <option value="BIOM" selected>BIOM</option>
                                @else
                                    <option value="INFT">INFT</option>
                                    <option value="COMP">CMPN</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX" selected>ETRX</option>
                                    <option value="BIOM">BIOM</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="division">
                                <option disabled>Division</option>
                                @if($student->division == "A")
                                    <option value="A" selected>A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                @elseif($student->division == "B")
                                    <option value="A">A</option>
                                    <option value="B" selected>B</option>
                                    <option value="C">C</option>
                                @else
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C" selected>C</option>
                                @endif
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" class="form-control" placeholder="Year of Admission" value="{{$student->admission_year}}" name="admission_year">
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