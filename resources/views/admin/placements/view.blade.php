@extends('adminlte::page')

@section('title', 'AdminLTE :: Faculties')

@section('content_header')
    <h1 style="text-align:center">Placements</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Placements Details</h4>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>Title:</td>
                        <td>{{$placement->head}}</td>
                    </tr>
                    <tr>
                        <td>Details:</td>
                        <td>{{$placement->body}}</td>
                    </tr>
                    <tr>
                        <td>
                            Year:
                        </td>
                        <td>
                            {{$placement->year}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Branch:
                        </td>
                        <td>
                            {{$placement->branch}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Date:
                        </td>
                        <td>
                            {{$placement->date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Branch:
                        </td>
                        <td>
                            {{$placement->branch}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            File:
                        </td>
                        <td>
                            @if($attachment)
                                <a href="/admin/placements/download/{{$placement->file_name}}">{{$placement->original_filename}}</a>({{$attachment.' Bytes'}})
                            @else
                                No file attached by user.
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Issued By:
                        </td>
                        <td>
                            {{$placement->user->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <button class="btn btn-danger" onClick="window.history.back()">Go Back</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    @include('layouts.resource')
@stop