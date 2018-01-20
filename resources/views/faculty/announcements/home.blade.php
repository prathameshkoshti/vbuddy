@extends('Layouts.faculty_layout')

@section('content')
    <style>
        body{
            background-color:#e8e8e8;
        }

        .animate{
            transition: transform .2s;
        }
        .animate:hover{
            transform: scale(1.7);
        }

    </style>
    <div class="row">
        <div >
            <h1 style="text-align:center">Faculty Announcements</h1>
        </div><br><br>
        <div class="col-md-offset-1 col-md-2">

            <div class="form-group">
                <div class=" card mb-3 " style="border-color: limegreen; border-style:solid; border-width:5px;width: 200px;height: 200px;padding:5%;background-color:limegreen">
                    <div class="card-header" style="text-align: center;color: white"><h3>Create <br>Announcements</h3><br>
                        <div class="animate">
                        <div class="create" style="right:50%; font-size:230%"><a href=""><span class="glyphicon glyphicon-plus-sign" style="color: white"></span></a></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
            <div class="col-md-2">
                <div class="form-group">
                    <div class=" card  mb-3 " style="border-color:coral ;border-style:solid; border-width:5px;width: 200px;height: 200px;padding: 5%;background-color: coral">
                        <div class="card-header " style="text-align: center;color:white"><h3>view <br> Announcements</h3><br>
                            <div class="animate">
                            <div style="right:50%; font-size:230%"><a href=""><span class="glyphicon glyphicon-list" style="color:white"></span></a></div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <div class=" card  mb-3 " style="border-color:cornflowerblue ;border-style:solid; border-width:5px;width: 200px;height: 200px;padding: 5%;background-color: cornflowerblue">
                    <div class="card-header " style="text-align: center;color:white"><h3>placements <br> Announcements</h3><br>
                        <div class="animate">
                        <div style="right:50%; font-size:230%"><a href=""> <i class="fa fa-briefcase fa-lg" aria-hidden="true" style="color: white"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <div class=" card mb-3 " style=" border: 5px solid orangered;width: 200px;height: 200px; padding:5%;background-color:orangered">
                    <div class="card-header" style="text-align: center;color: white"><h3>Exam<br>Announcements</h3><br>
                        <div class="animate">
                        <div style="right:50%; font-size:230%"><a href=""> <i class="fa fa-book fa-lg" aria-hidden="true" style="color:white"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <div class=" card mb-3 " style="border: 5px solid orange;;width: 200px;height: 200px; padding:5%;background-color:orange"><br>
                    <div class="card-header" style="text-align: center;color:white"><h3>Back</h3><br>
                        <div class="animate">
                        <div style="right:50%; font-size:230%"><a href=""> <i class="fa fa-chevron-circle-left fa-lg" aria-hidden="true" style="color:white"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop