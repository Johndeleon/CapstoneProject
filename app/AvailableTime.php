<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableTime extends Model
{
    protected $fillable = [
      'teacher_id',
      'available_day',
      'time_start',
      'time_finish'
    ];
}
