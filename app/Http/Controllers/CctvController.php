<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ConsumeApiService;
use DataTables;

class CctvController extends Controller
{
    use ConsumeApiService;

    public function index(Request $request)
    {
        return view('pages.cctv');
    }

    // get list CCTV
    public function getCctv(Request $request)
    {
        // if ajax table
        if ($request->ajax()) {
            $regional = $this->performRequest('GET', env('API_ITA_URL') . 'get_list_cctv');

            if ($regional['code'] == 200) {
                return DataTables::of($regional['body']->list_cctv)
                    ->addIndexColumn()
                    ->addColumn('status', function ($row) {
                        if ($row->status == 1) {
                            $statusBtn = 'Aktif';
                            return $statusBtn;
                        } else {
                            $statusBtn = 'Tidak Aktif';
                            return $statusBtn;
                        }
                    })
                    ->rawColumns(['status'])
                    ->addIndexColumn()
                    ->addColumn('aksi', function ($row) {
                        $actionBtn =
                            '<button type="button" onClick="start_cctv(' . $row->id . ')" id="btnStart" class="btn btn-success" title="Start Service CCTV"><i class="fas fa-circle-play mr-2"></i></button>' .
                            '<button type="button" onClick="stop_cctv(' . $row->id . ')" id="btnStop" class="btn btn-primary" title="Stop Service CCTV"><i class="fas fa-circle-stop mr-2"></i></button>' .
                            '<button type="button" onClick="hapus_cctv(' . $row->id . ')" id="btnHapus" class="btn btn-danger" title="Hapus CCTV"><i class="fas fa-trash mr-2"></i></button>';
                        return $actionBtn;
                    })
                    ->rawColumns(['aksi'])
                    ->make(true);
            } else {
                return [];
            }
        }
    }

