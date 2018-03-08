@extends('adminlte::page')

@section('title', 'AdminLTE :: V-Buddy')

@section('content_header')
    <h1 style="text-align:center">Feedbacks</h1>
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

@section('content')
    <div class="row">
        <h4 style="text-align:center">You are viewing feedbacks for {{$branch}} > Sem  {{$sem}} > Divison {{$division}}</h4><br>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover">

                    <tr class="header">
                        <th colspan=3>
                        </th>

                        <th colspan="2">
                            <div class="input-group">
                                <input type="text" id="myInput" class="search" onkeyup="myFunction()" placeholder="Search for Name or Roll No...." title="Type in a name" size="100" style=" border-radius: 100px !important;">
                            </div>
                        </th>
                    </tr>


                    <tr class="header">
                        <th>ID</th>
                        <th>Student Id</th>
                        <th>Student Name</th>
                        <th>Feedback No.</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td>
                                {{$feedback->id}}
                            </td>
                            <td>
                                {{$feedback->student->roll}}
                            </td>
                            <td>
                                {{$feedback->student->name}}
                            </td>
                            <td>
                                {{$feedback->feedback_no}}
                            </td>
                            <td>
                                    <a href="/admin/feedbacks/view/{{$feedback->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                            </td>
                        </tr>                                
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{$feedbacks->render()}}
    @include('layouts.resource')
@stop