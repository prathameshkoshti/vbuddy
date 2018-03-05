<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Placement extends Model
{
    protected $fillable = [
        'head', 'body', 'year', 'branch', 'date', 'issued_by', 
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'issued_by', 'id');
    }

    public function placement_registration()
    {
        return $this->hasMany('App\PlacementRegistration', 'placement_id');
    }
}
