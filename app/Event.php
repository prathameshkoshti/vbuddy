<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name', 'details', 'commitee_name', 'year', 'branch', 'date', 'time', 'location', 'price', 'contact_name', 'contact_no'
    ];

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
