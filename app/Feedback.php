<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $table = 'feedbacks';
    protected $fillable = [
        'student_id', 'sem', 'division', 'branch', 'feedback_no', 
        'subject1', 'lecture1', 'lgrade1', 'practical1', 'pgrade1',
        'subject2', 'lecture2', 'lgrade2', 'practical2', 'pgrade2',
        'subject3', 'lecture3', 'lgrade3', 'practical3', 'pgrade3',
        'subject4', 'lecture4', 'lgrade4', 'practical4', 'pgrade4',
        'subject5', 'lecture5', 'lgrade5', 'practical5', 'pgrade5',
        'subject6', 'lecture6', 'lgrade6', 'practical6', 'pgrade6',
        'administrative_office', 'examination_cell', 'institute_library', 'department_laboratory',
        'classrooms', 'water_facility', 'restroom', 'canteen',
        'study_material_by_teacher', 'completeness1', 'systematic_approach1', 'comprehend1', 'relevance1',
        'printed_notes', 'completeness2', 'systematic_approach2', 'comprehend2', 'relevance2',
        'ques1', 'ques2', 'ques3', 'ques4', 'ques5', 'ques6',
    ];

}
