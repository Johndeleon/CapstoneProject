<?php

namespace App\Imports;

use App\Room;
use Maatwebsite\Excel\Concerns\ToModel;

class RoomsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Room([
            'room_name' => $row[0],
            'room_type_id' => $row[1],
            'available_time_start' => $row[2],
            'available_time_finish' => $row[3],
        ]);
    }
}
