@extends('layouts.faculty_layout')

@section('title', 'V-Buddy :: Placement News')

@section('content_header')
    <h1 style="text-align:center">Placement News</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Create New Placement News</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/faculty/placements/store" class="form form-group box-body">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table table-borderless">
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Head" name="head">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <textarea rows="5" class="form-control" placeholder="Body..." name="body"></textarea>
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
                                <input class="form-check-input" name="branch[]" type="checkbox" value="COMP">
                                <label class="form-check-label" for="comp">COMP</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="EXTC">
                                <label class="form-check-label" for="extc">EXTC</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="ETRX">
                                <label class="form-check-label" for="etrx">ETRX</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                                <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="issued_by">
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