@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculties')

@section('content_header')
    <h1 style="text-align:center">Faculty Users</h1>
@stop


<script>
    function myFunction() {
        var input, filter, table, tr, td1,td3,i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td1 = tr[i].getElementsByTagName("td")[1];
            td3 = tr[i].getElementsByTagName("td")[3];
            if (td1 || td3) {
                if (td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1) {
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
        <div class="col-md-10 col-md-offset-1 table-responsive">
            <table id="myTable" class="table table-hover">
                <tr class="header">
                    <th colspan="5">
                        <div class="search-wrapper input-group">
                            <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Faculty Name or Role...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                        </div>
                    </th>

                    <th>
                        <div>
                                <button onClick="parent.location='/admin/users/create'" type="button" class="btn btn-success table-btn">
                                <span class="fa fa-plus" aria-hidden="true"></span> Create
                            </button>
                        </div>
                    </th>
                </tr>
                <tr class="header">
                    <th>ID</th>
                    <th>Faculty Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($users as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->role }}</td>
                    @if( $value->status == 1)
                        <td>Active</td>
                    @else
                        <td>Inactive</td>
                    @endif
                    <td>
                        <a href="/admin/users/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;                         
                        <a href="/admin/users/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                        &nbsp;&nbsp;&nbsp;&nbsp; 
                        <a href="/admin/users/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    <div class="pagination-wrapper">
        <div class="paginate">
            {{$users->render()}}
        </div>
    </div>
    @include('layouts.resource')
@stop