@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculty Announcements')

@section('content_header')
    <h1 style="text-align:center">Timetable</h1>
@stop

<style>
    table {

        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: center;
        font-size:13px;
        border-bottom: 1px solid #ddd;
    }
    td:hover {
        background-color: #e8e8e8;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>


@section('content')

    <div class="row">

        @foreach($timetable as $lecture)
            @php
                $Branch=$lecture->branch;
                 $Semester=$lecture->sem;
                 $Division=$lecture->division;
            @endphp
            @break;
        @endforeach
            <h1>Branch:{{$Branch}}&nbsp&nbsp Semester:{{$Semester}}&nbsp&nbsp Division:{{$Division}}</h1>

        <div class="col-md-12">
            <form>
                <div class="" style="position:absolute; right: 20px">
                    <button type="submit" formaction="/admin/timetable/view/{{$Branch}}/{{$Semester}}/{{$Division}}" class="btn btn-success" name="submit"> Exit Update</button>
                </div><br><br>
                <table class="table">
                    <tr>
                        <th>Monday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "MONDAY")
                                <td style="text-align:center">
                                    <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                        <br><br>

                                    {{$lecture->start_time}}-{{$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    @foreach($temp1 as $sub)
                                        {{$sub}}&nbsp&nbsp
                                        {{$temp2[$i]}}&nbsp&nbsp
                                        {{$temp3[$i]}}&nbsp&nbsp
                                        <br>
                                        @php$i++; @endphp

                                    @endforeach
                                </td>

                            @endif
                        @endforeach
                    </tr>


                    <tr>

                        <th>Tuesday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "TUESDAY")
                                <td>

                                    <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                    <br><br>
                                    {{$lecture->start_time}}-{{$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    @foreach($temp1 as $sub)

                                        {{$sub}}&nbsp&nbsp
                                        {{$temp2[$i]}}&nbsp&nbsp
                                        {{$temp3[$i]}}&nbsp&nbsp
                                        <br>
                                        @php $i++;@endphp
                                    @endforeach

                                     </td>
                            @endif
                        @endforeach
                    </tr>




                    <tr>

                        <th>Wednesday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "WEDNESDAY")
                                <td>
                                    <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                    <br><br>
                                    {{$lecture->start_time}}-{{$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    @foreach($temp1 as $sub)
                                        {{$sub}}&nbsp&nbsp
                                        {{$temp2[$i]}}&nbsp&nbsp
                                        {{$temp3[$i]}}&nbsp&nbsp
                                        <br>
                                        @php $i++;@endphp
                                    @endforeach
                                </td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>

                        <th>Thursday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "THURSDAY")
                                <td>
                                    <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                    <br><br>

                                    {{$lecture->start_time}}-{{$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    @foreach($temp1 as $sub)
                                        {{$sub}}&nbsp&nbsp
                                        {{$temp2[$i]}}&nbsp&nbsp
                                        {{$temp3[$i]}}&nbsp&nbsp
                                        <br>
                                        @php $i++;@endphp
                                    @endforeach
                                    <br>

                                </td>
                            @endif
                        @endforeach


                    </tr>

                    <tr>

                        <th>Friday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "FRIDAY")
                                <td>

                                    <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                    <br><br>
                                    {{$lecture->start_time}}-{{$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    @foreach($temp1 as $sub)
                                        {{$sub}}&nbsp&nbsp
                                        {{$temp2[$i]}}&nbsp&nbsp
                                        {{$temp3[$i]}}&nbsp&nbsp
                                        <br>
                                        @php $i++;@endphp
                                    @endforeach
                                    <br>

                                </td>



                            @endif
                        @endforeach
                    </tr>

                </table>

            </form>

        </div>
    </div>


@stop