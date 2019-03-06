<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //


    public $table = "courses";

    public $fillable = [
		'program_id',
		'academic_year',
		'semester',
		'level',
		'teacher',
    	'title',
    	'code',
    	'units',
    ];

}
