@extends('adminlte::page')

@section('title', 'AdminLTE :: Timetable')

@section('content_header')
    <h1 style="text-align:center">Timetable</h1>
@stop

<style>
    select {
        width: 100%;
        padding: 16px 20px;
        border: none;
        border-radius: 4px;
        background-color: #f1f1f1;
    }
    select:hover{
        display:inline-block;
    }


</style>

<script>
    function myFunction() {
        var x = document.getElementById("branch").value;
        var y = document.getElementById("semester").value;
        var z = document.getElementById("div").value;
        window.location.href="/admin/timetable/view/"+x+"/"+y+"/"+z;
    }
</script>

@section('content')

    <div class="row">
        <div class="col-md-4 col-md-offset-4">

            <form>
                <h3>Select Branch</h3>
                <select  class="form-control custom-select custom-select-mg mb-3" id="branch" name="branch">
                    <option value="INFT">INFT</option>
                    <option value="COMPS">COMPS</option>
                    <option value="ETRX">ETRX</option>
                    <option value="EXTC">EXTC</option>
                    <option value="BIOMED">BIOMED</option>
                </select>


                <h3>Select Semester</h3>
                <select class="form-control custom-select custom-select-mg mb-3" id="semester" name="semester" class="custom-select custom-select-mg mb-3">
                    <option value="1">SEM 1</option>
                    <option value="2">SEM 2</option>
                    <option value="3">SEM 3</option>
                    <option value="4">SEM 4</option>
                    <option value="5">SEM 5</option>
                    <option value="6">SEM 6</option>
                    <option value="7">SEM 7</option>
                    <option value="8">SEM 8</option>

                </select>

                <h3>Select Division</h3>
                <select class="form-control custom-select custom-select-mg mb-3" id="div" name="div" class="custom-select custom-select-mg mb-3">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>

                <div style="margin-top: 30px">
                <button type="button" class="form-control btn btn-success"  onclick="myFunction()">Get Timetable</button>
                </div>

            </form>
        </div>
    </div>







@stop