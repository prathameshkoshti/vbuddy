@extends('Layouts.faculty_layout')

@section('title', 'V-Buddy :: Faculty Announcements')

@section('content_header')
    <h1 style="text-align:center">Faculty Announcements</h1>
@stop

@section('content')
    <div class="row">
        <div class="">
            <h4 style="text-align:center">Create New Faculty Announcement</h4>
        </div>
    </div>
    <br><br>
    <form method="post" action="/faculty/faculty_announcements/store" class="form form-group box-body" enctype="multipart/form-data">
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
                                <b>Division :</b>
                            </div>
                        </td>
                        <td>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" name="division[]" type="checkbox" value="A">
                                <label class="form-check-label" for="inft">A</label>
                                <input class="form-check-input" name="division[]" type="checkbox" value="B">
                                <label class="form-check-label" for="comp">B</label>     
                                <input class="form-check-input" name="division[]" type="checkbox" value="C">
                                <label class="form-check-label" for="etrx">C</label>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Attach a file:
                        </td>
                        <td>
                            <input type="file" name="attachment[]" multiple>
                        </td>
                    </tr>
                    <tr>
                        <td colspan=2>
                            <input type="hidden" name="issued_by" value="{{Auth::user()->id}}">
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