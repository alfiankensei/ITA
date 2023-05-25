<?php

namespace App\Http\Service;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CarService
{
    public function getJumlahLalin($var = null)
    {
        $lokasi = request()->lokasi ? request()->lokasi   : 'JAGORAWI KM46 000';
        $tanggal =  request()->tanggal ? request()->tanggal  :  date("Y-m-d");
        $region = request()->region ? request()->ruas   : '-- Jasa Marga Group --';

        if ($lokasi != '-- Lokasi --'){
            $query = "INSERT IGNORE INTO CCTV_Traffic_V2 ( location, time ) VALUES ( '$lokasi', '$tanggal 00:00:00' ),
            ( '$lokasi', '$tanggal 01:00:00' ), ( '$lokasi', '$tanggal 02:00:00' ), ( '$lokasi', '$tanggal 03:00:00' ), 
            ( '$lokasi', '$tanggal 04:00:00' ), ( '$lokasi', '$tanggal 05:00:00' ), ( '$lokasi', '$tanggal 06:00:00' ), 
            ( '$lokasi', '$tanggal 07:00:00' ), ( '$lokasi', '$tanggal 08:00:00' ), ( '$lokasi', '$tanggal 09:00:00' ), 
            ( '$lokasi', '$tanggal 10:00:00' ), ( '$lokasi', '$tanggal 11:00:00' ), ( '$lokasi', '$tanggal 12:00:00' ), 
            ( '$lokasi', '$tanggal 13:00:00' ), ( '$lokasi', '$tanggal 14:00:00' ), ( '$lokasi', '$tanggal 15:00:00' ), 
            ( '$lokasi', '$tanggal 16:00:00' ), ( '$lokasi', '$tanggal 17:00:00' ), ( '$lokasi', '$tanggal 18:00:00' ), 
            ( '$lokasi', '$tanggal 19:00:00' ), ( '$lokasi', '$tanggal 20:00:00' ), ( '$lokasi', '$tanggal 21:00:00' ), 
            ( '$lokasi', '$tanggal 22:00:00' ), ( '$lokasi', '$tanggal 23:00:00' )";

            $data = DB::insert($query);
        }

        $query =  "select now() as waktu, location, 
        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5) as car_up_all,
        sum( bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5) as bus_up_all,
        sum( truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5) as truck_up_all,
        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5 + bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5 + truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5 ) as all_up,
        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1	+ car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5) as car_down_all,
        sum( bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1	+ bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5) as bus_down_all,
        sum( truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1	+ truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5) as truck_down_all,
        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1 + car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5 + bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1 + bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5 + truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1 + truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5 ) as all_down
        from CCTV_Traffic_V2 where date(time) = '$tanggal' and location = '$lokasi' group by location";

        // dump($query);
        $data = DB::selectOne($query);

        if (!$data) {

            return  [
                "B" => [
                    'waktu' => 0,
                    'location' => 0,
                    'car' => 0,
                    'bus' => 0,
                    'truck' => 0,
                    'all' => 0,
                ],
                "A" => [
                    'waktu' => 0,
                    'location' => 0,
                    'car' => 0,
                    'bus' => 0,
                    'truck' => 0,
                    'all' => 0,
                ]
            ];
        }
        $data = [
            "B" => [
                'waktu' => $data->waktu,
                'location' => $data->location,
                'car' => $data->car_up_all,
                'bus' => $data->bus_up_all,
                'truck' => $data->truck_up_all,
                'all' => $data->all_up,
            ],
            "A" => [
                'waktu' => $data->waktu,
                'location' => $data->location,
                'car' => $data->car_down_all,
                'bus' => $data->bus_down_all,
                'truck' => $data->truck_down_all,
                'all' => $data->all_down,
            ]
        ];

        return $data;
    }

    public function getJumlahLalin2($var = null)
    {   

        $lokasi = request()->lokasi ? request()->lokasi   : 'JAPEK KM69 000';
        $lokasi = explode(" ", $lokasi);
        $count = request()->count ? request()->count   : '3';

        $tanggal =  request()->tanggal ? request()->tanggal  :  date("Y-m-d");
        $region = request()->region ? request()->ruas   : '-- Jasa Marga Group --';

        $query =  "select now() as waktu, location, 
        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5) as car_up_all,
        sum( bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5) as bus_up_all,
        sum( truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5) as truck_up_all,
        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5 + bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5 + truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5 ) as all_up,
        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1	+ car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5) as car_down_all,
        sum( bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1	+ bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5) as bus_down_all,
        sum( truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1	+ truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5) as truck_down_all,
        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1 + car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5 + bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1 + bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5 + truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1 + truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5 ) as all_down
        from CCTV_Traffic_V2 where date(time) = '$tanggal'and ruas = '$lokasi[0]' and loc = '$lokasi[1]' and  subloc = '$lokasi[2]' group by location";

        // var_dump($query);
        $data = DB::selectOne($query);

        if (!$data) {

            return  [
                "B" => [
                    'waktu' => 0,
                    'location' => 0,
                    'car' => 0,
                    'bus' => 0,
                    'truck' => 0,
                    'all' => 0,
                ],
                "A" => [
                    'waktu' => 0,
                    'location' => 0,
                    'car' => 0,
                    'bus' => 0,
                    'truck' => 0,
                    'all' => 0,
                ]
            ];
        }
        $data = [
            "B" => [
                'waktu' => $data->waktu,
                'location' => $data->location,
                'car' => $data->car_up_all,
                'bus' => $data->bus_up_all,
                'truck' => $data->truck_up_all,
                'all' => $data->all_up,
            ],
            "A" => [
                'waktu' => $data->waktu,
                'location' => $data->location,
                'car' => $data->car_down_all,
                'bus' => $data->bus_down_all,
                'truck' => $data->truck_down_all,
                'all' => $data->all_down,
            ]
        ];

        return $data;
    }

    public function getChart($var = null)
    {
        $lokasi = request()->lokasi ? request()->lokasi   : 'JAGORAWI KM46 000';
        $tanggal =  request()->tanggal ? request()->tanggal  :  date("Y-m-d");
		 
		$date1 = date("Y-m-d H:i:s", (strtotime($tanggal) + 60 * 60 * 6));
        $date2 = date("Y-m-d H:i:s", (strtotime($tanggal) + 60 * 60 * 30));
        $region = request()->region ? request()->ruas   : '-- Jasa Marga Group --';
        
        $query =  "select location, hour(time) as time, 
        CASE hour(time) WHEN 0 THEN '00:00 - 01:00' WHEN 1 THEN '01:00 - 02:00' WHEN 2 THEN '02:00 - 03:00' WHEN 3 THEN '03:00 - 04:00' WHEN 4 THEN '04:00 - 05:00' WHEN 5 THEN '05:00 - 06:00' WHEN 6 THEN '06:00 - 07:00' WHEN 7 THEN '07:00 - 08:00' WHEN 8 THEN '08:00 - 09:00' WHEN 9 THEN '09:00 - 10:00' WHEN 10 THEN '10:00 - 11:00' WHEN 11 THEN '11:00 - 12:00' WHEN 12 THEN '12:00 - 13:00' WHEN 13 THEN '13:00 - 14:00' WHEN 14 THEN '14:00 - 15:00' WHEN 15 THEN '15:00 - 16:00' WHEN 16 THEN '16:00 - 17:00' WHEN 17 THEN '17:00 - 18:00' WHEN 18 THEN '18:00 - 19:00' WHEN 19 THEN '19:00 - 20:00' WHEN 20 THEN '20:00 - 21:00' WHEN 21 THEN '21:00 - 22:00' WHEN 22 THEN '22:00 - 23:00' ELSE '23:00 - 00:00' END as time2, 
        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5 + bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5 + truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5 ) as all_up,
        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1 + car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5 + bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1 + bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5 + truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1 + truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5 ) as all_down
        from CCTV_Traffic_V2 where date(time) = '$tanggal' and location = '$lokasi'  group by location, hour(time),time2 ORDER BY time2 ASC";
        
        $data = collect(DB::select($query));

        $data = [
            "B" => [
                'labels' => $data->pluck("time2")->toArray(),
                'datasets' => $data->pluck("all_up")->toArray(),
            ],
            "A" => [
                'labels' => $data->pluck("time2")->toArray(),
                'datasets' => $data->pluck("all_down")->toArray(),
            ]
        ];

        return $data;
    }

    public function getChart2($var = null)
    {   
        $lokasi = request()->lokasi ? request()->lokasi   : 'JAPEK KM69 000';
        $lokasi = explode(" ", $lokasi);
        $count = request()->count ? request()->count   : '3';
        $arah = request()->arah ? request()->arah   : 'A';

        $tanggal =  request()->tanggal ? request()->tanggal  :  date("Y-m-d");
		 
		$date1 = date("Y-m-d H:i:s", (strtotime($tanggal) + 60 * 60 * 6));
        $date2 = date("Y-m-d H:i:s", (strtotime($tanggal) + 60 * 60 * 30));
        
        $strurl = "http://172.16.14.203:99/actual_vs_prediction_hourly/".$lokasi[0]."/".$lokasi[1]."/".$lokasi[2]."/".$count."/".$arah;
        
        $response = Http::withBasicAuth('forecast', 'ilhamganteng')->get($strurl);
        $response_body = $response->json();

        dd($response_body);
        return $response_body;

        $query =  "select location, hour(time) as time, 
        CASE hour(time) WHEN 0 THEN '00:00 - 01:00' WHEN 1 THEN '01:00 - 02:00' WHEN 2 THEN '02:00 - 03:00' WHEN 3 THEN '03:00 - 04:00' WHEN 4 THEN '04:00 - 05:00' WHEN 5 THEN '05:00 - 06:00' WHEN 6 THEN '06:00 - 07:00' WHEN 7 THEN '07:00 - 08:00' WHEN 8 THEN '08:00 - 09:00' WHEN 9 THEN '09:00 - 10:00' WHEN 10 THEN '10:00 - 11:00' WHEN 11 THEN '11:00 - 12:00' WHEN 12 THEN '12:00 - 13:00' WHEN 13 THEN '13:00 - 14:00' WHEN 14 THEN '14:00 - 15:00' WHEN 15 THEN '15:00 - 16:00' WHEN 16 THEN '16:00 - 17:00' WHEN 17 THEN '17:00 - 18:00' WHEN 18 THEN '18:00 - 19:00' WHEN 19 THEN '19:00 - 20:00' WHEN 20 THEN '20:00 - 21:00' WHEN 21 THEN '21:00 - 22:00' WHEN 22 THEN '22:00 - 23:00' ELSE '23:00 - 00:00' END as time2, 
        sum( car_up_1 + car_up_2 + car_up_3 + car_up_4 + car_up_5 + car_up_cf_1 + car_up_cf_2 + car_up_cf_3 + car_up_cf_4 + car_up_cf_5 + bus_up_1 + bus_up_2 + bus_up_3 + bus_up_4 + bus_up_5 + bus_up_cf_1 + bus_up_cf_2 + bus_up_cf_3 + bus_up_cf_4 + bus_up_cf_5 + truck_up_1 + truck_up_2 + truck_up_3 + truck_up_4 + truck_up_5 + truck_up_cf_1 + truck_up_cf_2 + truck_up_cf_3 + truck_up_cf_4 + truck_up_cf_5 ) as all_up,
        sum( car_down_1 + car_down_2 + car_down_3 + car_down_4 + car_down_5 + car_down_cf_1 + car_down_cf_2 + car_down_cf_3 + car_down_cf_4 + car_down_cf_5 + bus_down_1 + bus_down_2 + bus_down_3 + bus_down_4 + bus_down_5 + bus_down_cf_1 + bus_down_cf_2 + bus_down_cf_3 + bus_down_cf_4 + bus_down_cf_5 + truck_down_1 + truck_down_2 + truck_down_3 + truck_down_4 + truck_down_5 + truck_down_cf_1 + truck_down_cf_2 + truck_down_cf_3 + truck_down_cf_4 + truck_down_cf_5 ) as all_down
        from CCTV_Traffic_V2 where date(time) = '$tanggal' and ruas = '$lokasi[0]' and loc = '$lokasi[1]' and  subloc = '$lokasi[2]'  group by location, hour(time),time2 ORDER BY time2 ASC";
        
        // var_dump($query);
        $data = collect(DB::select($query));


        $data = [
            "B" => [
                'labels' => $data->pluck("time2")->toArray(),
                'datasets' => $data->pluck("all_up")->toArray(),
            ],
            "A" => [
                'labels' => $data->pluck("time2")->toArray(),
                'datasets' => $data->pluck("all_down")->toArray(),
            ]
        ];

        return $data;
    }

    

    public function getLocation2()
    {
        $response = Http::withBasicAuth('forecast', 'ilhamganteng')->get('http://172.16.14.203:98/list_titik_cctv');
        $response_body = $response->json();
        return $response_body;
    }

    public function getRegion()
    {
        $query =  "SELECT region FROM List_Region cc order by region asc";

        $data = collect(DB::select($query));

        return  $data->pluck("region");
    }

    public function getRuas()
    {
        $region = request()->region;

        $query =  "SELECT ruas FROM List_Ruas where region = '$region' order by ruas asc";

        $data = collect(DB::select($query));

        return  $data->pluck("ruas");
    }

    public function getLocation()
    {
        $ruas = request()->ruas;

        $query =  "SELECT location  FROM CU_Config_V2 where ruas = '$ruas' order by location asc";

        $data = collect(DB::select($query));

        return  $data->pluck("location");
    }
}
