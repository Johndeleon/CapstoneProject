<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //


    public $table = "courses";

    public $fillable = [
    	'code',
    	'title',
    	'description',
    	'units',
    	'course_category_id',
    ];

}
