<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(10);
        if(count($users)>0)
            return view('admin.users.index', compact('users'));
        else
            return view('errors.404');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
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
            'branch' => 'required',
            'abbrevation' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'role' => 'required',
        ]);

        try{
            User::create([
                'name' => request('name'),
                'branch' => request('branch'),
                'abbrevation' => request('abbrevation'),
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'role' => request('role'),
            ]);
        }
        catch(\Illuminate\Database\QueryException $e)
        {
            \Session::flash('create', $e->errorInfo[2]);
            return redirect('admin/users/create/');
        }

        \Session::flash('create', 'Data stored successfully.');
        return redirect('admin/users/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user)
            return view('admin.users.view', compact('user'));
        else
            return view('errors.404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if($user)
            return view('admin.users.edit', compact('user'));
        else
            return view('errors.404');
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
        $user = User::find($id);
        if($user)
        {
            if(request('password'))
            {
                try
                {
                    $user->name = request('name');
                    $user->branch = request('branch');
                    $user->abbrevation = request('abbrevation');
                    $user->email = request('email');
                    $user->password = bcrypt(request('password'));
                    $user->role = request('role');

                    $user->save();
                }
                catch(\Illuminate\Database\QueryException $e)
                {
                    \Session::flash('update', $e->errorInfo[1].':'. $e->errorInfo[2]);
                    return redirect('admin/users/edit/'.$id);
                }
            }
            else{
                try
                {
                    $user->name = request('name');
                    $user->branch = request('branch');
                    $user->abbrevation = request('abbrevation');
                    $user->email = request('email');
                    $user->role = request('role');

                    $user->save();
                }
                catch(\Illuminate\Database\QueryException $e)
                {
                    \Session::flash('update', $e->errorInfo[1].' '. $e->errorInfo[2]);
                    return redirect('admin/users/edit/'.$id);
                }
            }

            \Session :: flash('update','Updated Successfully!');
            return redirect('/admin/users/');
        }
        else
        {
            return view('errors.404');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if($user)
        {
            $user->status = 0;
            $user->save();

            \Session :: flash('delete','Deleted Successfully!');
            return redirect('/admin/users/');
        }
        else
        {
            return view('errors.404');
        }
    }
}
