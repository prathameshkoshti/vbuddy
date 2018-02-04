@extends('adminlte::page')

@section('title', 'AdminLTE :: Placements News')

@section('content_header')

@stop
<style>
    table{
        text-align: center;
        align-content: center;
    }
    p{
        text-align: center;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th colspan="3"><p>INFT SEM-7</p></th>
                    </tr>

                    <tr>
                        <th><p>Date</p></th>
                        <th><p>Start Time</p></th>
                        <th><p>End Time</p></th>
                        <th><p>Subject</p></th>
                    </tr>



                        @foreach($exam as $day)
                        <tr>
                            <td>{{$day->date}}</td>
                            <td>{{$day->start_time}}</td>
                            <td>{{$day->end_time}}</td>
                            <td>{{$day->subject}}</td>
                        </tr>
                            @endforeach


                </table>
            </div>
        </div>
    </div>

















@stop