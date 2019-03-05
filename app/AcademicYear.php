<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = [
    	'academic_year',
    	'starts_at',
    	'ends_at'
    ];
}