    // del cctv
    public function delCctv(Request $request)
    {
        // get all data
        $id_cctv   = $request->id;

        $param = [
            'id'    => $id_cctv
        ];

        $options = [
            'timeout'   => 120
        ];

        $request = $this->performRequestFormParams('DELETE', env('API_ITA_URL') . 'delete_list_cctv', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Server AI
    public function getServer(Request $request)
    {
        // get all data
        $serve   = $request->serve;

        if ($serve == 'edge') {
            $options = [
                'timeout'   => 120
            ];

            $request = $this->performRequestFormParams('GET', env('API_ITA_URL') . 'get_status', $options);

            $data['data']    = $request['body'];
            $data['status']  = $request['code'];
        } else {
            $options = [
                'timeout'   => 120
            ];

            $request = $this->performRequestFormParams('GET', env('API_ITA_URL') . 'get_status_clients', $options);

            $data['data']    = $request['body'];
            $data['status']  = $request['code'];
        }
        echo json_encode($data);
    }

    // tambah cctv
    public function tambahCctv(Request $request)
    {
        $data['ruas']     = $this->performRequest('GET', env('API_ITA_URL') . 'get_ruas')['body'];
        return view('pages.tambahcctv', $data);
    }

    // get Generate Foto
    public function getFoto(Request $request)
    {
        // get all data
        $ruas_id        = $request->ruas_id;
        $titik_cctv     = $request->titik_cctv;
        $link_kamera    = $request->link_kamera;

        $param = [
            'id_ruas'    => $ruas_id,
            'titik_cctv' => $titik_cctv,
            'rtsp_cctv'  => $link_kamera,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'get_image', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 2 hasil masking
    public function getMasking(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;
        $input3    = $request->input3;
        $input4    = $request->input4;
        $input5    = $request->input5;
        $input6    = $request->input6;
        $input7    = $request->input7;
        $input8    = $request->input8;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
            'input3'    => $input3,
            'input4'    => $input4,
            'input5'    => $input5,
            'input6'    => $input6,
            'input7'    => $input7,
            'input8'    => $input8,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'mask_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 3 hasil Setup coord
    public function getSetupCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'set_up_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 4 hasil Setup Line coord
    public function getSetupLineCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;
        $input3    = $request->input3;
        $input4    = $request->input4;
        $input5    = $request->input5;
        $input6    = $request->input6;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
            'input3'    => $input3,
            'input4'    => $input4,
            'input5'    => $input5,
            'input6'    => $input6,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'set_up_lane_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 5 hasil Setup Cf coord
    public function getSetupCfCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'set_up_cf_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 6 hasil Setup Cf Line coord
    public function getSetupCfLineCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;
        $input3    = $request->input3;
        $input4    = $request->input4;
        $input5    = $request->input5;
        $input6    = $request->input6;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
            'input3'    => $input3,
            'input4'    => $input4,
            'input5'    => $input5,
            'input6'    => $input6,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'set_up_cf_lane_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 7 hasil Setdown coord
    public function getSetdownCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'set_down_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 8 hasil Setdown Line coord
    public function getSetdownLineCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;
        $input3    = $request->input3;
        $input4    = $request->input4;
        $input5    = $request->input5;
        $input6    = $request->input6;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
            'input3'    => $input3,
            'input4'    => $input4,
            'input5'    => $input5,
            'input6'    => $input6,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'set_down_lane_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 9 hasil Setdown Cf coord
    public function getSetdownCfCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'set_down_cf_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 10 hasil Setdown Cf Line coord
    public function getSetdownCfLineCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;
        $input3    = $request->input3;
        $input4    = $request->input4;
        $input5    = $request->input5;
        $input6    = $request->input6;

        $param = [
            'input1'    => $input1,
            'input2'    => $input2,
            'input3'    => $input3,
            'input4'    => $input4,
            'input5'    => $input5,
            'input6'    => $input6,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'set_down_cf_lane_coord', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 11 hasil Set pointup coord
    public function getSetPointupCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;

        $param = [
            'input1'                    => $input1,
            'input_jarak_sebenarnya'    => $input2,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'point_distance_up', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // get Generate Foto 12 hasil Set pointdown coord
    public function getSetPointdownCoord(Request $request)
    {
        // get all data
        $input1    = $request->input1;
        $input2    = $request->input2;

        $param = [
            'input1'                    => $input1,
            'input_jarak_sebenarnya'    => $input2,
        ];

        $options = [
            'timeout'   => 120
        ];
        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'point_distance_down', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // save add cctv
    public function saveCctv(Request $request)
    {
        // get all data
        $lokasi_cctv                = $request->lokasi_cctv;
        $source_cam                 = $request->source_cam;
        $maskcoord                  = $request->maskcoord;
        $upcoord                    = $request->upcoord;
        $upcoord_lane               = $request->upcoord_lane;
        $upcoord_cf                 = $request->upcoord_cf;
        $upcoord_lane_cf            = $request->upcoord_lane_cf;
        $upcoord_speed              = $request->upcoord_speed;
        $upcoord_speed_distance     = $request->upcoord_speed_distance;
        $downcoord                  = $request->downcoord;
        $downcoord_lane             = $request->downcoord_lane;
        $downcoord_cf               = $request->downcoord_cf;
        $downcoord_lane_cf          = $request->downcoord_lane_cf;
        $downcoord_speed            = $request->downcoord_speed;
        $downcoord_speed_distance   = $request->downcoord_speed_distance;
        $apptype                    = $request->apptype;
        $conf_day                   = $request->conf_day;
        $conf_night                 = $request->conf_night;
        $classes_bus                = $request->classes_bus;
        $classes_car                = $request->classes_car;
        $classes_truck              = $request->classes_truck;
        $ruas                       = $request->ruas;
        $ruas_id                    = $request->ruas_id;
        $jumlah_lajur               = $request->jumlah_lajur;
        $timezone                   = $request->timezone;
        $dataset                    = $request->dataset;
        $address                    = $request->address;

        $param = [
            'lokasi_cctv'           => $lokasi_cctv,
            'source_cam'            => $source_cam,
            'maskcoord'             => $maskcoord,
            'upcoord'               => $upcoord,
            'upcoord_lane'          => $upcoord_lane,
            'upcoord_cf'            => $upcoord_cf,
            'upcoord_lane_cf'       => $upcoord_lane_cf,
            'upcoord_speed'         => $upcoord_speed,
            'upcoord_speed_distance' => $upcoord_speed_distance,
            'downcoord'             => $downcoord,
            'downcoord_lane'        => $downcoord_lane,
            'downcoord_cf'          => $downcoord_cf,
            'downcoord_lane_cf'     => $downcoord_lane_cf,
            'downcoord_speed'       => $downcoord_speed,
            'downcoord_speed_distance' => $downcoord_speed_distance,
            'apptype'               => $apptype,
            'conf_day'              => $conf_day,
            'conf_night'            => $conf_night,
            'classes_bus'           => $classes_bus,
            'classes_car'           => $classes_car,
            'classes_truck'         => $classes_truck,
            'ruas'                  => $ruas,
            'ruas_id'               => $ruas_id,
            'jumlah_lajur'          => $jumlah_lajur,
            'timezone'              => $timezone,
            'dataset'               => $dataset,
            'address'               => $address,
        ];

        $options = [
            'timeout'   => 120
        ];

        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'submit_cctv', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // start cctv
    public function startCctv(Request $request)
    {
        // get all data
        $id_cctv   = $request->id;

        $param = [
            'id'    => $id_cctv
        ];

        $options = [
            'timeout'   => 120
        ];

        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'get_cctv_by_id', $param, $options);

        // parameter start cctv
        $nama   = $request['body'][0]->location;
        $ip     = $request['body'][0]->ip_address;
        $param2 = [
            'id'        => $id_cctv,
            'location'  => $nama,
            'address'   => $ip,
        ];

        $request2 = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'api_start_clients', $param2, $options);

        $data['data']    = $request2['body'];
        $data['status']  = $request2['code'];
        echo json_encode($data);
    }

    // stop cctv
    public function stopCctv(Request $request)
    {
        // get all data
        $id_cctv   = $request->id;

        $param = [
            'id'    => $id_cctv
        ];

        $options = [
            'timeout'   => 120
        ];

        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'get_cctv_by_id', $param, $options);

        // parameter stop cctv
        $nama   = $request['body'][0]->location;
        $ip     = $request['body'][0]->ip_address;
        $param2 = [
            'id'        => $id_cctv,
            'location'  => $nama,
            'address'   => $ip,
        ];

        $request2 = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'api_stop_clients', $param2, $options);

        $data['data']    = $request2['body'];
        $data['status']  = $request2['code'];
        echo json_encode($data);
    }
}
