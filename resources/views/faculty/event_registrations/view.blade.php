@extends('layouts.faculty_layout')

@section('title', 'AdminLTE :: Events')

@section('content_header')
    <h1 style="text-align:center">Events Registrations : {{$count->name}}</h1>
@stop


<script>
    function myFunction() {
        var input, filter, table, tr, td1,td2,i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td1 = tr[i].getElementsByTagName("td")[1];
            td2 = tr[i].getElementsByTagName("td")[2];
            if (td1 || td2) {
                if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover table-borderless">
                    <tr>
                        <th colspan="4" class="search-wrapper">
                            <div class="search-box">
                                <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Roll No or Name...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                            </div>
                        </th>
                        <td align="right" colspan=5><b>Registrations Count:{{$count->event_registration_count}}</b></td>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Roll No.</th>
                        <th>Name</th>
                        <th>Year</th>
                        <th>Branch</th>
                    </tr>
                    @foreach($students as $data)
                        <tr>
                            <td>{{ $data->student->id }}</td>
                            <td>{{ $data->student->roll }}</td>
                            <td>{{ $data->student->name }}</td>
                            <td>{{ $data->student->year }}</td>
                            <td>{{ $data->student->branch }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    @include('layouts.resource')
@stop