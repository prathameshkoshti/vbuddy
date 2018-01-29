<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = [
        'event_id', 'student_id',
    ];

    public function event()
    {
        $this->belongsTo('App\Event');
    }

    public function student()
    {
        $this->belongsTo('App\Student');
    }
}
