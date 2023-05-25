<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;

class ReportService
{
    public function getVideo($var = null)
    {

        $ruas = request()->ruas ? request()->ruas   : 'JAKARTA-CIKAMPEK';
        if ($ruas == '-- Ruas --'){
            $lokasi = 'JAKARTA-CIKAMPEK';
        }
        $query =  "SELECT
                        location,
                        filestream,
                        status
                    FROM
                        CU_Config 
                    WHERE
                        Ruas = '$ruas'";
        
        dump($query);
        $data = collect(DB::select($query));
        return $data;
    }

    public function getLocation()
    {
        $ruas = request()->ruas;

        $query =  "SELECT location  FROM CU_Config where ruas = '$ruas' ";

        $data = collect(DB::select($query));

        return  $data->pluck("location");
    }

    public function getRegion()
    {
        $query =  "SELECT region FROM List_Region cc ";

        $data = collect(DB::select($query));

        return  $data->pluck("region");
    }

    public function getRuas()
    {
        $region = request()->region;

        $query =  "SELECT ruas FROM List_Ruas where region = '$region' ";

        $data = collect(DB::select($query));

        return  $data->pluck("ruas");
    }
}
