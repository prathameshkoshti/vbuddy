@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculty Announcements')

@section('content_header')
    <h1 style="text-align:center">Timetable</h1>
@stop

<style>
    td{
        text-align: center  ;
        font-size:15px;
    }
</style>

@section('content')
    <h1>Timetable View</h1>


    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-hover">





                    <tr>
                        <th>Tuesday</th>
                        @foreach($timetable as $lecture)
                            @if($lecture->day == "TUESDAY")
                                <td>
                                    {{$lecture->start_time}}<br>
                                    @php  $temp1= explode(" ",$lecture->subject)@endphp
                                    @php  $temp2= explode(" ",$lecture->teacher)@endphp
                                    @php  $temp3= explode(" ",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    @foreach($temp1 as $sub)
                                        {{$i+1}}
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
                                    {{$lecture->start_time}}<br>
                                    @php  $temp1= explode(" ",$lecture->subject)@endphp
                                    @php  $temp2= explode(" ",$lecture->teacher)@endphp
                                    @php  $temp3= explode(" ",$lecture->block)@endphp
                                    @php $i=0;@endphp
                                    @foreach($temp1 as $sub)
                                        {{$i+1}}
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



                </table>
            </div>
        </div>
    </div>


@stop