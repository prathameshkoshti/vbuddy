<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Placement;
use App\User;

class PlacementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $placements = Placement::where('status', 1)->paginate(10);
        return view('admin.placements.index', compact('placements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.placements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'issued_by' => 'required',
        ]);

        $year = implode(',', $request->get('year'));
        $branch = implode(',', $request->get('branch'));

        Placement::create([
            'head' => request('head'),
            'body' => request('body'),
            'year' => $year,
            'branch' => $branch,
            'issued_by' => request('issued_by'), 
        ]);

        \Session::flash('create', 'Data stored successfully.');
        return redirect('admin/placements/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $placement = Placement::find($id);
        $year = explode(',', $placement->year);
        $branch = explode(',', $placement->branch);
        return view('admin.placements.edit', compact('placement', 'year', 'branch'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this -> validate($request, [
            'head' => 'required',
            'body' => 'required',
            'year' => 'required',
            'branch' => 'required',
            'issued_by' => 'required',
        ]);

        $placement = Placement::find($id);

        $year = implode(',', $request->get('year'));
        $branch = implode(',', $request->get('branch'));

        $placement->head = request('head');
        $placement->body = request('body');
        $placement->year = $year;
        $placement->branch = $branch;
        $placement->issued_by = request('issued_by');

        $placement->save();

        \Session :: flash('update','Updated Successfully!');
        return redirect('/admin/placements/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $placement = Placement::find($id);

        $placement->status = 0;
        $placement->save();

        \Session::flash('delete', 'Deleted successfully.');
        return redirect('admin/placements/');
    }
}
