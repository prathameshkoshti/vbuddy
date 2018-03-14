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
    <form method="post" action="/faculty/placements/update/{{$placement->id}}" class="form form-group box-body" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <table class="table table-borderless">
                    <tr>
                        <td colspan=2>
                            <input type="text" class="form-control" placeholder="Head" name="head" value="{{$placement->head}}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <textarea rows="5" class="form-control" placeholder="Body..." name="body">{{$placement->body}}</textarea>
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
                                <input class="form-check-input" name="branch[]" type="checkbox" value="CMPN" {{in_array('CMPN', $branch) ? 'checked' : ''}}>
                                <label class="form-check-label" for="cmpn">CMPN</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="EXTC" {{in_array('EXTC', $branch) ? 'checked' : ''}}>
                                <label class="form-check-label" for="extc">EXTC</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="ETRX" {{in_array('ETRX', $branch) ? 'checked' : ''}}>
                                <label class="form-check-label" for="etrx">ETRX</label>
                                <input class="form-check-input" name="branch[]" type="checkbox" value="BIOM" {{in_array('BIOM', $branch) ? 'checked' : ''}}>
                                <label class="form-check-label" for="biom">BIOM</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Date:</b>
                        </td>
                        <td>
                            <input type="date" name="date" class="form-control" value="{{$placement->date}}">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Attached file:
                        </td>
                        <td>
                            <input type="file" name="attachment">
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