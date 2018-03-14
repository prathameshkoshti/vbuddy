@extends('layouts.faculty_layout')

@section('title', 'V-Buddy :: Events')

@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop

@section('content')

    <div class="row">
        <div class="">
            <h4 style="text-align:center">View Event Details</h4>
        </div>
    </div>
    <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table table-hover table-borderless">
                    <tr>
                        <td>
                            Name
                        </td>
                        <td colspan=2>
                            {{$event->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Details
                        </td>
                        <td colspan=2>
                            {{$event->details}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Commitee Name
                        </td>
                        <td colspan=2>
                            {{$event->commitee_name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Year
                        </td>
                        <td colspan=2>
                            {{$event->year}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Branch
                        </td>
                        <td colspan=2>
                            {{$event->branch}}
                        </td>    
                    </tr>
                    <tr>
                        <td>
                            Date
                        </td>
                        <td colspan=2>
                            {{$event->date}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Time
                        </td>
                        <td colspan=2>
                            {{$event->time}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Location
                        </td>
                        <td colspan=2>
                            {{$event->location}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Attached file:
                        </td>
                        <td>
                            @if($event->file_name)
                            <a href="/faculty/events/download/{{$event->file_name}}">{{$event->original_filename}}</a> ({{$attachment.' Bytes'}})
                            @else
                                No file attached by user.
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Price
                        </td>
                        <td colspan=2>
                            Rs. {{$event->price}}
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td>
                            Contact Name
                        </td>
                        <td colspan=2>
                            {{$event->contact_name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Contact No.
                        </td>
                        <td colspan=2>
                            {{$event->contact_no}}
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        @if(Auth::user()->id == $event->issued_by)        
        <div class="col-md-6 col-md-offset-3">
            <div class="col-md-4"><button class="btn btn-block btn-warning" onclick="parent.location='/faculty/events/edit/{{$event->id}}'"><i style="color:white" class="fa fa-pencil fa-lg" aria-hidden="true"></i> Edit</button></div>
            <div class="col-md-4"><button class="btn btn-block btn-danger" onclick="parent.location='/faculty/events/delete/{{$event->id}}'"><i style="color:white" class="fa fa-trash fa-lg" aria-hidden="true"></i> Delete</button></div>
            <div class="col-md-4"><button class="btn btn-block btn-primary" onclick="parent.location='/faculty/event_registrations/view/{{$event->id}}'"><i style="color:white" class="fa fa-eye fa-lg" aria-hidden="true"></i> Registrations</button></div>
        </div>
        <br>
        <br>
        <br>
        @endif
        {{csrf_field()}}
		{{method_field('PUT')}}
    </form>
    @include('layouts.resource')
@stop