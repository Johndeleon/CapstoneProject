<?php

namespace App\Imports;

use App\Program;
use App\AcademicYear;
use Maatwebsite\Excel\Concerns\ToModel;

class ProgramsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $aY = AcademicYear::select('id')
        ->where('academic_year',$row[3])
        ->first();
        return new Program([
            'title' => $row[0],
            'description' => $row[1],
            'levels' => $row[2],
            'academic_year_id' => $aY->id,
        ]);
    }
}
