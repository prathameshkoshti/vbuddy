@extends('layouts.faculty_layout')

@section('title', 'V-Buddy :: Faculty Announcements')

@section('content_header')
    <h1 style="text-align:center">Faculty Announcements</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">View Faculty Announcement</h4>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table table-borderless">
                    <tr>
                        <td><b>Title :</b></td>
                        <td>{{$announcement->head}}</td>
                    </tr>
                    <tr>
                        <td><b>Details :</b></td>
                        <td>{{$announcement->body}}</td>
                    </tr>
                    <tr>
                        <td>
                                <b>Year :</b>
                       </td>
                        <td>
                            {{$announcement->year}}
                        </td>
                    </tr>
                    <tr>
                        <td><b>Branch :</b></td>
                        <td>
                            {{$announcement->branch}}
                        </td>
                    </tr>
                    <tr>
                        <td width="100px">
                            <b>Division :</b>
                        </td>
                        <td>
                            {{$announcement->division}}
                        </td>
                    </tr>
                    <tr>
                        <td width="100px">
                            <b>Issued By :</b>
                        </td>
                        <td>
                            {{$announcement->user->name}}
                        </td>
                    </tr>
                    <tr>
                        <td width="100px"></td>
                        <td>
                            <button onclick="window.history.back();" class="btn form-control btn-danger">Back</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @include('layouts.resource')
@stop