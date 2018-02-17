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
        window.location.href="/admin/timetable/view/"+x+"/"+y+"/"+z,
        document.getElementById("demo").innerHTML = x;
    }
</script>

@section('content')

    <div class="row">
        <div class="col-md-3 col-md-offset-3">
<br><br><br>
            <form>
                <h3>Select Branch</h3>
                <select required id="branch" name="branch">
                    <option value="INFT">INFT</option>
                    <option value="COMPS">COMPS</option>
                    <option value="ETRX">ETRX</option>
                    <option value="EXTC">EXTC</option>
                    <option value="BIOMED">BIOMED</option>
                </select><br><br>

                <h3>Select Semester</h3>
                <select  id="semester" name="semester">
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
                <select id="div" name="div">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>

                <button type="button" onclick="myFunction()">Submit</button>

                <p id="demo"></p>

            </form>
        </div>
    </div>







@stop