@extends('layouts.faculty_layout')

@section('title', 'V-buddy :: Faculty Announcements')

@section('content_header')
    <h1 style="text-align:center">Faculty Announcements</h1>
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
                                <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Announcement or Year...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                            </div>
                        </th>
                        <th>
                            <button onClick="parent.location='/faculty/faculty_announcements/create'" type="button" class="btn btn-success table-btn">
                                <span class="fa fa-plus" aria-hidden="true"></span> Create
                            </button>
                        </th>
                    </tr>
                    <tr>
                        <th>Head</th>
                        <th>Year</th>
                        <th>Division</th>
                        <th>Issued By</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($announcements as $value)
                    <tr>
                        <td>{{ $value->head }}</td>
                        <td>{{ $value->year }}</td>
                        <td>{{ $value->division }}</td>
                        <td>{{ $value->user->name }}</td>
                        @if( $value->status == 1)
                            <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td>
                            <a href="/faculty/faculty_announcements/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            @if(Auth::user()->id == $value->issued_by)
                            <a href="/faculty/faculty_announcements/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/faculty/faculty_announcements/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="pagination-wrapper">
            <div class="paginate">
                {{$announcements->render()}}
            </div>
        </div>
    </div>
    @include('layouts.resource')
@stop