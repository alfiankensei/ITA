<?php

namespace App\Http\Controllers;

use App\Http\Service\ReportService;
use App\Http\Service\VideoService;
use Illuminate\Http\Request;
use App\Exports\ExportLalin;
use App\Exports\ExportLalin2;
use Maatwebsite\Excel\Facades\Excel;

class PageController extends Controller
{
    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index(string $page)
    {
        if (view()->exists("pages.{$page}")) {
            if($page=='tables1'){
                $reportserv =  new ReportService();
                $data =  $reportserv->getReport();
                $location =  $reportserv->getLocation();
                $region =  $reportserv->getRegion();
                $ruas =  $reportserv->getRuas();
                return view("pages.tables1", ['datareport' => $data, 'location' => $location, 'ruas' => $ruas, 'region' => $region]);
            }else if($page=='tables2'){
                $reportserv =  new ReportService();
                $data =  $reportserv->getReport2();
                $location =  $reportserv->getLocation2();
                $region =  $reportserv->getRegion();
                $ruas =  $reportserv->getRuas();
                return view("pages.tables2", ['datareport' => $data, 'location' => $location, 'ruas' => $ruas, 'region' => $region]);
            }else{
                return view("pages.{$page}");
            }
        }

        return abort(404);
    }

    public function vr()
    {
        return view("pages.virtual-reality");
    }

    public function rtl()
    {
        $reportserv =  new ReportService();
        $data =  $reportserv->getVideo();
        $location =  $reportserv->getLocation();
        $region =  $reportserv->getRegion();
        $ruas =  $reportserv->getRuas();
        return view("pages.rtl", ['datavideo'=>$data, 'location' => $location, 'ruas' => $ruas, 'region' => $region]);
    }

    public function rtl2()
    {
        $reportserv =  new ReportService();
        $data =  $reportserv->getVideo2();
        $location =  $reportserv->getLocation();
        $region =  $reportserv->getRegion();
        $ruas =  $reportserv->getRuas();
        return view("pages.rtl2", ['datavideo'=>$data, 'location' => $location, 'ruas' => $ruas, 'region' => $region]);
    }

    public function profile()
    {
        return view("pages.profile-static");
    }

    public function signin()
    {
        return view("pages.sign-in-static");
    }

    public function signup()
    {
        return view("pages.sign-up-static");
    }

    // public function exportReport(Request $request){
        // return Excel::download(new ExportLalin, 'lalin.xlsx');
    // }
	public function exportReport(Request $request)
    {
        return Excel::download(new ExportLalin($request->params), 'lalin.xlsx');
    }

    public function exportReport2(Request $request)
    {
        return Excel::download(new ExportLalin2($request->params), 'lalin.xlsx');
    }
}
