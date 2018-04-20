@extends('adminlte::page')

@section('title', 'AdminLTE :: Placements')

@section('content_header')
    <h1 style="text-align:center">Placements</h1>
@stop


<script>
    function myFunction() {
        var input, filter, table, tr, td1,i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td1 = tr[i].getElementsByTagName("td")[1];
            if (td1) {
                if (td1.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

@section('content')
<br>
    <div class="row">
        <div class="col-md-10 col-md-offset-2">
            <div class="table-responsive">
                <table id="myTable"  class="table table-hover table-borderless">
                    <tr class="header">
                        <th colspan="4" class="search-wrapper">
                            <div class="search-box">
                                <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Placement Name...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                            </div>
                        </th>
                    </tr>
                    <tr class="header">
                        <th>ID</th>
                        <th>Placement Name</th>
                        <th>Registration Count</th>
                        <th>View Records</th>
                    </tr>
                    @foreach($placements as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->head }}</td>
                        <td>{{ $value->placement_registration_count }}</td>
                        <td>
                            <a href="/admin/placement_registrations/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="pagination-wrapper">
        <div class="paginate">
            {{$placements->render()}}
        </div>
    </div>
    @include('layouts.resource')
@stop