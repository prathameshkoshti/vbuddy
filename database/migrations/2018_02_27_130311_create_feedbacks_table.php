<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('roll');
            $table->integer('sem');
            $table->string('division');
            $table->string('branch');

            $table->integer('feedback_no');

            $table->string('subject1');
            $table->string('lecture1');
            $table->integer('lgrade1');
            $table->string('practical1');
            $table->integer('pgrade1');

            $table->string('subject2');
            $table->string('lecture2');
            $table->integer('lgrade2');
            $table->string('practical2');
            $table->integer('pgrade2');

            $table->string('subject3');
            $table->string('lecture3');
            $table->integer('lgrade3');
            $table->string('practical3');
            $table->integer('pgrade3');

            $table->string('subject4');
            $table->string('lecture4');
            $table->integer('lgrade4');
            $table->string('practicl4');
            $table->integer('pgrade4');

            $table->string('subject5')->nullable();
            $table->string('lecture5')->nullable();
            $table->integer('lgrade5')->nullable();
            $table->string('practical5')->nullable();
            $table->integer('pgrade5')->nullable();

            $table->string('subject6')->nullable();
            $table->string('lecture6')->nullable();
            $table->integer('lgrade6')->nullable();
            $table->string('practical6')->nullable();
            $table->integer('pgrade6')->nullable();

            $table->integer('administrative_office');
            $table->integer('examination_cell');
            $table->integer('institute_library');
            $table->integer('department_library');
            $table->integer('classrooms');
            $table->integer('water_facility');
            $table->integer('restroom');
            $table->integer('canteen');
            $table->string('suggestion',500);

            $table->boolean('study_material_by_teacher');
            $table->string('completeness1');
            $table->string('systematic_approach1');
            $table->string('comprehend1');
            $table->string('relevance1');

            $table->boolean('printed_notes');
            $table->string('completeness2');
            $table->string('systematic_approach2');
            $table->string('comprehend2');
            $table->string('relevance2');

            $table->integer('ques1');
            $table->integer('ques2');
            $table->integer('ques3');
            $table->integer('ques4');
            $table->integer('ques5');
            $table->integer('ques6');
            $table->integer('ques7')->null();
            $table->integer('ques8')->null();
            $table->integer('ques9')->null();
            $table->integer('ques10')->null();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feedbacks');
    }
}
