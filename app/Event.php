<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'details', 'commitee_name', 'year', 'branch', 'date', 'time', 'location', 'issued_by', 'price', 'contact_name', 'contact_no'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function event_registration()
    {
        return $this->hasMany('App\EventRegistration', 'event_id');
    }
}
