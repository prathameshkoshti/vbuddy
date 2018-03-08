@extends('layouts.faculty_layout')

@section('title', 'Faculty :: Placements')

@section('content_header')
    <h1 style="text-align:center">Placements</h1>
@stop


<script>
    function myFunction() {
        var input, filter, table, tr, td0,i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td0 = tr[i].getElementsByTagName("td")[0];

            if (td0) {
                if (td0.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
        <div class="col-md-10 col-md-offset-1">
            <div class="table-responsive">
                <table id="myTable"  class="table table-hover table-borderless">
                    <tr>
                        <th colspan="3" class="search-wrapper">
                            <div class="search-box">
                                <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Announcement or Year...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th>Placement Name</th>
                        <th>Registration Count</th>
                        <th>View Records</th>
                    </tr>
                    @foreach($placements as $value)
                    <tr>
                        <td>{{ $value->head }}</td>
                        <td>{{ $value->placement_registration_count }}</td>
                        <td>
                            <a href="/faculty/placement_registrations/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
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