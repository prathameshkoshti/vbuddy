@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculty Announcements')

@section('content_header')
    <h1 style="text-align:center">Timetable</h1>
@stop

<style>
    td{
        font-size:13px;
        text-align: center;
    }
    .submit{
        font-weight: bold;
        font-size: 15px;
    }
    table>tr>td{
        background-color: rgba(0,0,0,1) !important;
    }
</style>


@section('content')

    <div class="row">
        <form>
        <div class="col-md-12 table-responsive">

                <table class="table table-bordered">


                    @foreach($timetable as $lecture)
                        @php
                            $Branch=$lecture->branch;
                            $Semester=$lecture->sem;
                            $Division=$lecture->division;
                        @endphp
                        @break;
                    @endforeach

                    <h1>Branch:{{$Branch}}&nbsp&nbsp Semester:{{$Semester}}&nbsp&nbsp Division:{{$Division}}</h1>

                    <tr>
                        <th>Monday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "MONDAY")
                                <td style="text-align:center">
                                    {{$lecture->start_time.' - '.$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    <table class="table">
                                        @foreach($temp1 as $sub)
                                        <tr>
                                            <td>{{$sub}}</td>
                                            <td>{{$temp2[$i]}}</td>
                                            <td>{{$temp3[$i]}}</td>
                                        </tr>                                    
                                        @php $i++;@endphp
                                    @endforeach
                                    </table>
                                </td>

                            @endif
                        @endforeach
                    </tr>

                    <tr>

                        <th>Tuesday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "TUESDAY")
                                <td>
                                    {{$lecture->start_time.' - '.$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    <table class="table">
                                        @foreach($temp1 as $sub)
                                        <tr>
                                            <td>{{$sub}}</td>
                                            <td>{{$temp2[$i]}}</td>
                                            <td>{{$temp3[$i]}}</td>
                                        </tr>                                    
                                        @php $i++;@endphp
                                    @endforeach
                                    </table>
                                </td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>

                        <th>Wednesday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "WEDNESDAY")
                                <td>
                                    {{$lecture->start_time.' - '.$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    <table class="table">
                                        @foreach($temp1 as $sub)
                                        <tr>
                                            <td>{{$sub}}</td>
                                            <td>{{$temp2[$i]}}</td>
                                            <td>{{$temp3[$i]}}</td>
                                        </tr>                                    
                                        @php $i++;@endphp
                                    @endforeach
                                    </table>
                                </td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>
                        <th>Thursday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "THURSDAY")
                                <td>
                                    {{$lecture->start_time.' - '.$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    <table class="table">
                                        @foreach($temp1 as $sub)
                                        <tr>
                                            <td>{{$sub}}</td>
                                            <td>{{$temp2[$i]}}</td>
                                            <td>{{$temp3[$i]}}</td>
                                        </tr>                                    
                                        @php $i++;@endphp
                                    @endforeach
                                    </table>
                                </td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>

                        <th>Friday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "FRIDAY")
                                <td>
                                    {{$lecture->start_time.' - '.$lecture->end_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    <table class="table">
                                        @foreach($temp1 as $sub)
                                        <tr>
                                            <td>{{$sub}}</td>
                                            <td>{{$temp2[$i]}}</td>
                                            <td>{{$temp3[$i]}}</td>
                                        </tr>                                    
                                        @php $i++;@endphp
                                    @endforeach
                                    </table>
                                </td>
                            @endif
                        @endforeach
                    </tr>

                    <tr>
                        <br>
                        <th>Saturday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "SATURDAY")
                                <td>
                                    {{$lecture->start_time}}<br>
                                    @php  $temp1= explode(",",$lecture->subject)@endphp
                                    @php  $temp2= explode(",",$lecture->teacher)@endphp
                                    @php  $temp3= explode(",",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    <table class="table">
                                        @foreach($temp1 as $sub)
                                        <tr>
                                            <td>{{$sub}}</td>
                                            <td>{{$temp2[$i]}}</td>
                                            <td>{{$temp3[$i]}}</td>
                                        </tr>                                    
                                        @php $i++;@endphp
                                    @endforeach
                                    </table>
                                </td>
                            @endif
                        @endforeach
                    </tr>
                </table>
                <div class="submit col-md-offset-4 col-md-3">
                <button type="submit" formaction="/admin/timetable/view/edit/{{$Branch}}/{{$Semester}}/{{$Division}}" class="form-control btn btn-success" name="submit">Update</button>
                </div><br><br>
            </div>
        </form>
    </div>
@stop