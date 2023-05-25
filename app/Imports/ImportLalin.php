<?php

namespace App\Imports;

use App\Models\Page;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportLalin implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Page([
            'lokasi' => $row[0],
            'tanggal' => $row[1],
            'jam' => $row[2],
            'tanggalawal' => $row[3],
            'tanggalakhir' => $row[4],
            'car_all_up' => $row[5],
            'bus_all_up' => $row[6],
            'truck_all_up' => $row[7],
            'all_up' => $row[8],
            'car_all_down' => $row[9],
            'bus_all_down' => $row[10],
            'truck_all_down' => $row[11],
            'all_down' => $row[12],
        ]);
    }
}
