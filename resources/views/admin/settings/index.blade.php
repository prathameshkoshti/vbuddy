@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculties')

@section('content_header')
    <h1 style="text-align:center">Settings</h1>
@stop

<style>
    h3{
        text-align: center;
    }

    input[type="checkbox"]{
        width: 20px; /*Desired width*/
        height: 10px; /*Desired height*/
    }
</style>

@section('content')

    <div class="modal fade" id="promote_sem" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Password</h5>
                </div>
                    <form method="post">
                    <div class="modal-body col-sm-12">
                                <input type="password" class="form-control search" id="password" name="password" placeholder="Enter Password" style=" border-radius: 100px !important;">
                    </div>
                    <div class="modal-footer"><br>
                        <div style="float: right">&nbsp &nbsp&nbsp &nbsp<button type="submit" class="btn btn-primary" formaction="/admin/settings/promote_sem">Submit</button></div>
                        <div style="float:right "> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>
                    </div>
                        {{csrf_field()}}
                        {{method_field('PUT')}}
                    </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="promote_year" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Password</h5>
                </div>
                <form method="post">
                    <div class="modal-body col-sm-12">
                        <input type="password" class="form-control search" id="password" name="password" placeholder="Enter Password" style=" border-radius: 100px !important;">
                    </div>
                    <div class="modal-footer"><br>
                        <div style="float: right">&nbsp &nbsp&nbsp &nbsp<button type="submit" class="btn btn-primary" formaction="/admin/settings/promote_year">Submit</button></div>
                        <div style="float:right "> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>
                    </div>
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="demote_sem" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Password</h5>
                </div>
                <form method="post">
                    <div class="modal-body col-sm-12">
                        <input type="password" class="form-control search" id="password" name="password" placeholder="Enter Password" style=" border-radius: 100px !important;">
                    </div>
                    <div class="modal-footer"><br>
                        <div style="float: right">&nbsp &nbsp&nbsp &nbsp<button type="submit" class="btn btn-primary" formaction="/admin/settings/demote_sem">Submit</button></div>
                        <div style="float:right "> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>
                    </div>
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="demote_year" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Password</h5>
                </div>
                <form method="post">
                    <div class="modal-body col-sm-12">
                        <input type="password" class="form-control search" id="password" name="password" placeholder="Enter Password" style=" border-radius: 100px !important;">
                    </div>
                    <div class="modal-footer"><br>
                        <div style="float: right">&nbsp &nbsp&nbsp &nbsp<button type="submit" class="btn btn-primary" formaction="/admin/settings/demote_year">Submit</button></div>
                        <div style="float:right "> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>
                    </div>
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                </form>
            </div>
        </div>
    </div>





<div class="container">
    <div class="row"><br><br>
        <div class="col-md-4 col-xs-offset-1" style="background-color:rgba(0,0,0,0.2)">
            <div>
                <h3>Promote</h3>
            </div>
            <br><br><br>
            <div class="col-md-2 col-md-offset-1">
                <button name="promote_sem" class="btn btn-success" data-toggle="modal" data-target="#promote_sem">
                    <span class="fa fa-level-up" aria-hidden="true"></span>&nbsp&nbsp Semester Wise
                </button><br><br>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <button name="promote_year" class="btn btn-success" data-toggle="modal" data-target="#promote_year">
                    <span class="fa fa-level-up" aria-hidden="true"></span>&nbsp&nbsp Year Wise
                </button><br><br>
            </div>
        </div>

        <div class="col-md-4 col-xs-offset-1" style="background-color:rgba(0,0,0,0.2)">
            <div>
                <h3 >Demote</h3>
            </div>
            <br><br><br>
            <div class="col-md-2 col-md-offset-1">
                <button type="button" name="demote_sem" class="btn btn-success" data-toggle="modal" data-target="#demote_sem">
                    <span class="fa fa-level-down" aria-hidden="true"></span>&nbsp&nbsp Semester Wise
                </button><br><br>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#demote_year">
                    <span class="fa fa-level-down" aria-hidden="true"></span>&nbsp&nbsp Year Wise
                </button><br><br>
            </div>
        </div>
    </div>

    <br><br><br>


    {{--Reset Table--}}
    <form method="post">
    <div class="modal fade" id="reset" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Enter Password</h5>
                </div>
                    <div class="modal-body col-sm-10">
                        <input type="password" class="form-control search" id="password" name="password" placeholder="Enter Password" style=" border-radius: 100px !important;">
                    </div>
                    <div class="modal-footer"><br>
                        <div style="float: right">&nbsp &nbsp&nbsp &nbsp<button type="submit" class="btn btn-primary" formaction="/admin/settings/reset">Submit</button></div>
                        <div style="float:right "> <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></div>
                    </div>
                    {{csrf_field()}}
                    {{method_field('PUT')}}
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-md-9 col-md-offset-1" style="background-color:rgba(0,0,0,0.2)">
                <h3>Reset Database  &nbsp<span class="fa fa-database" aria-hidden="true"></span></h3>
                <div class="form-check col-lg-4 col-md-offset-1">
                    <input class="form-check-input" name="table[]" type="checkbox" value="events">
                    <label class="form-check-label" for="events">Events</label><br>
                    <input class="form-check-input" name="table[]" type="checkbox" value="announcements">
                    <label class="form-check-label" for="announcements">Announcements</label><br>
                    <input class="form-check-input" name="table[]" type="checkbox" value="placements">
                    <label class="form-check-label" for="placements">Placements</label><br>
                    <input class="form-check-input" name="table[]" type="checkbox" value="placements_registration">
                    <label class="form-check-label" for="placements_registration">Placement Registration</label><br>
                    <input class="form-check-input" name="table[]" type="checkbox" value="events_registration">
                    <label class="form-check-label" for="events_registration">Events Registration</label><br><br>


                    <button type="button" class="form-control btn btn-success" data-toggle="modal" data-target="#reset">
                        <span class="fa fa-trash" aria-hidden="true" style="color:black"></span>&nbsp&nbsp Reset Database
                    </button><br><br>

                    {{csrf_field()}}
                    {{method_field('PUT')}}
                </div>
            </div>
        </div>
        </form>
    </div>


    @include('layouts.resource')
    @stop