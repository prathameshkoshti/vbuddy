@extends('layouts.faculty_layout')
    
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <form method="post" action="/faculty/placements/store">
                    <table class="table table-hover">
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="head" placeholder="Head">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea>
                                </textarea>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
@stop