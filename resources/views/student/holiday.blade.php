@extends('layouts.student_layout')
@section('title', 'Student :: Holiday')
@section('content_header')
    <h1 style="text-align:center">Holidays</h1>
@stop
@section('content')

<div class="container-fluid">
    <div class="row">
        <br>
        <div class="col-md-4 table-responsive col-md-offset-4">
            <table class="table table-bordered">
                <tr>
                    <th>
                        Holiday Name
                    </th>
                    <th>
                        Date
                    </th>
                </tr>
                @foreach($holidays as $holiday)
                    <tr>
                        <td>
                            {{$holiday->name}}
                        </td>
                        <td>
                            {{$holiday->date}}
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="col-md-offset-4">
                {{$holidays->render()}}
            </div>
        </div>
    </div>
</div>

@stop