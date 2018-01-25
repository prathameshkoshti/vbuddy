<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'head', 'body', 'year', 'branch', 'division', 'date', 'issued_by', 
    ];

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
