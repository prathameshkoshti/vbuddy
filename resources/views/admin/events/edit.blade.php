@extends('adminlte::page')

@section('title', 'AdminLTE :: Events')

@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Edit Event</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/admin/events/update/{{$event->id}}" class="form form-group box-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-borderless">
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Event Name" name="name" value="{{$event->name}}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <textarea class="form-control" placeholder="Details" rows="6" name="details">{{$event->details}}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <select name="commitee_name" class="form-control">
                                <option disabled>Commitee Name</option>
                                <option>IEEE</option>
                                <option>ACM</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                            <td>
                                <div>
                                    <b>Year :</b>
                                </div>
                           </td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="year[]" type="checkbox" value="FE" {{in_array('FE', $year) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="fe">FE</label>
                                    <input class="form-check-input" name="year[]" type="checkbox" value="SE" {{in_array('SE', $year) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="se">SE</label>
                                    <input class="form-check-input" name="year[]" type="checkbox" value="TE" {{in_array('TE', $year) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="te">TE</label>
                                    <input class="form-check-input" name="year[]" type="checkbox" value="BE" {{in_array('BE', $year) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="be">BE</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <b>Branch :</b>
                                </div>
                            </td>
                            <td>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="branch[]" type="checkbox" value="INFT" {{in_array('INFT', $branch) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="inft">INFT</label>
                                    <input class="form-check-input" name="branch[]" type="checkbox" value="COMP" {{in_array('COMP', $branch) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="comp">COMP</label>
                                    <input class="form-check-input" name="branch[]" type="checkbox" value="EXTC" {{in_array('EXTC', $branch) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="extc">EXTC</label>
                                    <input class="form-check-input" name="branch[]" type="checkbox" value="ETRX" {{in_array('ETRX', $branch) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="etrx">ETRX</label>
                                </div>
                            </td>
                        </tr>
                    <tr>
                        <td colspan=2>
                            <input type="date" class="form-control" placeholder="Date" name="date" value="{{$event->date}}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Time" name="time" value="{{$event->time}}"> 
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Location" name="location" value="{{$event->location}}"> 
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Price" name="price" value="{{$event->price}}"> 
                        </td>
                    </tr>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Contact Name" name="contact_name" value="{{$event->contact_name}}"> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Contact No." name="contact_no" value="{{$event->contact_no}}"> 
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