<?php

namespace App\Imports;

use App\Course;
use App\Program;
use App\AcademicYear;
use Maatwebsite\Excel\Concerns\ToModel;

class CoursesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $progId = Program::select('id')
        ->where('title',$row[0])
        ->first();
        $aY = AcademicYear::select('id')
        ->where('academic_year',$row[1])
        ->first();
        return new Course([
            'program_id' => $progId->id,
            'academic_year' => $aY->id,
            'semester' => $row[2],
            'level' => $row[3],
            'teacher' => $row[4],
            'title' => $row[5],
            'code' => $row[6],
            'units' => $row[7],
        ]);
    }
}
