@extends('adminlte::page')

@section('title', 'AdminLTE')

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
                            <input type="password" class="form-control" placeholder="Password" value="{{$student->password}}" name="password">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <select class="form-control" name="year">
                                <option disabled>Year</option>
                                @if($student->yaer == "FE")    
                                    <option value="FE" selected>FE</option>
                                    <option value="SE">SE</option>
                                    <option value="TE">TE</option>
                                    <option value="BE">BE</option>
                                @elseif($student->yaer == "SE")
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
                            <select class="form-control" name="branch">
                                <option disabled>Branch</option>
                                @if($student->branch == "INFT")
                                    <option value="INFT" selected>INFT</option>
                                    <option value="COMP">COMP</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                @elseif($student->branch == "COMP")
                                    <option value="INFT">INFT</option>
                                    <option value="COMP" selected>COMP</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                @elseif($student->branch == "EXTC")
                                    <option value="INFT">INFT</option>
                                    <option value="COMP">COMP</option>
                                    <option value="EXTC" selected>EXTC</option>
                                    <option value="ETRX">ETRX</option>
                                @else
                                    <option value="INFT">INFT</option>
                                    <option value="COMP">COMP</option>
                                    <option value="EXTC">EXTC</option>
                                    <option value="ETRX" selected>ETRX</option>
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
@stop