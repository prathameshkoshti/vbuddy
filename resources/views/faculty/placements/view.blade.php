@extends('layouts.faculty_layout')

@section('title', 'V-Buddy :: Placement News')

@section('content_header')
    <h1 style="text-align:center">Placement News</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Edit Placement News</h4>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <b>Title :</b>
                        </td>
                        <td>
                            {{$placement->head}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Details</b>
                        </td>
                        <td>
                            {{$placement->body}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <b>Year :</b>
                            </div>
                       </td>
                        <td>
                            {{$placement->year}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                <b>Branch :</b>
                            </div>
                        </td>
                        <td>
                            {{$placement->branch}}
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <b>Date :</b>
                        </td>
                        <td>
                            {{$placement->date}}
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