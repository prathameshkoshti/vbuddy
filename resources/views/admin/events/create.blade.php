@extends('adminlte::page')

@section('title', 'AdminLTE :: Events')

@section('content_header')
    <h1 style="text-align:center">Events</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Create New Event</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/admin/events/store" class="form form-group box-body">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <table class="table table-borderless">
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Event Name" name="name">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <textarea class="form-control" placeholder="Details" rows="6" name="details"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <select name="commitee_name" class="form-control">
                                <option disabled selected>Commitee Name</option>
                                <option>IEEE</option>
                                <option>ACM</option>
                                <option>Other</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Year :</b>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="year[]" type="checkbox" value="FE">
                                <label class="form-check-label" for="fe">FE</label>
                                <input class="form-check-input" name="year[]" type="checkbox" value="SE">
                                <label class="form-check-label" for="se">SE</label>
                                <input class="form-check-input" name="year[]" type="checkbox" value="TE">
                                <label class="form-check-label" for="te">TE</label>
                                <input class="form-check-input" name="year[]" type="checkbox" value="BE">
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
                                <input class="form-check-input" name="branch[]" type="checkbox" value="INFT">
                                <label class="form-check-label" for="inft">INFT</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="CMPN">
                                <label class="form-check-label" for="cmpn">CMPN</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="EXTC">
                                <label class="form-check-label" for="extc">EXTC</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="ETRX">
                                <label class="form-check-label" for="etrx">ETRX</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="BIOM">
                                <label class="form-check-label" for="biom">BIOM</label>

                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="date" class="form-control" placeholder="Date" name="date">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Time" name="time"> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Location" name="location"> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <select name="issued_by" class="form-control">
                                <option selected disabled>Issued By</option>
                                @foreach($event_coordinator as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Price" name="price"> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Contact Name" name="contact_name"> 
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Contact No." name="contact_no"> 
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