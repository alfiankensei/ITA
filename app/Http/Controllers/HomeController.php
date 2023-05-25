<?php

namespace App\Http\Controllers;

use App\Http\Service\CarService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {   
        $service =  new CarService();
        $data =  $service->getJumlahLalin();
        $dataChart =  $service->getChart();
        $location =  $service->getLocation();
        $region =  $service->getRegion();
        $ruas =  $service->getRuas();
        return view('pages.dashboard' , ['datacounter' => $data,  'datachart' => $dataChart, 'location' => $location, 'ruas' => $ruas, 'region' => $region]);
    }

    public function index2()
    {   
        $service =  new CarService();
        $data =  $service->getJumlahLalin2();
        $dataChart =  $service->getChart2();
        $location =  $service->getLocation2();
        $region =  $service->getRegion();
        $ruas =  $service->getRuas();
        return view('pages.dashboard2' , ['datacounter' => $data,  'datachart' => $dataChart, 'location' => $location, 'ruas' => $ruas, 'region' => $region]);
    }

    public function realtime($type)
    {   
        $service =  new CarService();
        $data =  $service->getJumlahLalin();
        $dataChart =  $service->getChart();
        return view('components.dashboard-lalin' , ['datacounter' => $data[$type], 'jenisLalin' => $type,   'datachart' => $dataChart[$type]]);
    }

    public function realtimeChart($type)
    {   
        $service =  new CarService();
        $dataChart =  $service->getChart();
        return $dataChart[$type];
    }

    public function realtime2($type)
    {   
        $service =  new CarService();
        $data =  $service->getJumlahLalin2();
        $dataChart =  $service->getChart2();
        return view('components.dashboard-lalin2' , ['datacounter' => $data[$type], 'jenisLalin' => $type,   'datachart' => $dataChart[$type]]);
    }

    public function realtimeChart2($type)
    {   
        $service =  new CarService();
        $dataChart =  $service->getChart2();
        return $dataChart[$type];
    }
}
