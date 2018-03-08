<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Placement;
use App\PlacementRegistration;

class PlacementRegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $placements = Placement::withCount('placement_registration')
                    ->where('status', '=', 1)
                    ->paginate(10);

        return view('admin.placement_registrations.index', compact('placements'));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $students = PlacementRegistration::with('student')
                    ->where('placement_id', '=', $id)
                    ->paginate(10);
        $count = Placement::withCount('placement_registration')->find($id);
        
        if($count && $students)
        {
            return view('admin.placement_registrations.view', compact('students', 'count'));
        }
        else
        {
            return view('errors.404');
        }
    }

}
