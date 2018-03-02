@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculty Announcements')

@section('content_header')
    <h1 style="text-align:center">Timetable</h1>
@stop

<style>
    td{
        text-align: center  ;
        font-size:13px;
    }
    .edit{
        font-size: 15px;
    }
</style>


@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">


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
                                    {{$lecture->start_time}}<br>
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

                                    <br>
                                    <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                                </td>

                            @endif
                        @endforeach
                    </tr>


                    <tr>

                        <th>Tuesday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "TUESDAY")
                                <td>
                                    {{$lecture->start_time}}<br>
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
                                    <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                                      </td>
                            @endif
                        @endforeach
                    </tr>




                               <tr>

                                   <th>Wednesday</th>
                                   @foreach($timetable as $lecture)
                                       @if($lecture->day == "WEDNESDAY")
                                           <td>
                                               {{$lecture->start_time}}<br>
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
                                               <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>


                                           </td>
                                       @endif
                                   @endforeach
                                    </tr>

                    <tr>

                        <th>Thursday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "THURSDAY")
                                <td>
                                    {{$lecture->start_time}}<br>
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
                                    <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                                </td>
                            @endif
                        @endforeach


                    </tr>

                               <tr>

                                   <th>Friday</th>
                                   @foreach($timetable as $lecture)
                                       @if($lecture->day == "FRIDAY")
                                           <td>
                                               {{$lecture->start_time}}<br>
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
                                               <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

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
                                               @foreach($temp1 as $sub)
                                                   {{$sub}}&nbsp&nbsp
                                                   {{$temp2[$i]}}&nbsp&nbsp
                                                   {{$temp3[$i]}}&nbsp&nbsp
                                                   <br>
                                                   @php $i++;@endphp
                                                   <br>
                                                   <a href="/admin/timetable/edit/{{$lecture->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>

                                               @endforeach
                                           </td>
                                       @endif
                                   @endforeach
                               </tr>

                </table>
            </div>

        </div>
    </div>


@stop