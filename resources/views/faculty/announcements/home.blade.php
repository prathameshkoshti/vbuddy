@extends('Layouts.faculty_layout')

@section('content')
    <style>
        .animate{
            transition: ease-in-out 0.8s;
        }
        .animate:hover{
            transform: scale(1.2);
        }
        .card-header{
            text-align: center;
            color: #fff;
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto 0%;
            padding-top:10%;
        }
        .container-fluid{
            text-align:center;
        }
        .create{
            background-color: #00C853;
            box-shadow: 0 5px 15px 0 rgba(0,200,83,0.7), 6px 0px 15px 0 rgba(0,200,83,0.5);
            
        }
        .back{
            background-color: #FF5722;
            box-shadow: 0 5px 15px 0 rgba(255,87,34,0.7), 6px 0px 15px 0 rgba(255,87,34,0.5);
        }
        .view{
            background-color: #40C4FF;
            box-shadow: 0 5px 15px 0 rgba(64,196,255,0.7), 6px 0px 15px 0 rgba(64,196,255,0.5);
        }
        .card{
            position: relative;
            width: 200px;
            height: 200px;
            padding-left: 12%;
            padding-right: 12%;
            padding-top: 10%;
            padding-bottom: 10%;
            border-radius: 5px;
            text-align: center;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div >
                <h2 style="text-align:center">Faculty Announcements</h1>
            </div><br><br><br>

            <div class="col-md-2 col-xs-offset-2 col-xs-6 col-sm-2">
                <div class="form-group animate">
                    <a href="/faculty/faculty_announcements/create">
                        <div class="create card">
                            <div class="card-header">
                                <h3>Create Announcements</h3><br>
                                <span class="fa fa-3x fa-plus-circle"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-md-offset-1 col-xs-offset-2 col-xs-6">
                <div class="form-group animate">
                    <a href="/faculty/faculty_announcements/index">
                        <div class="view card">
                            <div class="card-header">
                                <h3>View Announcements</h3><br>
                                <i class="fa fa-3x fa-list"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-md-offset-1 col-xs-offset-2 col-xs-6">
                <div class="form-group animate">
                    <a onclick="window.history.back();">
                        <div class="back card mb-3"><br>
                            <div class="back card-header">
                                <h3>Back</h3><br><br>
                                <i class="fa fa-chevron-circle-left fa-3x"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop