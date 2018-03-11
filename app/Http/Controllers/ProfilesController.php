<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Feedback;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{
    public function profile()
    {
        $profile = Auth::user();
        return view('admin.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $id = request('id');
        $user = User::find($id);

        $user->name = request('name');
        $user->email = request('email');

        $user->save();
        \Session :: flash('update','Updated Successfully!');
        return redirect('/admin/profile/');
    }

    public function changePassword()
    {
        $profile = Auth::user()->id;
        return view('admin.change_password', compact('profile'));
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = Auth::user();

        $old_password = request('old_password');
        if(Hash::check($old_password, $user->password))
        {
            $user->password = bcrypt(request('new_password'));
            $user->save();
            \Session::flash('update', 'Password updated successfully.');
            return redirect('/admin/profile');
        }

        \Session::flash('update', 'Password update failed!.');
        return redirect('/admin/profile');
    }

    public function facultyProfile()
    {
        $profile = Auth::user();
        $abbreviation = $profile->abbreviation;
        $temp = array();
        for($i=1;$i<=6;$i++)
        {
            $feedbacks_lecture = Feedback::where([
                ['lecture'.$i, '=', $abbreviation],
            ])->pluck('lgrade'.$i);
            if(count($feedbacks_lecture)>0)
            {
                foreach($feedbacks_lecture as $lecture)
                    array_push($temp,$lecture);
            }
            $feedbacks_practical = Feedback::where([
                ['practical'.$i, '=', $abbreviation],
            ])->pluck('pgrade'.$i);
            if(count($feedbacks_practical)>0)
            {
                foreach($feedbacks_practical as $practical)
                    array_push($temp,$practical);
            }           
        }
        if(count($temp)>0)
            $avg = array_sum($temp) / count($temp);
        else
            $avg = 0;
        return view('faculty.profile', compact('profile', 'avg'));
    }

    public function facultyProfileUpdate(Request $request)
    {
        $this -> validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $user = Auth::user();

        $user->name = request('name');
        $user->email = request('email');

        $user->save();
        \Session :: flash('update','Updated Successfully!');
        return redirect('/faculty/profile/');
    }

    public function facultyChangePassword()
    {
        $profile = Auth::user()->id;
        return view('faculty.change_password', compact('profile'));
    }

    public function facultyUpdatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        $user = Auth::user();

        $old_password = request('old_password');
        if(Hash::check($old_password, $user->password))
        {
            $user->password = bcrypt(request('new_password'));
            $user->save();
            \Session::flash('update', 'Password updated successfully.');
            return redirect('/faculty/profile');
        }

        \Session::flash('update', 'Password update failed!.');
        return redirect('/faculty/profile');
    }
}
