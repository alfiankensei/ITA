<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;

class ReportService
{

    public function getVideo($var = null)
    {

        $ruas = request()->ruas ? request()->ruas   : 'JAKARTA-CIKAMPEK';
        $region = request()->region ? request()->ruas   : '-- Jasa Marga Group --';
        if ($region == '-- Jasa Marga Group --'){
            $query =  "SELECT
                        location,
                        filestream,
                        status,
                        CONCAT('hls-example',id) as id
                    FROM
                        CU_Config
                    WHERE
                        status = 1
                    ORDER BY 
                        Location ASC";
        }else{
            $query =  "SELECT
                            location,
                            filestream,
                            status,
                            CONCAT('hls-example',id) as id
                        FROM
                            CU_Config 
                        WHERE
                            Ruas = '$ruas' order by location asc";
        }
        $data = collect(DB::select($query));
        // dump($region);
        return $data;
    }

    public function getVideo2($var = null)
    {

        $ruas = request()->ruas ? request()->ruas   : 'JAKARTA-CIKAMPEK';
        $region = request()->region ? request()->ruas   : '-- Jasa Marga Group --';
        if ($region == '-- Jasa Marga Group --'){
            $query =  "SELECT
                        location,
                        filestream,
                        status,
                        CONCAT('hls-example',id) as id
                    FROM
                        CU_Config_V2
                    WHERE
                        status = 1
                    ORDER BY 
                        Location ASC";
        }else{
            $query =  "SELECT
                            location,
                            filestream,
                            status,
                            CONCAT('hls-example',id) as id
                        FROM
                            CU_Config_V2 
                        WHERE
                            Ruas = '$ruas' order by location asc";
        }
        $data = collect(DB::select($query));
        // dump($region);
        return $data;
    }

    public function getReport($var = null)
    {

        $lokasi = request()->lokasi ? request()->lokasi   : 'JAGORAWI KM46 000';
        if ($lokasi == '-- Lokasi --'){
            $lokasi = 'JAGORAWI KM46 000';
        }
        $tanggalawal =  request()->tanggalawal ? request()->tanggalawal  :  date("Y-m-d");
        $tanggalakhir =  request()->tanggalakhir ? request()->tanggalakhir  :  date("Y-m-d");
        
        $query =  "SELECT
                        location,
                        date( time ) AS tanggal,
                        HOUR ( time ) AS jam,
                        '$tanggalawal' as tanggalawal,
                        '$tanggalakhir' as tanggalakhir,
                        sum( car_up ) AS car_up_all,
                        sum( `bus(s)_up` ) + sum( `bus(l)_up` ) AS bus_up_all,
                        sum( `truck(s)_up` ) + sum( `truck(m)_up` ) + sum( `truck(l)_up` ) + sum( `truck(xl)_up` ) AS truck_up_all,
                        sum( car_up ) + sum( `bus(s)_up` ) + sum( `bus(l)_up` ) + sum( `truck(s)_up` ) + sum( `truck(m)_up` ) + sum( `truck(l)_up` ) + sum( `truck(xl)_up` ) AS all_up,
                        sum( car_down ) AS car_down_all,
                        sum( `bus(s)_down` ) + sum( `bus(l)_down` ) AS bus_down_all,
                        sum( `truck(s)_down` ) + sum( `truck(m)_down` ) + sum( `truck(l)_down` ) + sum( `truck(xl)_down` ) AS truck_down_all,
                        sum( car_down ) + sum( `bus(s)_down` ) + sum( `bus(l)_down` ) + sum( `truck(s)_down` ) + sum( `truck(m)_down` ) + sum( `truck(l)_down` ) + sum( `truck(xl)_down` ) AS all_down 
                    FROM
                        CCTV_Traffic 
                    WHERE
                        date( time ) between '$tanggalawal' and '$tanggalakhir' 
                        AND location = '$lokasi' 
                    GROUP BY
                        location, date(time), hour(time)
                    ORDER BY date(time), hour(time) ASC;";
        
        // dump($query);
        $data = collect(DB::select($query));
        // dump($data);
        return $data;
    }

    public function getReport2($var = null)
    {

        $lokasi = request()->lokasi ? request()->lokasi   : 'JAGORAWI KM46 000';
        if ($lokasi == '-- Lokasi --'){
            $lokasi = 'JAGORAWI KM46 000';
        }
        $tanggalawal =  request()->tanggalawal ? request()->tanggalawal  :  date("Y-m-d");
        $tanggalakhir =  request()->tanggalakhir ? request()->tanggalakhir  :  date("Y-m-d");
        $query =  "SELECT
                        location,
                        date( time ) AS tanggal,
                        HOUR ( time ) AS jam,
                        '$tanggalawal' as tanggalawal,
                        '$tanggalakhir' as tanggalakhir,
                        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5) as car_up_all,
                        sum( bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5) as bus_up_all,
                        sum( truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5) as truck_up_all,
                        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5 + bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5 + truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5 ) as all_up,
                        FLOOR(sum(speed_down)/(count(*)-1)) as speedavg_up,
                        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1	+ car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5) as car_down_all,
                        sum( bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1	+ bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5) as bus_down_all,
                        sum( truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1	+ truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5) as truck_down_all,
                        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1 + car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5 + bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1 + bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5 + truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1 + truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5 ) as all_down,
                        FLOOR(sum(speed_up)/(count(*)-1)) as speedavg_down
                    FROM
                        CCTV_Traffic_V2 
                    WHERE
                        date( time ) between '$tanggalawal' and '$tanggalakhir' 
                        AND location = '$lokasi' 
                    GROUP BY
                        location, date(time), hour(time)
                    ORDER BY date(time), hour(time) ASC;";
        // dump($query);
        $data = collect(DB::select($query));
        // dump($data);
        return $data;
    }

    public function getLocation()
    {
        $ruas = request()->ruas;

        $query =  "SELECT location  FROM CU_Config where ruas = '$ruas' order by location asc";

        $data = collect(DB::select($query));
        // dump($data);

        return  $data->pluck("location");
    }

    public function getLocation2()
    {
        $ruas = request()->ruas;

        $query =  "SELECT location  FROM CU_Config_V2 where ruas = '$ruas' order by location asc";

        $data = collect(DB::select($query));

        return  $data->pluck("location");
    }

    public function getRegion()
    {
        $query =  "SELECT region FROM List_Region cc order by region asc";

        $data = collect(DB::select($query));
        // dump($data);

        return  $data->pluck("region");
    }

    public function getRuas()
    {
        $region = request()->region;

        $query =  "SELECT ruas FROM List_Ruas where region = '$region' order by ruas asc";

        $data = collect(DB::select($query));
        // dump($data);

        return  $data->pluck("ruas");
    }
}
