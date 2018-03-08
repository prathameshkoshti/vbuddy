@extends('layouts.faculty_layout')

@section('title', 'Faculty :: Event Registrations')

@section('content_header')
    <h1 style="text-align:center">Event Registrations</h1>
@stop


<script>
    function myFunction() {
        var input, filter, table, tr, td0,td1,i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td0 = tr[i].getElementsByTagName("td")[0];
            td1 = tr[i].getElementsByTagName("td")[1];
            if (td0 || td1) {
                if (td0.innerHTML.toUpperCase().indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
                                <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Event Name or Committee Name...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Event Name</th>
                        <th>Committee Name</th>
                        <th>Registration Count</th>
                        <th>View Records</th>
                    </tr>
                    @foreach($events as $value)
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->commitee_name }}</td>
                        <td>{{ $value->event_registration_count }}</td>
                        <td>
                            <a href="/faculty/event_registrations/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="pagination-wrapper">
        <div class="paginate">
            {{$events->render()}}
        </div>
    </div>
    @include('layouts.resource')
@stop