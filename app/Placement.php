<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Placement extends Model
{
    protected $fillable = [
        'head', 'body', 'year', 'branch', 'date', 'issued_by', 
    ];
}
