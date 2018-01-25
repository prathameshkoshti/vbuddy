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
        $this->belongsTo('App\User');
    }
}
