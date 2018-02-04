@extends('layouts.faculty_layout')

@section('title', 'V-buddy :: Events')
@section('content')
    @include('layouts.cards_style')
    <div class="container-fluid">
        <div class="row">
            <div>
                <h2 style="text-align:center">Events</h1>
            </div>
            <br><br><br>

            <div class="col-md-2 col-xs-offset-2 col-xs-6 col-sm-2 card-holder">
                <div class="form-group animate">
                    <a href="/faculty/events/create">
                        <div class="create card">
                            <div class="card-header">
                                <h3>Create Event</h3><br>
                                <i class="fa fa-5x fa-plus-circle"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-md-offset-1 col-xs-offset-2 col-xs-6 card-holder">
                <div class="form-group animate">
                    <a href="/faculty/events/index">
                        <div class="view card">
                            <div class="card-header">
                                <h3>View Events</h3><br>
                                <i class="fa fa-5x fa-list"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-md-2 col-md-offset-1 col-xs-offset-2 col-xs-6 card-holder">
                <div class="form-group animate">
                    <a onclick="window.history.back();">
                        <div class="back card mb-3"><br>
                            <div class="back card-header">
                                <h3>Back</h3><br><br>
                                <i class="fa fa-chevron-circle-left fa-5x"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@stop