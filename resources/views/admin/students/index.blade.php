@extends('adminlte::page')

@section('title', 'AdminLTE :: Students')

@section('content_header')
    <h1 style="text-align:center">Students</h1>
@stop


<script>
    function myFunction() {
        var input, filter, table, tr, td, i;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1];
            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>

<style>

    * {
        box-sizing: border-box;
    }

    #myInput {
        width: 80%;
        font-size: 18px;
        padding: 10px 10px 10px 10px;
        margin-bottom: 10px;
        border: 2px solid #5BB91D;
    }


    #myTable {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #ddd;
        font-size: 18px;
    }

    #myTable th, #myTable td {
        text-align: left;
        padding: 12px;
    }

    #myTable tr {
        border-bottom: 1px solid #ddd;
    }

    #myTable tr.header, #myTable tr:hover {
        background-color: #f1f1f1;
    }
</style>

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1 table-responsive">
            <table id="myTable" class="table table-hover" >
                <tr class="header">
                    <th colspan=5>
                    </th>

                    <th colspan="2">
                        <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for Name...." title="Type in a name" size="10" style="font-weight: normal">
                    </th>
                    <th >
                                <button onClick="parent.location='/admin/students/create'" type="button" class="btn btn-success table-btn">
                                    <span class="fa fa-plus" aria-hidden="true"></span> Create
                                </button>
                    </th>
                </tr>
                <tr class="header">
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Roll No.</th>
                    <th>Year</th>
                    <th>Branch</th>
                    <th>Division</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach ($students as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->roll }}</td>
                    <td>{{ $value->year }}</td>
                    <td>{{ $value->branch }}</td>
                    <td>{{ $value->division }}</td>  
                    @if( $value->status == 1)
                        <td>Active</td>
                    @else
                        <td>Inactive</td>
                    @endif
                    <td>
                        <a href="/admin/students/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="/admin/students/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                        &nbsp;
                        <a href="/admin/students/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
    {{$students->render()}}
    @include('layouts.resource')
    <style>
        .table-btn{
            margin-left:10%;
            padding: 10px 10px;
            font-size:18px;
        }
    </style>
@stop