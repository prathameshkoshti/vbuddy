<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'roll', 'email', 'password', 'year', 'branch', 'division', 'admission_year' ,
    ];

    protected $hidden = [
        'password',
    ];

    public function event_registration()
    {
        $this->hasMany('App\EventRegistration');
    }
}
