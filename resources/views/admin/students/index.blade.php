@extends('adminlte::page')

@section('title', 'AdminLTE :: Students')

@section('content_header')
    <h1 style="text-align:center">Students</h1>
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
                if (td2.innerHTML.indexOf(filter) > -1 || td1.innerHTML.toUpperCase().indexOf(filter) > -1  ) {
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
         <table id="myTable" class="table table-hover" >
             <tr class="header">

                 <th style="text-align:center" colspan="6">
                     <div class="input-group">
                     <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Name or Roll No...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                     </div>
                 </th>
                 <th>
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
                 <th size="130px">Action</th>
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
 <div class="pagination-wrapper">
    <div class="paginate">
        {{$students->render()}}
    </div>
</div>
 @include('layouts.resource')
 <style>
    .tablee-btn{
        margin-left: 10%; 
    }
 </style>
@stop