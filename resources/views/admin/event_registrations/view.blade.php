@extends('adminlte::page')

@section('title', 'AdminLTE :: Events')

@section('content_header')
    <h1 style="text-align:center">Events Registrations</h1>
@stop

<script>
    function myFunction() {
        var input, filter, table, tr, td1, td2, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td1 = tr[i].getElementsByTagName("td")[1];
            td2 = tr[i].getElementsByTagName("td")[2];

            if (td1 || td2) {
                if (td1.innerHTML.indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>


<style>

</style>



@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover table-borderless">
                    <tr class="header">
                        <th colspan="2"></th>
                        <th colspan="2">
                            <div class="input-group">

                                <input type="text"  id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Name or Roll No...." title="Type in a name" size="100" style=" border-radius: 100px !important;">

                            </div>
                        </th>

                        <th><b>Registrations Count:{{$count->event_registration_count}}</b></th>


                    </tr>
                    <tr class="header">
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
        <div class="pagination-wrapper">
            <div class="paginate">
                {{$students->render()}}
            </div>
        </div>
    </div>
    @include('layouts.resource')
@stop