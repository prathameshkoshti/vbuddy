<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    protected $fillable = ['token', 'student_id', 'year', 'branch', 'division'];
}
