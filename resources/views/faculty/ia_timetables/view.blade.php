@extends('layouts.faculty_layout')
@section('title', 'Faculty :: Home')

<style>
    table{
        text-align: center;
        align-content: center;
        background-color: white;
        border-collapse: collapse;
        border: 1px solid black;
    }
    td,tr{
        color:#FFFFFF;
    }
    p{
        text-align: center;
    }
    tr:hover{
        background-color: #ddd;
    }
</style>

@section('content')

    @foreach($exam as $day)
        @php
            $semester=$day->sem;
        @endphp
        @break;
    @endforeach
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th colspan="5"><p>SEM-{{$semester}}</p></th>
                    </tr>

                    <tr>
                        <th><p>Date</p></th>
                        <th><p>Start Time</p></th>
                        <th><p>End Time</p></th>
                        <th><p>Subject</p></th>
                        <th><p>Actions</p></th>
                    </tr>



                        @foreach($exam as $day)
                        <tr>
                            <td>{{$day->date}}</td>
                            <td>{{$day->start_time}}</td>
                            <td>{{$day->end_time}}</td>
                            <td>{{$day->subject}}</td>
                            <td><a href="/faculty/ia_timetables/edit/{{$day->id}}" style="color: orange"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a></td>
                        </tr>
                            @endforeach


                </table>
            </div>
        </div>
    </div>


@stop