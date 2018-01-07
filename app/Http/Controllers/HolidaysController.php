<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;

class HolidaysController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $holiday = Holiday::where('status', 1)->paginate(10);
        return view('admin.holidays.index', compact('holiday'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.holidays.create');
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
            'name' => 'required',
            'date' => 'required',
        ]);

        Holiday::Create([
            'name' => request('name'),
            'date' => request('date'),
        ]);
        
        \Session::flash('create', 'Data stored successfully.');
        return redirect('admin/holidays/');
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
        $holiday = Holiday::find($id);
        //return view(dd($id));
        return view('admin.holidays.edit', compact('holiday'));
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
        $holiday = Holiday::find($id);
        $holiday->name = request('name');
        $holiday->date = request('date');
        $holiday -> save();
        
        \Session :: flash('update','Updated Successfully!');
        return redirect('/admin/holidays/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $holiday = Holiday::find($id);
        $holiday->status = 0;
        $holiday -> save();
        
        \Session :: flash('delete','Deleted Successfully! If you want to undo changes, please go to phpmyadmin');
        return redirect('/admin/holidays/');
    }
}
