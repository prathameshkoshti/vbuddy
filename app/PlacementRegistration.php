<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlacementRegistration extends Model
{
    protected $fillable = [
        'placement_id', 'student_id',
    ];

    public function placement()
    {
        return $this->belongsTo('App\Placement');
    }

    public function student()
    {
        return $this->belongsTo('App\Student');
    }
}
