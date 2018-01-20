@extends('Layouts.faculty_layout')

@section('content')
    <style>
        body{
            background-color:#e8e8e8;
        }

        .animate{
            transition: transform .8s;
        }
        .animate:hover{
            transform: scale(1.2);
        }
        .card{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            z-index: -1;
        }
        .card:hover:after{
            box-shadow: 0 8px 12px 0 rgba(0, 0, 0, 0.5), 0 12px 40px 0 rgba(0, 0, 0, 0.19);
        }

    </style>
    <div class="row">
        <div >
            <h1 style="text-align:center">Faculty Announcements</h1>
        </div><br><br><br>

    <div class="col-md-offset-2 col-md-2 ">

            <div class="form-group animate">
                <a href="">
                <div class="card mb-3 " style="border-color: limegreen; border-style:solid; border-width:5px;width: 200px;height: 200px;padding:5%;background-color:limegreen">
                    <div class="card-header" style="text-align: center;color: white "><h3>Create <br>Announcements</h3><br>
                        <div class="create" style="right:50%; font-size:230%;z-index: 2"><span class="glyphicon glyphicon-plus-sign" style="color: white"></span></div>
                     </div>
                </div>
                </a>
            </div>

        </div>
            <div class="col-md-2 col-md-offset-1 ">
                <div class="form-group animate">
                    <a href="">
                    <div class=" card  mb-3 " style="border-color:coral ;border-style:solid; border-width:5px;width: 200px;height: 200px;padding: 5%;background-color: coral">
                        <div class="card-header " style="text-align: center;color:white"><h3>view <br> Announcements</h3><br>

                            <div style="right:50%; font-size:230%;z-index: 2"><span class="glyphicon glyphicon-list" style="color:white"></span></div>

                        </div>
                    </div>
                    </a>
                </div>
        </div>


        <div class="col-md-2 col-md-offset-1 ">
            <div class="form-group animate">
                <a href="">
                <div class=" card mb-3 " style="border: 5px solid orange;;width: 200px;height: 200px; padding:5%;background-color:orange"><br>
                    <div class="card-header" style="text-align: center;color:white"><h3>Back</h3><br>
                        <div style="right:50%; font-size:230%;z-index: 2"> <i class="fa fa-chevron-circle-left fa-lg" aria-hidden="true" style="color:white"></i></div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
@stop