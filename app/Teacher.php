<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'contact_number',
        'email'
    ];
}
