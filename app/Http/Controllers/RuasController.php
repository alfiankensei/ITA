<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ConsumeApiService;
use DataTables;

class RuasController extends Controller
{
    use ConsumeApiService;

    public function index(Request $request)
    {
        $data['regional']     = $this->performRequest('GET', env('API_ITA_URL') . 'get_regional')['body'];
        // dd($data);
        return view('pages.ruas', $data);
    }

    // get list ruas
    public function getRuas(Request $request)
    {
        // if ajax table
        if ($request->ajax()) {

            if ($request->filled('region')) {
                $param = [
                    'region_id' => $request->region,
                ];

                $options = [
                    'timeout'   => 120
                ];
                $regional = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'get_by_ruas', $param, $options);

                if ($regional['code'] == 200) {
                    return DataTables::of($regional['body']->list_ruas)
                        ->addIndexColumn()
                        ->addColumn('aksi', function ($row) {
                            $actionBtn = '<button type="button" onClick="hapus_ruas(' . $row->id_ruas . ')" id="btnHapus" class="btn btn-danger" title="Hapus Ruas"><i class="fas fa-trash mr-2"></i></button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['aksi'])
                        ->make(true);
                } else {
                    return [];
                }
            } else {
                $regional = $this->performRequest('GET', env('API_ITA_URL') . 'get_ruas');

                if ($regional['code'] == 200) {
                    return DataTables::of($regional['body'])
                        ->addIndexColumn()
                        ->addColumn('aksi', function ($row) {
                            $actionBtn = '<button type="button" onClick="hapus_ruas(' . $row->id_ruas . ')" id="btnHapus" class="btn btn-danger" title="Hapus Ruas"><i class="fas fa-trash mr-2"></i></button>';
                            return $actionBtn;
                        })
                        ->rawColumns(['aksi'])
                        ->make(true);
                } else {
                    return [];
                }
            }
        }
    }

    // get nama regional
    public function getReg(Request $request)
    {
        $regional    = $this->performRequest('GET', env('API_ITA_URL') . 'get_regional')['body'];

        $data = array();
        foreach ($regional as $reg) {
            if ($request->filled('region_id')) {
                if ($reg->id_region == $request->region_id) {
                    //output data
                    $row                                = array();
                    $row['id']                          = $reg->id_region;
                    $row['name']                        = $reg->region;

                    $data[]                             = $row;
                }
            }
        }
        $output = array(
            "data" => $data,
        );

        echo json_encode($output);
    }

    // save add ruas
    public function postRuas(Request $request)
    {
        // get all data
        $region_id   = $request->region_id;
        $nama_region = $request->nama_region;
        $nama_ruas   = $request->nama_ruas;

        $param = [
            'region'    => $nama_region,
            'region_id' => $region_id,
            'ruas'      => $nama_ruas,
        ];

        $options = [
            'timeout'   => 120
        ];

        $request = $this->performRequestFormParams('POST', env('API_ITA_URL') . 'add_ruas', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }

    // del ruas
    public function delRuas(Request $request)
    {
        // get all data
        $id_ruas   = $request->id;

        $param = [
            'id'    => $id_ruas
        ];

        $options = [
            'timeout'   => 120
        ];

        $request = $this->performRequestFormParams('DELETE', env('API_ITA_URL') . 'delete_ruas', $param, $options);

        $data['data']    = $request['body'];
        $data['status']  = $request['code'];
        echo json_encode($data);
    }
}
