@extends('adminlte::page')

@section('title', 'AdminLTE :: V-Buddy')

@section('content_header')
    <h1 style="text-align:center">Feedbacks</h1>
@stop

@section('content')
    <div class="row">
        <h4 style="text-align:center">You are viewing feedbacks for {{$branch}} > Sem  {{$sem}} > Divison {{$division}}</h4><br>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th>ID</th>
                        <th>Student Id</th>
                        <th>Feedback No.</th>
                        <th>Actions</th>
                    </tr>
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <td>
                                {{$feedback->id}}
                            </td>
                            <td>
                                {{$feedback->student_id}}
                            </td>
                            <td>
                                {{$feedback->feedback_no}}
                            </td>
                            <td>
                                    <a href="/admin/feedbacks/view/{{$feedback->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                            </td>
                        </tr>                                
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{$feedbacks->render()}}
    @include('layouts.resource')
@stop