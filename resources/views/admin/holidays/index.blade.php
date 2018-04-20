@extends('adminlte::page')

@section('title', 'AdminLTE :: Holidays')

@section('content_header')
    <h1 style="text-align:center">Holidays</h1>
@stop


<script>
    function myFunction() {
        var input, filter, table, tr, td1,td2, i;
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
                <table id="myTable" class="table table-hover">
                    <tr class="header">
                        <th colspan="4" class="search-wrapper">
                            <div class="search-box">
                                <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Holiday Name or Date...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                            </div>
                        </th>
                        <th>
                                <button onClick="parent.location='/admin/holidays/create'" type="button" class="btn btn-success table-btn">
                                    <span class="fa fa-plus" aria-hidden="true"></span> Create
                                </button>
                        </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Holiday Name</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($holiday as $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->date }}</td>
                        @if( $value->status == 1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td>
                            <a href="/admin/holidays/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp; 
                            <a href="/admin/holidays/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="pagination-wrapper">
        <div class="paginate">
            {{$holiday->render()}}
        </div>
    </div>
    @include('layouts.resource')
@stop