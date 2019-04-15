<?php

namespace App\Imports;

use App\AvailableTime;
use App\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;

class TeachersAvailabilityImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $teacherId = Teacher::select('id')
        ->where('first_name',$row[0])
        ->where('last_name',$row[1])
        ->first();
        return new AvailableTime([
            'teacher_id' => $teacherId->id,
            'available_day' => $row[2],
            'time_start' => $row[3],
            'time_finish' => $row[4],
        ]);
    }
}
