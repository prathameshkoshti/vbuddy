@extends('layouts.faculty_layout')
@section('title', 'Faculty :: Home')

@section('content')

    <style>
        table{
            font-size:15px;
        }
        a{
            color:#FFFFFF;
        }
        a:hover{
            color:#E62739;
        }
    </style>

    @php($inft="INFT")
    @php($cmpn="CMPN")

    <h2 style="text-align: center">IA Timetable </h2>

    <div class="row">
        @for($i=1;$i<9;$i++)
        <div class="col-md-3" style="margin-left:70px;margin-top: 20px">
            <div class="card" style="">
                <table class="table">
                    <tr style="background-color:#FC4445">
                        <td colspan="2"><p style="text-align: center;font-size: 20px; font-weight: bold">Semester {{$i}}</p></td>
                    </tr>

                    <tr>
                        <td style="background-color:#3FEEE6"><a href="/faculty/ia_timetables/view/INFT/{{$i}}"><span class="glyphicon glyphicon-hand-right"> INFT</span> </a></td>
                        <td style="background-color: #55BCC9"><a href="/faculty/ia_timetables/view/CMPN/{{$i}}"><span class="glyphicon glyphicon-hand-right"> CMPN</span></a></td>
                    </tr>
                    <tr>
                        <td style="background-color: #97CAEF"><a href="/faculty/ia_timetables/view/EXTC/{{$i}}"><span class="glyphicon glyphicon-hand-right"> EXTC</span> </a></td>
                        <td style="background-color: #CAFAFE"><a href="/faculty/ia_timetables/view/ETRX/{{$i}}"><span class="glyphicon glyphicon-hand-right"> ETRX</span> </a></td>
                    </tr>
                    <tr>
                        <td style="background-color: #BBC4EF"><a href="/faculty/ia_timetables/view/BIOM/{{$i}}"><span class="glyphicon glyphicon-hand-right"> BIOM</span> </a></td>
                    </tr>
                </table>
            </div>
        </div>
        @endfor
    </div>
<br><br>
@stop
