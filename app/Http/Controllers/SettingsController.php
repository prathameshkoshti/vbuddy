<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\user;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Event;
use App\Announcement;
use App\Placement;
use App\placementRegistration;
use App\EventRegistration;
use Illuminate\Support\Facades\Input;


class SettingsController extends Controller
{
    //

    public function index(){
        return view('admin.settings.index');
    }

    public function promote_year(){

        $admin= user::find(1);

        $pass=request('password');
        $password= $admin->password;
        if (Hash::check($pass,$password)) {

            Student::where('year', '=', 'BE')->update(['year' => 'PASS OUT']);

            Student::where('year', '=', 'TE')->update(['year' => 'BE']);
            student::where('sem', 6)->increment('sem', 1);

            Student::where('year', '=', 'SE')->update(['year' => 'TE']);
            student::where('sem', 4)->increment('sem', 1);

            Student::where('year', '=', 'FE')->update(['year' => 'SE']);
            student::where('sem', 2)->increment('sem', 1);

            \Session:: flash('update', ' Year Updated Successfully!');
            return redirect('admin/settings/');
        }
        else{
            \Session :: flash('update',' Invalid Password!');
            return redirect('admin/settings/');
        }
    }

    public function promote_sem(){

       $admin= user::find(1);
       $pass=request('password');
       $password= $admin->password;
        if (Hash::check($pass,$password)) {
        student::where('sem',7)->increment('sem',1);
        student::where('sem',6)->increment('sem',1);
        student::where('sem',5)->increment('sem',1);
        student::where('sem',4)->increment('sem',1);
        student::where('sem',3)->increment('sem',1);
        student::where('sem',2)->increment('sem',1);
        student::where('sem',1)->increment('sem',1);
        \Session :: flash('update',' Semester Updated Successfully!');
        return redirect('admin/settings/');
        }
        else{
            \Session :: flash('update',' Invalid Password!');
            return redirect('admin/settings/');
        }
    }

    public function demote_sem(){

        $admin= user::find(1);

        $pass=request('password');
        $password= $admin->password;
        if (Hash::check($pass,$password)) {

            student::where('sem',1)->decrement('sem',1);
            student::where('sem',2)->decrement('sem',1);
            student::where('sem',3)->decrement('sem',1);
            student::where('sem',4)->decrement('sem',1);
            student::where('sem',5)->decrement('sem',1);
            student::where('sem',6)->decrement('sem',1);
            student::where('sem',7)->decrement('sem',1);
            student::where('sem',8)->decrement('sem',1);

            \Session :: flash('update',' Semester Updated Successfully!');
            return redirect('admin/settings/');
        }
        else{
            \Session :: flash('update',' Invalid Password!');
            return redirect('admin/settings/');
        }
    }


    public function demote_year()
    {

        $admin = user::find(1);

        $pass = request('password');
        $password = $admin->password;
        if (Hash::check($pass, $password)) {

            Student::where('year', '=', 'SE')->update(['year' => 'FE']);
            student::where('sem', 3)->decrement('sem', 1);

            Student::where('year', '=', 'TE')->update(['year' => 'SE']);
            student::where('sem', 5)->decrement('sem', 1);

            Student::where('year', '=', 'BE')->update(['year' => 'TE']);
            student::where('sem', 7)->decrement('sem', 1);


            Student::where('year', '=', 'PASS OUT')->update(['year' => 'BE']);

            \Session:: flash('update', ' Year Updated Successfully!');
            return redirect('admin/settings/');
        } else {
            \Session:: flash('update', ' Invalid Password!');
            return redirect('admin/settings/');
        }
    }

    public function reset(Request $request){

       // {{dd($request->get('table'));}}

        $table=$request->get('table');
        $admin = user::find(1);
        $pass = request('password');
        $password = $admin->password;
        if (Hash::check($pass, $password))
        {
            if (!empty($table))
            {

                if (in_array("events", $table)) {
                    Event::truncate();
                    \Session:: flash('update', 'Table Truncated');
                    return redirect('admin/settings/');
                } elseif (in_array("announcements", $table)) {
                    Announcement::truncate();
                    \Session:: flash('update', 'Tables Truncated SE');
                    return redirect('admin/settings/');
                } elseif (in_array("placements", $table)) {
                    Placement::truncate();
                    \Session:: flash('update', 'Tables Truncated TE');
                    return redirect('admin/settings/');
                } elseif (in_array("placements_registration", $table)) {
                    PlacementRegistration::truncate();
                    \Session:: flash('update', 'Tables Truncated');
                    return redirect('admin/settings/');
                } elseif (in_array("events_registration", $table)) {
                    EventRegistration::truncate();
                    \Session:: flash('update', 'Tables Truncated');
                    return redirect('admin/settings/');
                }else {
                    \Session:: flash('update', 'Tick checkbox');
                    return redirect('admin/settings/');
                }
            }
            else
                {
                \Session:: flash('update', 'Select table to Reset');
                return redirect('admin/settings/');
                 }
        }
        else{
            \Session:: flash('update', ' Invalid Password!');
            return redirect('admin/settings/');
        }



    }

}