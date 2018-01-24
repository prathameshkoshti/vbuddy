@extends('adminlte::page')

@section('title', 'AdminLTE :: Events')

@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">View Event</h4>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            Name
                        </td>
                        <td>
                            {{$event->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Details
                        </td>
                        <td>
                            {{$event->details}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Commitee Name
                        </td>
                        <td>
                            {{$event->commitee_name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Year
                        </td>
                        <td>
                            {{$event->year}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Branch
                        </td>
                        <td>
                            {{$event->branch}}
                        </td>    
                    </tr>
                    <tr>
                        <td>
                            Date
                        </td>
                        <td>
                            {{$event->date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Time
                        </td>
                        <td>
                            {{$event->time}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Location
                        </td>
                        <td>
                            {{$event->location}}
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td>
                            Price
                        </td>
                        <td>
                            Rs. {{$event->price}}
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td>
                            Contact Name
                        </td>
                        <td>
                            {{$event->contact_name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact No.
                        </td>
                        <td>
                            {{$event->contact_no}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="button" class="form-control btn btn-warning" value="Edit" onclick="parent.location='/admin/events/edit/{{$event->id}}'">
                        </td>
                        <td>
                            <input type="button" class="form-control btn btn-danger" value="Delete" onclick="parent.location='/admin/events/delete/{{$event->id}}'">
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