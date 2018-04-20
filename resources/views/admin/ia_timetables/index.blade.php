@extends('adminlte::page')

@section('title', 'AdminLTE :: Placements News')

@section('content_header')

@stop

@section('content')

    <style>
        a{
            color: #37474F;
        }
        a:hover{
            color: #01579B;
        }
        td{
            text-align: center;
        }
    </style>

    <h2 style="text-align: center">IA Timetable </h2>

    <div class="row">
        @for($i=1;$i<9;$i++)
        <div class="col-md-3" style="margin-left:70px;margin-top: 20px">
            <div class="card" style="">
                <table class="table table-borderless" style="background-color:rgba(255, 255, 255, 0.4);border-radius: 5px;">
                    <tr>
                        <td style="background-color:rgba(255, 255, 255, 0.3);" colspan="2"><p style="text-align: center;font-size: 20px; font-weight: bold">Semester {{$i}}</p></td>
                    </tr>

                    <tr>
                        <td style="background-color:rgba(255, 255, 255, 0.4);"><a href="/admin/ia_timetables/view/INFT/{{$i}}"><span class="glyphicon glyphicon-hand-right"> INFT</span> </a></td>
                        <td><a href="/admin/ia_timetables/view/CMPN/{{$i}}"><span class="glyphicon glyphicon-hand-right"> CMPN</span></a></td>
                    </tr>
                    <tr>
                        <td><a href="/admin/ia_timetables/view/EXTC/{{$i}}"><span class="glyphicon glyphicon-hand-right"> EXTC</span> </a></td>
                        <td style="background-color:rgba(255, 255, 255, 0.4);"><a href="/admin/ia_timetables/view/ETRX/{{$i}}"><span class="glyphicon glyphicon-hand-right"> ETRX</span> </a></td>
                    </tr>
                    <tr>
                        <td  style="background-color:rgba(255, 255, 255, 0.2);" colspan="2"><a href="/admin/ia_timetables/view/BIOM/{{$i}}"><span class="glyphicon glyphicon-hand-right"> BIOM</span> </a></td>
                    </tr>
                </table>
            </div>
        </div>
        @endfor
    </div>
<br><br>
@include('layouts.resource')
@stop
