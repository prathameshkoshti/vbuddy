@extends('layouts.faculty_layout')

@section('content')

    <p>Dashboard <br>You are loged in as faculty</p>
    <div class="container">
        <div class="row">

            <div class="col-md-3" style="background-color: white">
                <div class="card" >
                    <div class="card-block" >
                        <p>
                        <h3 class="card-title" style="text-align:center;color: black">Designation:Faculty </h3>
                        <h4 class="card-text" style="color: black">Name:Kiran Wadkar <br> <br>Mail-id:kiranwadkar9@gmail.com <br><br>Contact No: 969782539</h4>
                        </p>
                    </div>
                </div>
            </div>

            <a href="">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-block" style="background-color:#ff6600">
                        <h1 class="card-title" style="background-color: #ff9933;text-align: center;font-size: 8em;color: white;padding: 10px"><i class="fa fa-bullhorn" aria-hidden="true"></i>
                            <h3 class="card-text"  style="background-color:#ff6600;color:white;text-align: center;padding-bottom: 13px">Announcements</h3></h1>
                    </div>
                </div>
            </div>
            </a>

            <a href="">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-block" style="background-color:#3300cc">
                        <h1 class="card-title" style="background-color:#3366ff;text-align: center;font-size: 8em;color: white;padding: 10px"><i class="fa fa-users" aria-hidden="true"></i>
                            <h3 class="card-text"  style="background-color:#3300cc;color:white;text-align: center;padding-bottom: 13px">Attendence</h3></h1>
                    </div>
                </div>
            </div>
            </a>


            <a href="">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-block" style="background-color:#E00000">
                        <h1 class="card-title" style="background-color: orangered;text-align: center;font-size: 8em;color: white;padding: 10px"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            <h3 class="card-text"  style="background-color:#E00000;color:white;text-align: center;padding-bottom: 13px">Exam Section</h3></h1>
                    </div>
                </div>
            </div>
            </a>

            <a href="">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-block" style="background-color:#33cc33">
                            <h1 class="card-title" style="background-color:#33ff66;text-align: center;font-size: 8em;color: white;padding: 10px"><i class="fa fa-briefcase" aria-hidden="true"></i>
                                <h3 class="card-text"  style="background-color:#33cc33;color:white;text-align: center;padding-bottom: 13px">Placements</h3></h1>
                        </div>
                    </div>
                </div>
            </a>

            <a href="">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-block" style="background-color:#ff3333">
                            <h1 class="card-title" style="background-color:#ff0000;text-align: center;font-size: 8em;color: white;padding: 10px"><i class="fa fa-calendar" aria-hidden="true"></i>
                                <h3 class="card-text"  style="background-color:#ff3333;color:white;text-align: center;padding-bottom: 13px">Events</h3></h1>
                        </div>
                    </div>
                </div>
            </a>

        </div>
    </div>
@stop