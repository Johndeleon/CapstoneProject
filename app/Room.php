<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'room_name', 'room_type_id','available_time_start', 'available_time_finish',
    ];
}
