<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFixedSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fixed_schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('academic_year_id');
            $table->integer('semester');
            $table->integer('program_id');
            $table->string('course_name');
            $table->string('teacher_name');
            $table->string('room_name');
            $table->integer('level');    
            $table->integer('day');
            $table->integer('time_start');
            $table->integer('time_finish');
            $table->softDeletes();
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
        Schema::dropIfExists('fixed_schedules');
    }
}
