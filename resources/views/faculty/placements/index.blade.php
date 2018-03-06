@extends('layouts.faculty_layout')
    
@section('title', 'V-Buddy :: Placement News')

@section('content_header')
    <h1 style="text-align:center">Placement News</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="table-responsive">
                <table class="table table-hover table-borderless">
                    <tr>
                        <td colspan=6>
                            <button onClick="parent.location='/faculty/placements/create'" type="button" class="btn btn-success table-btn">                            
                                <span class="fa fa-plus" aria-hidden="true"></span> Create
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <th>Head</th>
                        <th>Year</th>
                        <th>Branch</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    @foreach ($placements as $value)
                    <tr>
                        <td>{{ $value->head }}</td>
                        <td>{{ $value->year }}</td>
                        <td>{{ $value->branch }}</td>
                        @if( $value->status == 1)
                        <td>Active</td>
                        @else
                            <td>Inactive</td>
                        @endif
                        <td>
                            <a href="/faculty/placements/view/{{$value->id}}"><i class="fa fa-eye fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/faculty/placements/edit/{{$value->id}}"><i class="fa fa-pencil fa-lg" aria-hidden="true"></i></a>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="/faculty/placements/delete/{{$value->id}}"><i class="fa fa-trash fa-lg" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    {{$placements->render()}}
    @include('layouts.resource')
@stop