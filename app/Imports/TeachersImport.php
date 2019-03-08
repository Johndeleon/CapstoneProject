<?php

namespace App\Imports;

use App\Teacher;
use Maatwebsite\Excel\Concerns\ToModel;

class TeachersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Teacher([
            'first_name' => $row[0],
            'last_name' => $row[1],
            'address' => $row[2],
            'contact_number' => $row[3],
            'email' => $row[4],
        ]);
    }
}
