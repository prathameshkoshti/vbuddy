<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplacementTimetable extends Model
{
    protected $fillable = ['replacement_id', 'date', 'replacement_faculty', 'replacement_subject', 'issued_by'];
}
