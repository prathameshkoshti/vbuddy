<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';
    
    protected $fillable = [
        'name', 'roll', 'email', 'password', 'year', 'sem', 'branch', 'division', 'admission_year' ,
    ];

    protected $hidden = [
        'password',
    ];

    public function event_registration()
    {
        return $this->hasMany('App\EventRegistration', 'student_id');
    }

    public function feedback()
    {
        return $this->hasMany('App\Feedback', 'student_id');
    }
}
