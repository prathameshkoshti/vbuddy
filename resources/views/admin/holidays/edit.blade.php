@extends('adminlte::page')

@section('title', 'AdminLTE :: Holidays')

@section('content_header')
    <h1 style="text-align:center">Holidays</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Edit Holiday Details</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/admin/holidays/update/{{$holiday->id}}" class="form form-group box-body">
        {{--  {{dd($holiday)}}  --}}
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table">
                    <tr>
                        <td>
                            <input type="text" class="form-control" value="{{ $holiday->name }}" placeholder="Holiday Name" name="name" style="text-transform: uppercase">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="date" class="form-control" value="{{ $holiday->date }}" placeholder="Date" name="date">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="submit" class="form-control btn btn-success" value="Submit" name="submit">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        {{csrf_field()}}
		{{method_field('PUT')}}
    </form>
    @include('layouts.resource')
@stop