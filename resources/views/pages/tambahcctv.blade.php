@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<style>
    h1 {
        color: green;
    }
    
    /* toggle in label designing */
    .toggle {
        position : relative ;
        display : inline-block;
        width : 50px;
        height : 30px;
        background-color: red;
        border-radius: 30px;
        border: 2px solid gray;
    }
    
    /* After slide changes */
    .toggle:after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: gray;
        top: 1px;
        left: 1px;
        transition:  all 0.5s;
    }
    
    /* Toggle text */
    p {
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
    }
    
    /* Checkbox checked effect */
    .checkbox:checked + .toggle::after {
        left : 20px;
    }
    
    /* Checkbox checked toggle label bg color */
    .checkbox:checked + .toggle {
        background-color: green;
    }
    
    /* Checkbox vanished */
    .checkbox {
        display : none;
    }
</style>
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Tambah CCTV'])
    <div class="container-fluid py-4">
        <div class="pt-4"></div>
        <div class="pt-4"></div>
        <div id="div-cctv1">
            <h4>Form Tambah CCTV</h4>
            <form id="addCctv1">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ruas_id">Ruas</label>
                                <select class="form-control form-control-border select2bs4" id="ruas_id" style="width: 100%;">
                                    <option value="" selected>Pilih Ruas</option>
                                    @foreach($ruas as $k => $v)
                                    <option value="{{$v->id_ruas}}" {{$v == request()->ruas ? 'selected' : ''}}> {{$v->ruas}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="titik_ruas">Ruas CCTV</label>
                                <input type="text" class="form-control form-control-border" id="titik_ruas" placeholder="Contoh : JAPEK" value="JAPEK">
                            </div>
                            <div class="form-group">
                                <label for="titik_km">Kilometer CCTV</label>
                                <input type="text" class="form-control form-control-border" id="titik_km" placeholder="Contoh : KM69" value="KM33">
                            </div>
                            <div class="form-group">
                                <label for="titik_meter">Meter CCTV</label>
                                <input type="text" class="form-control form-control-border" id="titik_meter" placeholder="Contoh : 500" value="500">
                            </div>
                            <div class="form-group">
                                <label for="jumlah_lajur">Jumlah Lajur</label>
                                <input type="text" class="form-control form-control-border" id="jumlah_lajur" placeholder="Contoh : 3" value="3">
                            </div>
                            <div class="form-group">
                                <label for="conf_siang">Confidence AI Siang</label>
                                <input type="text" class="form-control form-control-border" id="conf_siang" placeholder="Range : 0 - 1" value="0.4">
                            </div>
                            <div class="form-group">
                                <label for="conf_malam">Confidence AI Malam</label>
                                <input type="text" class="form-control form-control-border" id="conf_malam" placeholder="Range : 0 - 1" value="0.4">
                            </div>
                            <div class="form-group">
                                <label for="posisi_kamera">Posisi Kamera</label>
                                <select class="form-control form-control-border select2bs4" id="posisi_kamera" style="width: 100%;">
                                    <option value="" selected>Pilih Posisi Kamera</option>
                                    <option value="yolov5m-22Des22.pt">Posisi Normal</option>
                                    <option value="yolov5m-20Feb23.pt">Posisi Samping</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="klasifikasi_car">Klasifikasi Car</label>
                                <select class="form-control form-control-border select2bs4" id="klasifikasi_car" style="width: 100%;">
                                    <option value="" selected>Pilih Klasifikasi Car</option>
                                    <option value="True">Ya</option>
                                    <option value="False">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="klasifikasi_bus">Klasifikasi Bus</label>
                                <select class="form-control form-control-border select2bs4" id="klasifikasi_bus" style="width: 100%;">
                                    <option value="" selected>Pilih Klasifikasi Bus</option>
                                    <option value="True">Ya</option>
                                    <option value="False">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="klasifikasi_truck">Klasifikasi Truck</label>
                                <select class="form-control form-control-border select2bs4" id="klasifikasi_truck" style="width: 100%;">
                                    <option value="" selected>Pilih Klasifikasi Truck</option>
                                    <option value="True">Ya</option>
                                    <option value="False">Tidak</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="timezone">Timezone</label>
                                <select class="form-control form-control-border select2bs4" id="timezone" style="width: 100%;">
                                    <option value="" selected>Pilih Timezone</option>
                                    <option value="Asia/Jakarta">WIB</option>
                                    <option value="Asia/Makassar">WIT</option>
                                    <option value="Asia/Makassar">WITA</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="servers">Pilih Server</label>
                                <select class="form-control form-control-border select2bs4" id="servers" style="width: 100%;">
                                    <option value="" selected>Pilih Server</option>
                                    <option value="edge">Edge Computing</option>
                                    <option value="central">Centralize</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="ip_addr">Alamat Server AI</label>
                                <select class="form-control form-control-border select2bs4" id="ip_addr" style="width: 100%;">
                                    <option value="" selected>Pilih Server Dulu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="link_kamera">Alamat CCTV</label>
                                <textarea class="form-control" rows="3" id="link_kamera" placeholder="Contoh : rtsp://"></textarea>
                            </div>
                            {{-- <div class="form-group">
                                <label>Status</label>
                                <div>
                                    <input type="checkbox" id="status" class="checkbox">
                                    <label for="status" class="toggle">
                                    <input type="hidden" id="status_id" value="0">
                                </div>
                                <div>
                                    <label for="status" id="statusnama">Tidak Aktif</label>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <button type="button" id="btnGetFoto" class="form-control btn btn-warning" style="color: white;">Get Data CCTV</button>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div masking --}}
        <div id="div-cctv2" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Masking</h4>
            <form id="addCctv2">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <button type="button" id="resetTitikAwal" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="titik_cctv1_awal">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_awal" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="titik_ruas2">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_awal" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="titik_cctv3_awal">Titik Ke-3</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv3_awal" placeholder="Data Titik Ke 3" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="titik_cctv4_awal">Titik Ke-4</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv4_awal" placeholder="Data Titik Ke 4" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="titik_cctv5_awal">Titik Ke-5</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv5_awal" placeholder="Data Titik Ke 5" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="titik_cctv6_awal">Titik Ke-6</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv6_awal" placeholder="Data Titik Ke 6" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="titik_cctv7_awal">Titik Ke-7</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv7_awal" placeholder="Data Titik Ke 7" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="titik_cctv8_awal">Titik Ke-8</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv8_awal" placeholder="Data Titik Ke 8" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_awal">
                                <div class="form-group">
                                    <h5>Foto Sebelum Masking : </h5> <p>*Tentukan Titik Masking Coordinate di Foto ini</p>
                                    <img src="#" id="img_awal">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_awal2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Masking : </h5> <p>*</p>
                                    <img src="#" id="img_awal2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackForm" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Awal Form CCTV</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenMasking" class="form-control btn btn-success" style="color: white;">Submit Masking</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetupCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set up coordinate --}}
        <div id="div-cctv3" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Arah Lajur Ke Atas</h4>
            <form id="addCctv3">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetupCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_setup_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_setup_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_setup_coord">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_setup_coord" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setup_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Menentukan Titik Koordinat : </h5> <p>*Tentukan Titik Koordinat Arah Lajur Ke Atas di Foto ini</p>
                                    <img src="#" id="img_setup_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setup_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Menentukan Titik Koordinat : </h5><p>*</p>
                                    <img src="#" id="img_setup_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackMasking" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Masking CCTV</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetupCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Arah Lajur ke Atas</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetupLineCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set up line coordinate --}}
        <div id="div-cctv4" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Untuk Tiap Lajur Arah Ke Atas</h4>
            <form id="addCctv4">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetupLineCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_setup_line_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_setup_line_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_setup_line_coord">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_setup_line_coord" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv3_setup_line_coord">Titik Ke-3</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv3_setup_line_coord" placeholder="Data Titik Ke 3" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv4_setup_line_coord">Titik Ke-4</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv4_setup_line_coord" placeholder="Data Titik Ke 4" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv5_setup_line_coord">Titik Ke-5</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv5_setup_line_coord" placeholder="Data Titik Ke 5" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv6_setup_line_coord">Titik Ke-6</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv6_setup_line_coord" placeholder="Data Titik Ke 6" readonly>
                                    </div>
                                </div>
                            </div>
                            <h6>*Note : </h6><p>Jika Jumlah Lajur Satu Arah Ada 2 Lajur, Maksimal Titik 3 Untuk Lajur 1,2 dan Bahu Jalan. Dan Begitu Selanjutnya Untuk Jumlah Lajur Lainnya Tinggal Tambah 1 Dari Total Lajurnya!</p>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setup_line_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Menentukan Titik Koordinat : </h5> <p>*Tentukan Titik Koordinat Masing-Masing Lajur Arah Ke Atas di Foto ini</p>
                                    <img src="#" id="img_setup_line_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setup_line_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Menentukan Titik Koordinat : </h5><p>*</p>
                                    <img src="#" id="img_setup_line_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetupCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Lajur Arah ke Atas</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetupLineCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Tiap Lajur</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetupCfCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set up contra flow coordinate --}}
        <div id="div-cctv5" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Contra Flow Lajur Arah Ke Atas (Untuk Arah Sebaliknya)</h4>
            <form id="addCctv5">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetupCfCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_setup_cf_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_setup_cf_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_setup_cf_coord">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_setup_cf_coord" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setup_cf_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Penentuan Titik Koordinat Untuk Contra Flow : </h5> <p>*Tentukan Titik Koordinat Contra Flow Untuk Arah Sebaliknya di Foto ini</p>
                                    <img src="#" id="img_setup_cf_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setup_cf_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Penentuan Titik Koordinat Untuk Contra Flow : </h5><p>*</p>
                                    <img src="#" id="img_setup_cf_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetupLineCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Tiap Lajur CCTV</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetupCfCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Contra Flow Untuk Arah Sebaliknya</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetupCfLineCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set up line contra flow coordinate --}}
        <div id="div-cctv6" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Contra Flow Tiap Lajur Arah Ke Atas (Untuk Arah Sebaliknya)</h4>
            <form id="addCctv6">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetupCfLineCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_setup_cf_line_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_setup_cf_line_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_setup_cf_line_coord">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_setup_cf_line_coord" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv3_setup_cf_line_coord">Titik Ke-3</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv3_setup_cf_line_coord" placeholder="Data Titik Ke 3" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv4_setup_cf_line_coord">Titik Ke-4</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv4_setup_cf_line_coord" placeholder="Data Titik Ke 4" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv5_setup_cf_line_coord">Titik Ke-5</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv5_setup_cf_line_coord" placeholder="Data Titik Ke 5" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv6_setup_cf_line_coord">Titik Ke-6</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv6_setup_cf_line_coord" placeholder="Data Titik Ke 6" readonly>
                                    </div>
                                </div>
                            </div>
                            <h6>*Note : </h6><p>Jika Jumlah Lajur Satu Arah Ada 2 Lajur, Maksimal Titik 3 Untuk Lajur 1,2 dan Bahu Jalan. Dan Begitu Selanjutnya Untuk Jumlah Lajur Lainnya Tinggal Tambah 1 Dari Total Lajurnya!</p>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setup_cf_line_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Penentuan Titik Koordinat Untuk Contra Flow Tiap Lajur : </h5> <p>*Tentukan Titik Koordinat Contra Flow Tiap Lajur Untuk Arah Sebaliknya di Foto ini</p>
                                    <img src="#" id="img_setup_cf_line_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setup_cf_line_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Penentuan Titik Koordinat Untuk Contra Flow Tiap Lajur : </h5><p>*</p>
                                    <img src="#" id="img_setup_cf_line_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetupCfCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Contra Flow CCTV</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetupCfLineCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Contra Flow Tiap Lajur</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetdownCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set down coordinate --}}
        <div id="div-cctv7" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Arah Lajur Ke Bawah</h4>
            <form id="addCctv7">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetdownCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_setdown_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_setdown_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_setdown_coord">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_setdown_coord" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setdown_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Penentuan Titik Koordinat : </h5> <p>*Tentukan Titik Koordinat Arah Lajur Ke Bawah di Foto ini</p>
                                    <img src="#" id="img_setdown_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setdown_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Penentuan Titik Koordinat : </h5><p>*</p>
                                    <img src="#" id="img_setdown_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetupCfLineCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Contra Flow Tiap Lajur</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetdownCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Arah Lajur ke Bawah</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetdownLineCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set down line coordinate --}}
        <div id="div-cctv8" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Untuk Tiap Lajur Arah Ke Bawah</h4>
            <form id="addCctv8">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetdownLineCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_setdown_line_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_setdown_line_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_setdown_line_coord">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_setdown_line_coord" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv3_setdown_line_coord">Titik Ke-3</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv3_setdown_line_coord" placeholder="Data Titik Ke 3" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv4_setdown_line_coord">Titik Ke-4</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv4_setdown_line_coord" placeholder="Data Titik Ke 4" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv5_setdown_line_coord">Titik Ke-5</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv5_setdown_line_coord" placeholder="Data Titik Ke 5" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv6_setdown_line_coord">Titik Ke-6</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv6_setdown_line_coord" placeholder="Data Titik Ke 6" readonly>
                                    </div>
                                </div>
                            </div>
                            <h6>*Note : </h6><p>Jika Jumlah Lajur Satu Arah Ada 2 Lajur, Maksimal Titik 3 Untuk Lajur 1,2 dan Bahu Jalan. Dan Begitu Selanjutnya Untuk Jumlah Lajur Lainnya Tinggal Tambah 1 Dari Total Lajurnya!</p>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setdown_line_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Menentukan Titik Koordinat : </h5> <p>*Tentukan Titik Koordinat Masing-Masing Lajur Arah Ke Bawah di Foto ini</p>
                                    <img src="#" id="img_setdown_line_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setdown_line_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Menentukan Titik Koordinat : </h5><p>*</p>
                                    <img src="#" id="img_setdown_line_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetdownCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Arah Lajur Ke Bawah</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetdownLineCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Tiap Lajur Arah Ke Bawah</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetdownCfCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set down contra flow coordinate --}}
        <div id="div-cctv9" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Contra Flow Lajur Arah Ke Bawah (Untuk Arah Sebaliknya)</h4>
            <form id="addCctv9">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetdownCfCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_setdown_cf_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_setdown_cf_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_setdown_cf_coord">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_setdown_cf_coord" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setdown_cf_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Penentuan Titik Koordinat Untuk Contra Flow : </h5> <p>*Tentukan Titik Koordinat Contra Flow Untuk Arah Sebaliknya di Foto ini</p>
                                    <img src="#" id="img_setdown_cf_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setdown_cf_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Penentuan Titik Koordinat Untuk Contra Flow : </h5><p>*</p>
                                    <img src="#" id="img_setdown_cf_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetdownLineCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Tiap Lajur  CCTV</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetdownCfCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Contra Flow Untuk Arah Sebaliknya</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetdownCfLineCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set down line contra flow coordinate --}}
        <div id="div-cctv10" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Contra Flow Tiap Lajur Arah Ke Bawah (Untuk Arah Sebaliknya)</h4>
            <form id="addCctv10">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetdownCfLineCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_setdown_cf_line_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_setdown_cf_line_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_setdown_cf_line_coord">Titik Ke-2</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_setdown_cf_line_coord" placeholder="Data Titik Ke 2" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv3_setdown_cf_line_coord">Titik Ke-3</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv3_setdown_cf_line_coord" placeholder="Data Titik Ke 3" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv4_setdown_cf_line_coord">Titik Ke-4</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv4_setdown_cf_line_coord" placeholder="Data Titik Ke 4" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv5_setdown_cf_line_coord">Titik Ke-5</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv5_setdown_cf_line_coord" placeholder="Data Titik Ke 5" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv6_setdown_cf_line_coord">Titik Ke-6</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv6_setdown_cf_line_coord" placeholder="Data Titik Ke 6" readonly>
                                    </div>
                                </div>
                            </div>
                            <h6>*Note : </h6><p>Jika Jumlah Lajur Satu Arah Ada 2 Lajur, Maksimal Titik 3 Untuk Lajur 1,2 dan Bahu Jalan. Dan Begitu Selanjutnya Untuk Jumlah Lajur Lainnya Tinggal Tambah 1 Dari Total Lajurnya!</p>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setdown_cf_line_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Penentuan Titik Koordinat Untuk Contra Flow Tiap Lajur : </h5> <p>*Tentukan Titik Koordinat Contra Flow Tiap Lajur Untuk Arah Sebaliknya di Foto ini</p>
                                    <img src="#" id="img_setdown_cf_line_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_setdown_cf_line_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Penentuan Titik Koordinat Untuk Contra Flow Tiap Lajur : </h5><p>*</p>
                                    <img src="#" id="img_setdown_cf_line_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetdownCfCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Contra Flow CCTV</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetdownCfLineCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Contra Flow Tiap Lajur</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetPointupCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set point distance up coordinate --}}
        <div id="div-cctv11" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Set Point Awal Deteksi Lajur Arah Ke Atas</h4>
            <form id="addCctv11">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetPointupCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_set_pointup_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_set_pointup_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_set_pointup_coord">Jarak Sebenarnya</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_set_pointup_coord" placeholder="Input Jarak Sebenarnya Dalam Satuan M">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_set_pointup_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Penentuan Titik Koordinat Set Point Awal : </h5> <p>*Tentukan Titik Koordinat Set Point Awal Deteksi Lajur Arah Ke Atas di Foto ini</p>
                                    <img src="#" id="img_set_pointup_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_set_pointup_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Penentuan Titik Koordinat Set Point Awal : </h5><p>*</p>
                                    <img src="#" id="img_set_pointup_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetdownCfLineCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Contra Flow Tiap Lajur</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetPointupCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Set Point Lajur Arah Ke Atas</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextSetPointdownCoord" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div set point distance down coordinate --}}
        <div id="div-cctv12" style="display:none;">
            <h4>Form Penentuan Titik Koordinat Set Point Awal Deteksi Lajur Arah Ke Atas</h4>
            <form id="addCctv12">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="button" id="resetTitikSetPointdownCoord" class="form-control btn btn-warning" style="color: white;">Reset Titik</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv1_set_pointdown_coord">Titik Ke-1</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv1_set_pointdown_coord" placeholder="Data Titik Ke 1" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="titik_cctv2_set_pointdown_coord">Jarak Sebenarnya</label>
                                        <input type="text" class="form-control form-control-border" id="titik_cctv2_set_pointdown_coord" placeholder="Input Jarak Sebenarnya Dalam Satuan M">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_set_pointdown_coord">
                                <div class="form-group">
                                    <h5>Foto Sebelum Penentuan Titik Koordinat Set Point Awal : </h5> <p>*Tentukan Titik Koordinat Set Point Awal Deteksi Lajur Arah Ke Atas di Foto ini</p>
                                    <img src="#" id="img_set_pointdown_coord">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_set_pointdown_coord2">
                                <div class="form-group">
                                    <h5>Foto Sesudah Penentuan Titik Koordinat Set Point Awal : </h5><p>*</p>
                                    <img src="#" id="img_set_pointdown_coord2">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnBackSetPointupCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Set Point Arah Ke Atas</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnGenSetPointdownCoord" class="form-control btn btn-success" style="color: white;">Submit Koordinat Set Point Lajur Arah Ke Bawah</button>
                        </div>
                        <div class="col-md-4">
                            <button type="button" id="btnNextPreviewHasil" class="form-control btn btn-warning" style="color: white;">Tahap Selanjutnya ></button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>

        {{-- div preview hasil --}}
        <div id="div-cctv13" style="display:none;">
            <h4>Preview Hasil Penentuan Titik Koordinat CCTV</h4>
            <form id="addCctv13">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="div_img_preview1">
                                <h5 style="text-align:center">Foto Awal : </h5>
                                <img src="#" id="img_preview1" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview1_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview2">
                                <h5 style="text-align:center">Foto Hasil Masking : </h5>
                                <img src="#" id="img_preview2" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview2_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview3">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Arah Lajur Ke Atas : </h5>
                                <img src="#" id="img_preview3" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview3_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview4">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Tiap Lajur Arah Ke Atas : </h5>
                                <img src="#" id="img_preview4" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview4_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview5">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Contra Flow Arah Lajur Ke Atas : </h5>
                                <img src="#" id="img_preview5" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview5_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview6">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Contra Flow Tiap Lajur Arah Ke Atas : </h5>
                                <img src="#" id="img_preview6" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview6_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview7">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Arah Lajur Ke Bawah : </h5>
                                <img src="#" id="img_preview7" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview7_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview8">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Tiap Lajur Arah Ke Bawah : </h5>
                                <img src="#" id="img_preview8" style="width:100%">
                                <h5 style="text-align:center">Titik Coordinate : </h5>
                                <h5 style="text-align:center" id="img_preview8_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview9">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Contra Flow Arah Lajur Ke Bawah : </h5>
                                <img src="#" id="img_preview9" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview9_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview10">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Contra Flow Tiap Lajur Arah Ke Bawah : </h5>
                                <img src="#" id="img_preview10" style="width:100%">
                                <h5 style="text-align:center">Titik Koordinat : </h5>
                                <h5 style="text-align:center" id="img_preview10_text">#</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview11">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Set Point Awal Deteksi Lajur Arah Ke Atas : </h5>
                                <img src="#" id="img_preview11" style="width:100%">
                                <h5 style="text-align:center" id="img_preview11_text">Titik Koordinat : #</h5>
                                <h5 style="text-align:center" id="img_preview11_text2">Jarak Sebenarnya : #</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="div_img_preview12">
                                <h5 style="text-align:center">Foto Penentuan Koordinat Set Point Awal Deteksi Lajur Arah Ke Bawah : </h5>
                                <img src="#" id="img_preview12" style="width:100%">
                                <h5 style="text-align:center" id="img_preview12_text">Titik Koordinat : #</h5>
                                <h5 style="text-align:center" id="img_preview12_text2">Jarak Sebenarnya : #</h5>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="btnBackSetPointdownCoord" class="form-control btn btn-danger" style="color: white;">< Kembali Ke Penentuan Titik Koordinat Set Point Arah Ke Bawah</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" id="btnFinish" class="form-control btn btn-success" style="color: white;">Ya, Simpan!!</button>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
        @include('layouts.footers.auth.footer')
</div>
@endsection
@section('script')

    
<script type="text/javascript">
    // get base64 imagenya
    function getBase64Img(base64) {
        return "data:image/png;base64,"+base64;
    }
    // base46 to image function
    function Base64ToImage(base64img, callback) {
        var img = new Image();
        img.id  = 'img_awal';
        img.onload = function() {
            callback(img);
        };
        img.src = base64img;
        img.isMap = true;
    }

    $(document).ready(function () {
        // deklarasi variabel
        // img notfound dan awal
        var img_notfound                = "data:image/jpeg;base64,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";
        var img_awal                    = "";
        // div masking
        var num_awal                    = 0;
        var img_masking                 = "";
        var hasil_masking               = "";
        // div setup coord
        var num_setup_coord             = 0;
        var img_coord                   = "";
        var hasil_coord                 = "";
        // div setup line coord
        var num_setup_line_coord        = 0;
        var img_line_coord              = "";
        var hasil_line_coord            = "";
        // div setup cf coord
        var num_setup_cf_coord          = 0;
        var img_cf_coord                = "";
        var hasil_cf_coord              = "";
        // div setup cf line coord
        var num_setup_cf_line_coord     = 0;
        var img_cf_line_coord           = "";
        var hasil_cf_line_coord         = "";
        // div setdown coord
        var num_setdown_coord           = 0;
        var img_down_coord              = "";
        var hasil_down_coord            = "";
        // div setdown line coord
        var num_setdown_line_coord      = 0;
        var img_down_line_coord         = "";
        var hasil_down_line_coord       = "";
        // div setdown cf coord
        var num_setdown_cf_coord       = 0;
        var img_down_cf_coord          = "";
        var hasil_down_cf_coord        = "";
        // div setdown cf line coord
        var num_setdown_cf_line_coord  = 0;
        var img_down_cf_line_coord     = "";
        var hasil_down_cf_line_coord   = "";
        // div set pointup cf coord
        var num_set_pointup_coord      = 0;
        var img_pointup_coord          = "";
        var hasil_pointup_coord        = "";
        var hasil_pointup_coord2       = "";
        // div set pointdown cf coord
        var num_set_pointdown_coord    = 0;
        var img_pointdown_coord        = "";
        var hasil_pointdown_coord      = "";
        var hasil_pointdown_coord2     = "";

        //onchange Server
        $("#servers").change(function() {
            var serve = $('#servers').val();
            if (serve == '') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Server Belum dipilih!!'
                })
            } else {
                $.ajax({
                    type: "POST",
                    data: {
                            "_token": "{{ csrf_token() }}",
                            serve:serve
                        },
                    url: "{{ route('getServer') }}",
                    dataType: "JSON",
                    beforeSend: function() {
                        $('#ip_addr').html('<option value="">Loading...</option>');
                    },
                    success: function(response){
                        $('#ip_addr').html('<option value="">Pilih Alamat Server</option>');
                        var lenData   = response.data.perangkat.length;
                        var a;
                        for(a=0; a<lenData; a++){
                            var memory  = parseInt(response.data.perangkat[a].temp_free_memory);
                            if(memory > 4000){
                                $('#ip_addr').append('<option value="'+ response.data.perangkat[a].ip_address +'">'+ response.data.perangkat[a].ip_address +'</option>');
                            }else{
                                $('#ip_addr').append('<option value="">Not Found</option>');
                            }
                        }
                    },error: function(textStatus, errorThrown) { 
                        Swal.fire({
                            icon: 'error',
                            title: 'gagal get Server',
                            text: errorThrown
                        })
                    }
                });
            }
        });

        // generate image awal semua notfound
        // div masking
        $("#img_awal").attr("src", img_notfound);
        $("#img_awal2").attr("src", img_notfound);
        // div setup coord
        $("#img_setup_coord").attr("src", img_notfound);
        $("#img_setup_coord2").attr("src", img_notfound);
        // div setup line coord
        $("#img_setup_line_coord").attr("src", img_notfound);
        $("#img_setup_line_coord2").attr("src", img_notfound);
        // div setup cf coord
        $("#img_setup_cf_coord").attr("src", img_notfound);
        $("#img_setup_cf_coord2").attr("src", img_notfound);
        // div setup cf line coord
        $("#img_setup_cf_line_coord").attr("src", img_notfound);
        $("#img_setup_cf_line_coord2").attr("src", img_notfound);
        // div setdown coord
        $("#img_setdown_coord").attr("src", img_notfound);
        $("#img_setdown_coord2").attr("src", img_notfound);
        // div setdown line coord
        $("#img_setdown_line_coord").attr("src", img_notfound);
        $("#img_setdown_line_coord2").attr("src", img_notfound);
        // div setdown cf coord
        $("#img_setdown_cf_coord").attr("src", img_notfound);
        $("#img_setdown_cf_coord2").attr("src", img_notfound);
        // div setdown cf line coord
        $("#img_setdown_cf_line_coord").attr("src", img_notfound);
        $("#img_setdown_cf_line_coord2").attr("src", img_notfound);
        // div set pointup coord
        $("#img_set_pointup_coord").attr("src", img_notfound);
        $("#img_set_pointup_coord2").attr("src", img_notfound);
        // div set pointdown coord
        $("#img_set_pointdown_coord").attr("src", img_notfound);
        $("#img_set_pointdown_coord2").attr("src", img_notfound);
        // image click
        $("#img_awal").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_awal+=1;
            // var titik-titik
            if(num_awal == 1){
                var titik1 = $('#titik_cctv1_awal').val(x+':'+y);
            }else if(num_awal == 2){
                var titik2 = $('#titik_cctv2_awal').val(x+':'+y);
            }else if(num_awal == 3){
                var titik3 = $('#titik_cctv3_awal').val(x+':'+y);
            }else if (num_awal == 4){
                var titik4 = $('#titik_cctv4_awal').val(x+':'+y);
            }else if(num_awal == 5){
                var titik5 = $('#titik_cctv5_awal').val(x+':'+y);
            }else if(num_awal == 6){
                var titik6 = $('#titik_cctv6_awal').val(x+':'+y);
            }else if(num_awal == 7){
                var titik7 = $('#titik_cctv7_awal').val(x+':'+y);
            }else if(num_awal == 8){
                var titik8 = $('#titik_cctv8_awal').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 8 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img awal

        // img setup coord
        $("#img_setup_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_setup_coord+=1;
            // var titik-titik
            if(num_setup_coord == 1){
                var titik1 = $('#titik_cctv1_setup_coord').val(x+':'+y);
            }else if(num_setup_coord == 2){
                var titik2 = $('#titik_cctv2_setup_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 2 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img setup coord

        // img setup line coord
        $("#img_setup_line_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_setup_line_coord+=1;
            // var titik-titik
            if(num_setup_line_coord == 1){
                var titik1 = $('#titik_cctv1_setup_line_coord').val(x+':'+y);
            }else if(num_setup_line_coord == 2){
                var titik2 = $('#titik_cctv2_setup_line_coord').val(x+':'+y);
            }else if(num_setup_line_coord == 3){
                var titik3 = $('#titik_cctv3_setup_line_coord').val(x+':'+y);
            }else if(num_setup_line_coord == 4){
                var titik4 = $('#titik_cctv4_setup_line_coord').val(x+':'+y);
            }else if(num_setup_line_coord == 5){
                var titik5 = $('#titik_cctv5_setup_line_coord').val(x+':'+y);
            }else if(num_setup_line_coord == 6){
                var titik6 = $('#titik_cctv6_setup_line_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 6 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img setup line coord

        // img setup cf coord
        $("#img_setup_cf_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_setup_cf_coord+=1;
            // var titik-titik
            if(num_setup_cf_coord == 1){
                var titik1 = $('#titik_cctv1_setup_cf_coord').val(x+':'+y);
            }else if(num_setup_cf_coord == 2){
                var titik2 = $('#titik_cctv2_setup_cf_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 2 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img setup cf coord

        // img setup cf line coord
        $("#img_setup_cf_line_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_setup_cf_line_coord+=1;
            // var titik-titik
            if(num_setup_cf_line_coord == 1){
                var titik1 = $('#titik_cctv1_setup_cf_line_coord').val(x+':'+y);
            }else if(num_setup_cf_line_coord == 2){
                var titik2 = $('#titik_cctv2_setup_cf_line_coord').val(x+':'+y);
            }else if(num_setup_cf_line_coord == 3){
                var titik3 = $('#titik_cctv3_setup_cf_line_coord').val(x+':'+y);
            }else if(num_setup_cf_line_coord == 4){
                var titik4 = $('#titik_cctv4_setup_cf_line_coord').val(x+':'+y);
            }else if(num_setup_cf_line_coord == 5){
                var titik5 = $('#titik_cctv5_setup_cf_line_coord').val(x+':'+y);
            }else if(num_setup_cf_line_coord == 6){
                var titik6 = $('#titik_cctv6_setup_cf_line_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 6 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img setup cf line coord

        // img setdown coord
        $("#img_setdown_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_setdown_coord+=1;
            // var titik-titik
            if(num_setdown_coord == 1){
                var titik1 = $('#titik_cctv1_setdown_coord').val(x+':'+y);
            }else if(num_setdown_coord == 2){
                var titik2 = $('#titik_cctv2_setdown_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 2 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img setdown coord

        // img setdown line coord
        $("#img_setdown_line_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_setdown_line_coord+=1;
            // var titik-titik
            if(num_setdown_line_coord == 1){
                var titik1 = $('#titik_cctv1_setdown_line_coord').val(x+':'+y);
            }else if(num_setdown_line_coord == 2){
                var titik2 = $('#titik_cctv2_setdown_line_coord').val(x+':'+y);
            }else if(num_setdown_line_coord == 3){
                var titik3 = $('#titik_cctv3_setdown_line_coord').val(x+':'+y);
            }else if(num_setdown_line_coord == 4){
                var titik4 = $('#titik_cctv4_setdown_line_coord').val(x+':'+y);
            }else if(num_setdown_line_coord == 5){
                var titik5 = $('#titik_cctv5_setdown_line_coord').val(x+':'+y);
            }else if(num_setdown_line_coord == 6){
                var titik6 = $('#titik_cctv6_setdown_line_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 6 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img setdown line coord

        // img setdown cf coord
        $("#img_setdown_cf_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_setdown_cf_coord+=1;
            // var titik-titik
            if(num_setdown_cf_coord == 1){
                var titik1 = $('#titik_cctv1_setdown_cf_coord').val(x+':'+y);
            }else if(num_setdown_cf_coord == 2){
                var titik2 = $('#titik_cctv2_setdown_cf_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 2 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img setdown cf coord

        // img setdown cf line coord
        $("#img_setdown_cf_line_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_setdown_cf_line_coord+=1;
            // var titik-titik
            if(num_setdown_cf_line_coord == 1){
                var titik1 = $('#titik_cctv1_setdown_cf_line_coord').val(x+':'+y);
            }else if(num_setdown_cf_line_coord == 2){
                var titik2 = $('#titik_cctv2_setdown_cf_line_coord').val(x+':'+y);
            }else if(num_setdown_cf_line_coord == 3){
                var titik3 = $('#titik_cctv3_setdown_cf_line_coord').val(x+':'+y);
            }else if(num_setdown_cf_line_coord == 4){
                var titik4 = $('#titik_cctv4_setdown_cf_line_coord').val(x+':'+y);
            }else if(num_setdown_cf_line_coord == 5){
                var titik5 = $('#titik_cctv5_setdown_cf_line_coord').val(x+':'+y);
            }else if(num_setdown_cf_line_coord == 6){
                var titik6 = $('#titik_cctv6_setdown_cf_line_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 6 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img setup cf line coord

        // img set pointup coord
        $("#img_set_pointup_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_set_pointup_coord+=1;
            // var titik-titik
            if(num_set_pointup_coord == 1){
                var titik1 = $('#titik_cctv1_set_pointup_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 1 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img pointup coord

        // img set pointdown coord
        $("#img_set_pointdown_coord").on("click", function(event) {
            var x = event.pageX - this.offsetLeft;
            var y = event.pageY - this.offsetTop;
            // num_awal++
            num_set_pointdown_coord+=1;
            // var titik-titik
            if(num_set_pointdown_coord == 1){
                var titik1 = $('#titik_cctv1_set_pointdown_coord').val(x+':'+y);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!!!',
                    text: 'Max 1 Titik',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        });
        // end img pointdown coord

        // csrf token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // reset titik
        $('#resetTitikAwal').click(function(){
            num_awal    = 0;
            // titik1
            $('#titik_cctv1_awal').val('');
            $('#titik_cctv1_awal').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_awal').val('');
            $('#titik_cctv2_awal').attr('placeholder','Data Titik Ke 2');
            // titik3
            $('#titik_cctv3_awal').val('');
            $('#titik_cctv3_awal').attr('placeholder','Data Titik Ke 3');
            // titik4
            $('#titik_cctv4_awal').val('');
            $('#titik_cctv4_awal').attr('placeholder','Data Titik Ke 4');
            // titik5
            $('#titik_cctv5_awal').val('');
            $('#titik_cctv5_awal').attr('placeholder','Data Titik Ke 5');
            // titik6
            $('#titik_cctv6_awal').val('');
            $('#titik_cctv6_awal').attr('placeholder','Data Titik Ke 6');
            // titik7
            $('#titik_cctv7_awal').val('');
            $('#titik_cctv7_awal').attr('placeholder','Data Titik Ke 7');
            // titik8
            $('#titik_cctv8_awal').val('');
            $('#titik_cctv8_awal').attr('placeholder','Data Titik Ke 8');
        });
        // end reset titik

        // reset titik setup coord
        $('#resetTitikSetupCoord').click(function(){
            num_setup_coord    = 0;
            // titik1
            $('#titik_cctv1_setup_coord').val('');
            $('#titik_cctv1_setup_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_setup_coord').val('');
            $('#titik_cctv2_setup_coord').attr('placeholder','Data Titik Ke 2');
        });
        // end reset titik setup coord

        // reset titik setup line coord
        $('#resetTitikSetupLineCoord').click(function(){
            num_setup_line_coord    = 0;
            // titik1
            $('#titik_cctv1_setup_line_coord').val('');
            $('#titik_cctv1_setup_line_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_setup_line_coord').val('');
            $('#titik_cctv2_setup_line_coord').attr('placeholder','Data Titik Ke 2');
            // titik3
            $('#titik_cctv3_setup_line_coord').val('');
            $('#titik_cctv3_setup_line_coord').attr('placeholder','Data Titik Ke 3');
            // titik4
            $('#titik_cctv4_setup_line_coord').val('');
            $('#titik_cctv4_setup_line_coord').attr('placeholder','Data Titik Ke 4');
            // titik5
            $('#titik_cctv5_setup_line_coord').val('');
            $('#titik_cctv5_setup_line_coord').attr('placeholder','Data Titik Ke 5');
            // titik6
            $('#titik_cctv6_setup_line_coord').val('');
            $('#titik_cctv6_setup_line_coord').attr('placeholder','Data Titik Ke 6');
        });
        // end reset titik setup line coord

        // reset titik setup cf coord
        $('#resetTitikSetupCfCoord').click(function(){
            num_setup_cf_coord    = 0;
            // titik1
            $('#titik_cctv1_setup_cf_coord').val('');
            $('#titik_cctv1_setup_cf_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_setup_cf_coord').val('');
            $('#titik_cctv2_setup_cf_coord').attr('placeholder','Data Titik Ke 2');
        });
        // end reset titik setup cf coord

        // reset titik setup cf line coord
        $('#resetTitikSetupCfLineCoord').click(function(){
            num_setup_cf_line_coord    = 0;
            // titik1
            $('#titik_cctv1_setup_cf_line_coord').val('');
            $('#titik_cctv1_setup_cf_line_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_setup_cf_line_coord').val('');
            $('#titik_cctv2_setup_cf_line_coord').attr('placeholder','Data Titik Ke 2');
            // titik3
            $('#titik_cctv3_setup_cf_line_coord').val('');
            $('#titik_cctv3_setup_cf_line_coord').attr('placeholder','Data Titik Ke 3');
            // titik4
            $('#titik_cctv4_setup_cf_line_coord').val('');
            $('#titik_cctv4_setup_cf_line_coord').attr('placeholder','Data Titik Ke 4');
            // titik5
            $('#titik_cctv5_setup_cf_line_coord').val('');
            $('#titik_cctv5_setup_cf_line_coord').attr('placeholder','Data Titik Ke 5');
            // titik6
            $('#titik_cctv6_setup_cf_line_coord').val('');
            $('#titik_cctv6_setup_cf_line_coord').attr('placeholder','Data Titik Ke 6');
        });
        // end reset titik setup line coord

        // reset titik setdown coord
        $('#resetTitikSetdownCoord').click(function(){
            num_setdown_coord    = 0;
            // titik1
            $('#titik_cctv1_setdown_coord').val('');
            $('#titik_cctv1_setdown_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_setdown_coord').val('');
            $('#titik_cctv2_setdown_coord').attr('placeholder','Data Titik Ke 2');
        });
        // end reset titik setup cf coord

        // reset titik setdown line coord
        $('#resetTitikSetdownLineCoord').click(function(){
            num_setdown_line_coord    = 0;
            // titik1
            $('#titik_cctv1_setdown_line_coord').val('');
            $('#titik_cctv1_setdown_line_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_setdown_line_coord').val('');
            $('#titik_cctv2_setdown_line_coord').attr('placeholder','Data Titik Ke 2');
            // titik3
            $('#titik_cctv3_setdown_line_coord').val('');
            $('#titik_cctv3_setdown_line_coord').attr('placeholder','Data Titik Ke 3');
            // titik4
            $('#titik_cctv4_setdown_line_coord').val('');
            $('#titik_cctv4_setdown_line_coord').attr('placeholder','Data Titik Ke 4');
            // titik5
            $('#titik_cctv5_setdown_line_coord').val('');
            $('#titik_cctv5_setdown_line_coord').attr('placeholder','Data Titik Ke 5');
            // titik6
            $('#titik_cctv6_setdown_line_coord').val('');
            $('#titik_cctv6_setdown_line_coord').attr('placeholder','Data Titik Ke 6');
        });
        // end reset titik setdown line coord

        // reset titik setdown cf coord
        $('#resetTitikSetdownCfCoord').click(function(){
            num_setdown_cf_coord    = 0;
            // titik1
            $('#titik_cctv1_setdown_cf_coord').val('');
            $('#titik_cctv1_setdown_cf_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_setdown_cf_coord').val('');
            $('#titik_cctv2_setdown_cf_coord').attr('placeholder','Data Titik Ke 2');
        });
        // end reset titik setdown cf coord

        // reset titik setdown cf line coord
        $('#resetTitikSetdownCfLineCoord').click(function(){
            num_setdown_cf_line_coord    = 0;
            // titik1
            $('#titik_cctv1_setdown_cf_line_coord').val('');
            $('#titik_cctv1_setdown_cf_line_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_setdown_cf_line_coord').val('');
            $('#titik_cctv2_setdown_cf_line_coord').attr('placeholder','Data Titik Ke 2');
            // titik3
            $('#titik_cctv3_setdown_cf_line_coord').val('');
            $('#titik_cctv3_setdown_cf_line_coord').attr('placeholder','Data Titik Ke 3');
            // titik4
            $('#titik_cctv4_setdown_cf_line_coord').val('');
            $('#titik_cctv4_setdown_cf_line_coord').attr('placeholder','Data Titik Ke 4');
            // titik5
            $('#titik_cctv5_setdown_cf_line_coord').val('');
            $('#titik_cctv5_setdown_cf_line_coord').attr('placeholder','Data Titik Ke 5');
            // titik6
            $('#titik_cctv6_setdown_cf_line_coord').val('');
            $('#titik_cctv6_setdown_cf_line_coord').attr('placeholder','Data Titik Ke 6');
        });
        // end reset titik setdown line coord

        // reset titik set pointup coord
        $('#resetTitikSetPointupCoord').click(function(){
            num_set_pointup_coord    = 0;
            // titik1
            $('#titik_cctv1_set_pointup_coord').val('');
            $('#titik_cctv1_set_pointup_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_set_pointup_coord').val('');
            $('#titik_cctv2_set_pointup_coord').attr('placeholder','Input Jarak Sebenarnya Dalam Satuan M');
        });
        // end reset titik set pointup coord

        // reset titik set pointdown coord
        $('#resetTitikSetPointdownCoord').click(function(){
            num_set_pointdown_coord    = 0;
            // titik1
            $('#titik_cctv1_set_pointdown_coord').val('');
            $('#titik_cctv1_set_pointdown_coord').attr('placeholder','Data Titik Ke 1');
            // titik2
            $('#titik_cctv2_set_pointdown_coord').val('');
            $('#titik_cctv2_set_pointdown_coord').attr('placeholder','Input Jarak Sebenarnya Dalam Satuan M');
        });
        // end reset titik set pointdown coord

        // step 1
        //generate foto awal untuk masking step 2
        $('#btnGetFoto').click(function(){
            //get semua data
            var ruas_id             = $('#ruas_id').val();
            var titik_ruas          = $('#titik_ruas').val();
            var titik_km            = $('#titik_km').val();
            var titik_meter         = $('#titik_meter').val();
            var link                = $('#link_kamera').val();
            var link_kamera         = link.trim();
            var titik_cctv          = titik_ruas.concat(' ', titik_km, ' ', titik_meter);
            var jumlah_lajur        = $('#jumlah_lajur').val();
            var conf_1              = $('#conf_siang').val();
            var conf_2              = $('#conf_malam').val();
            var conf_siang          = conf_1.replaceAll(",", ".");
            var conf_malam          = conf_2.replaceAll(",", ".");
            var posisi_kamera       = $('#posisi_kamera').val();
            var klasifikasi_bus     = $('#klasifikasi_bus').val();
            var klasifikasi_car     = $('#klasifikasi_car').val();
            var klasifikasi_truck   = $('#klasifikasi_truck').val();
            var timezone            = $('#timezone').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('ruas_id', ruas_id);
            formData.append('titik_cctv', titik_cctv);
            formData.append('link_kamera', link_kamera);
            
            if(isNaN(conf_siang) || isNaN(conf_malam)){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hanya Boleh di Isi dengan Angka!!'
                })
            }else if(conf_siang < 0 ||conf_siang > 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Confidance AI Siang Tidak Boleh Kurang dari 0 dan Lebih dari 1'
                })
            }else if(conf_malam < 0 ||conf_malam > 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Confidance AI Malam Tidak Boleh Kurang dari 0 dan Lebih dari 1'
                })
            }else if(ruas_id == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Mohon Pilih Ruas!!'
                })
            }else if(titik_ruas == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik Ruas Tidak Boleh kosong!!'
                })
            }else if(titik_km == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik KM Tidak Boleh kosong!!'
                })
            }else if(titik_meter == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik Meter Tidak Boleh kosong!!'
                })
            }else if(link_kamera == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Link Kamera Tidak Boleh kosong!!'
                })
            }else if(titik_cctv == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal Concat titik CCTV!!'
                })
            }else if(jumlah_lajur == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jumlah Lajur Tidak Boleh Kosong!!'
                })
            }else if(posisi_kamera == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Posisi Kamera!!'
                })
            }else if(klasifikasi_bus == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Klasifikasi Bus!!'
                })
            }else if(klasifikasi_car == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Klasifikasi Car!!'
                })
            }else if(klasifikasi_truck == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Klasifikasi Truck!!'
                })
            }else if(timezone == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Timezone!!'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getFoto') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        if(sts == 1){
                            document.getElementById('div-cctv1').style.display = 'none';
                            document.getElementById('div-cctv2').style.display = 'block';
                            // base64 TO IMAGE
                            img_awal += "data:image/png;base64,"+json.data.get_image;
                            // var base64img_awal  = getBase64Img(img_awal);
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            // var remove
                            // var remove = document.getElementById('img_awal');
                            // remove.remove();
                            // add foto awal
                            $("#img_awal").attr("src", id_img);
                            // Base64ToImage(base64img_awal, function(img){
                            //     document.getElementById('div_img_awal').appendChild(img);
                            // });
                            // Nullable semua jika Mulai Dari Awal Lagi
                            // div masking
                            document.getElementById("resetTitikAwal").click();
                            // div masking
                            $("#img_awal2").attr("src", img_notfound);
                            // div setup coord
                            document.getElementById("resetTitikSetupCoord").click();
                            // div setup coord
                            $("#img_setup_coord").attr("src", img_notfound);
                            $("#img_setup_coord2").attr("src", img_notfound);
                            // div setup line coord
                            document.getElementById("resetTitikSetupLineCoord").click();
                            // div setup line coord
                            $("#img_setup_line_coord").attr("src", img_notfound);
                            $("#img_setup_line_coord2").attr("src", img_notfound);
                            // div setup cf coord
                            document.getElementById("resetTitikSetupCfCoord").click();
                            // div setup cf coord
                            $("#img_setup_cf_coord").attr("src", img_notfound);
                            $("#img_setup_cf_coord2").attr("src", img_notfound);
                            // div setup cf line coord
                            document.getElementById("resetTitikSetupCfLineCoord").click();
                            // div setup cf line coord
                            $("#img_setup_cf_line_coord").attr("src", img_notfound);
                            $("#img_setup_cf_line_coord2").attr("src", img_notfound);
                            // div setdown coord
                            document.getElementById("resetTitikSetdownCoord").click();
                            // div setdown coord
                            $("#img_setdown_coord").attr("src", img_notfound);
                            $("#img_setdown_coord2").attr("src", img_notfound);
                            // div setdown line coord
                            document.getElementById("resetTitikSetdownLineCoord").click();
                            // div setdown line coord
                            $("#img_setdown_line_coord").attr("src", img_notfound);
                            $("#img_setdown_line_coord2").attr("src", img_notfound);
                            // div setdown cf coord
                            document.getElementById("resetTitikSetdownCfCoord").click();
                            // div setdown cf coord
                            $("#img_setdown_cf_coord").attr("src", img_notfound);
                            $("#img_setdown_cf_coord2").attr("src", img_notfound);
                            // div setdown cf line coord
                            document.getElementById("resetTitikSetdownCfLineCoord").click();
                            // div setdown cf line coord
                            $("#img_setdown_cf_line_coord").attr("src", img_notfound);
                            $("#img_setdown_cf_line_coord2").attr("src", img_notfound);
                            // div set pointup coord
                            document.getElementById("resetTitikSetPointupCoord").click();
                            // div set pointup coord
                            $("#img_set_pointup_coord").attr("src", img_notfound);
                            $("#img_set_pointup_coord2").attr("src", img_notfound);
                            // div set pointdown coord
                            document.getElementById("resetTitikSetPointdownCoord").click();
                            // div set pointdown coord
                            $("#img_set_pointdown_coord").attr("src", img_notfound);
                            $("#img_set_pointdown_coord2").attr("src", img_notfound);
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Get Image, Coba Ulang / Alamat CCTV Tidak Valid!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto awal untuk masking step 2
        // end step 1

        // step 2 set up masking
        //back to form awal untuk masking step 1
        $('#btnBackForm').click(function(){
            document.getElementById('div-cctv1').style.display  = 'block';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
            // reset titik masking karena awal
            document.getElementById('resetTitikAwal').click();
            // null variable image awal
            img_awal = "";
        });
        //end back to form awal untuk masking step 1

        //generate foto masking untuk lanjut set up coordinate
        $('#btnGenMasking').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_awal').val();
            var input2      = $('#titik_cctv2_awal').val();
            var input3      = $('#titik_cctv3_awal').val();
            var input4      = $('#titik_cctv4_awal').val();
            var input5      = $('#titik_cctv5_awal').val();
            var input6      = $('#titik_cctv6_awal').val();
            var input7      = $('#titik_cctv7_awal').val();
            var input8      = $('#titik_cctv8_awal').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            formData.append('input3', input3);
            formData.append('input4', input4);
            formData.append('input5', input5);
            formData.append('input6', input6);
            formData.append('input7', input7);
            formData.append('input8', input8);
            
            if(input1 == '' || input2 == '' || input3 == '' || input4 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-4 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getMasking') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        if(sts == 1){
                            // null variable image masking dan img_coord
                            img_masking     = "";
                            hasil_masking   = "";
                            img_coord       = "";
                            hasil_coord     = "";
                            // add variabel img masking dan hasil masking
                            img_masking += "data:image/png;base64,"+json.data.get_image;
                            hasil_masking += json.data.hasil;
                            // change foto after masking
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_awal2").attr("src", id_img);
                            // change foto hasil masking kalau update
                            $("#img_setup_coord").attr("src", img_masking);
                            $("#img_setup_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetupCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Masking Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto masking untuk lanjut set up coordinate

        //next set up coordinate step 3
        $('#btnNextSetupCoord').click(function(){
            if(img_masking == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Masking Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'block';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set up coordinate step 3
        // end step 2

        // step 3 set up
        //back to masking coord step 2
        $('#btnBackMasking').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'block';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to masking coord step 2

        //generate foto set up coordinate untuk lanjut set up line coordinate
        $('#btnGenSetupCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_setup_coord').val();
            var input2      = $('#titik_cctv2_setup_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            
            if(input1 == '' || input2 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-2 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetupCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image coord dan img_line_coord
                            img_coord       = "";
                            hasil_coord     = "";
                            img_line_coord  = "";
                            hasil_line_coord= "";
                            // add variabel img setup coord dan set hasil coord
                            img_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_coord += json.data.hasil;
                            // change foto after setup coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_setup_coord2").attr("src", id_img);
                            // change foto hasil setup coord kalau update di berhasil untuk setup line coord
                            $("#img_setup_line_coord").attr("src", img_coord);
                            $("#img_setup_line_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetupLineCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Up Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set up coordinate untuk lanjut set up line coordinate

        //next set up coordinate step 4
        $('#btnNextSetupLineCoord').click(function(){
            if(img_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Lajur Atas Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'block';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set up coordinate step 4
        // end step 3

        // step 4 set up line
        //back to set up coordinate step 3
        $('#btnBackSetupCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'block';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set up coordinate step 3

        //generate foto set up line coordinate untuk lanjut set up cf coordinate
        $('#btnGenSetupLineCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_setup_line_coord').val();
            var input2      = $('#titik_cctv2_setup_line_coord').val();
            var input3      = $('#titik_cctv3_setup_line_coord').val();
            var input4      = $('#titik_cctv4_setup_line_coord').val();
            var input5      = $('#titik_cctv5_setup_line_coord').val();
            var input6      = $('#titik_cctv6_setup_line_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            formData.append('input3', input3);
            formData.append('input4', input4);
            formData.append('input5', input5);
            formData.append('input6', input6);
            
            if(input1 == '' || input2 == '' || input3 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-3 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetupLineCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image img_line_coord dan img_setup_cf_coord
                            img_line_coord  = "";
                            hasil_line_coord= "";
                            img_cf_coord       = "";
                            hasil_cf_coord     = "";
                            // add variabel img setup line coord dan set hasil line coord
                            img_line_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_line_coord += json.data.hasil;
                            // change foto after setup coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_setup_line_coord2").attr("src", id_img);
                            // change foto hasil setup line coord kalau update di berhasil untuk setup cf coord
                            $("#img_setup_cf_coord").attr("src", img_line_coord);
                            $("#img_setup_cf_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetupCfCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Up Line Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set up coordinate untuk lanjut set up line coordinate

        //next set up coordinate step 5
        $('#btnNextSetupCfCoord').click(function(){
            if(img_line_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Tiap Lajur Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'block';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set up coordinate step 5
        // end step 4

        // step 5 set up cf
        //back to set up line coordinate step 4
        $('#btnBackSetupLineCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'block';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set up line coordinate step 4

        //generate foto set up Cf coordinate untuk lanjut set up Cf Line coordinate
        $('#btnGenSetupCfCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_setup_cf_coord').val();
            var input2      = $('#titik_cctv2_setup_cf_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            
            if(input1 == '' || input2 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-2 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetupCfCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image img_setup_cf_coord dan img_setup_cf_line_coord
                            img_cf_coord       = "";
                            hasil_cf_coord     = "";
                            img_cf_line_coord  = "";
                            hasil_cf_line_coord= "";
                            // add variabel img_setup_cf_coord dan set hasil cf coord
                            img_cf_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_cf_coord += json.data.hasil;
                            // change foto after setup cf coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_setup_cf_coord2").attr("src", id_img);
                            // change foto hasil setup cf coord kalau update di berhasil untuk setup cf line coord
                            $("#img_setup_cf_line_coord").attr("src", img_cf_coord);
                            $("#img_setup_cf_line_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetupCfLineCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Up Contra Flow Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set up Cf coordinate untuk lanjut set up Cf Line coordinate

        //next set up cf line coordinate step 6
        $('#btnNextSetupCfLineCoord').click(function(){
            if(img_cf_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Contra Flow Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'block';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set up cf line coordinate step 6
        // end step 5
        
        // step 6 set up cf line
        //back to set up cf coordinate step 5
        $('#btnBackSetupCfCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'block';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set up cf coordinate step 5

        //generate foto set up cf line coordinate untuk lanjut set down coordinate
        $('#btnGenSetupCfLineCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_setup_cf_line_coord').val();
            var input2      = $('#titik_cctv2_setup_cf_line_coord').val();
            var input3      = $('#titik_cctv3_setup_cf_line_coord').val();
            var input4      = $('#titik_cctv4_setup_cf_line_coord').val();
            var input5      = $('#titik_cctv5_setup_cf_line_coord').val();
            var input6      = $('#titik_cctv6_setup_cf_line_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            formData.append('input3', input3);
            formData.append('input4', input4);
            formData.append('input5', input5);
            formData.append('input6', input6);
            
            if(input1 == '' || input2 == '' || input3 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-3 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetupCfLineCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image img_cf_line_coord dan img_setdown_coord
                            img_cf_line_coord   = "";
                            hasil_cf_line_coord = "";
                            img_down_coord      = "";
                            hasil_down_coord    = "";
                            // add variabel img setup cf line coord dan set hasil cf line coord
                            img_cf_line_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_cf_line_coord += json.data.hasil;
                            // change foto after setup cf line coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_setup_cf_line_coord2").attr("src", id_img);
                            // change foto hasil setup cf line coord kalau update di berhasil untuk setdown coord
                            $("#img_setdown_coord").attr("src", img_cf_line_coord);
                            $("#img_setdown_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetdownCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Up Contra Flow Line Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set up coordinate untuk lanjut set up line coordinate

        //next set up cf line coordinate step 6
        $('#btnNextSetdownCoord').click(function(){
            if(img_cf_line_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Contra Flow Tiap Lajur Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'block';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set up cf line coordinate step 6
        // end step 6

        // step 7 set down coordinate
        //back to setup cf line coord step 6
        $('#btnBackSetupCfLineCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'block';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to setup cf line coord step 6

        //generate foto set down coordinate untuk lanjut set down line coordinate
        $('#btnGenSetdownCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_setdown_coord').val();
            var input2      = $('#titik_cctv2_setdown_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            
            if(input1 == '' || input2 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-2 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetdownCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image down coord dan img_down_line_coord
                            img_down_coord       = "";
                            hasil_down_coord     = "";
                            img_down_line_coord  = "";
                            hasil_down_line_coord= "";
                            // add variabel img down coord dan set hasil coord
                            img_down_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_down_coord += json.data.hasil;
                            // change foto after setdown coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_setdown_coord2").attr("src", id_img);
                            // change foto hasil setdown coord kalau update di berhasil untuk setdown line coord
                            $("#img_setdown_line_coord").attr("src", img_down_coord);
                            $("#img_setdown_line_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetdownLineCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Down Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set down coordinate untuk lanjut set down line coordinate

        //next set up coordinate step 8
        $('#btnNextSetdownLineCoord').click(function(){
            if(img_down_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Lajur Arah ke Bawah Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'block';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set down line coordinate step 8
        // end step 7

        // step 8 set down line
        //back to set down coordinate step 7
        $('#btnBackSetdownCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'block';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set down coordinate step 7

        //generate foto set down line coordinate untuk lanjut set down cf coordinate
        $('#btnGenSetdownLineCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_setdown_line_coord').val();
            var input2      = $('#titik_cctv2_setdown_line_coord').val();
            var input3      = $('#titik_cctv3_setdown_line_coord').val();
            var input4      = $('#titik_cctv4_setdown_line_coord').val();
            var input5      = $('#titik_cctv5_setdown_line_coord').val();
            var input6      = $('#titik_cctv6_setdown_line_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            formData.append('input3', input3);
            formData.append('input4', input4);
            formData.append('input5', input5);
            formData.append('input6', input6);
            
            if(input1 == '' || input2 == '' || input3 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-3 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetdownLineCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image img_down_line_coord dan img_setdown_cf_coord
                            img_down_line_coord     = "";
                            hasil_down_line_coord   = "";
                            img_down_cf_coord       = "";
                            hasil_down_cf_coord     = "";
                            // add variabel img setdown line coord dan set hasil line coord
                            img_down_line_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_down_line_coord += json.data.hasil;
                            // change foto after setdown coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_setdown_line_coord2").attr("src", id_img);
                            // change foto hasil setdown line coord kalau update di berhasil untuk setdown cf coord
                            $("#img_setdown_cf_coord").attr("src", img_down_line_coord);
                            $("#img_setdown_cf_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetdownCfCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Down Line Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set down coordinate untuk lanjut set down cf coordinate

        //next set down cf coordinate step 9
        $('#btnNextSetdownCfCoord').click(function(){
            if(img_down_line_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Tiap Lajur Arah ke Bawah Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'block';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set down cf coordinate step 9
        // end step 8

        // step 9 set down cf
        //back to set down line coordinate step 8
        $('#btnBackSetdownLineCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'block';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set down line coordinate step 8

        //generate foto set down Cf coordinate untuk lanjut set down Cf Line coordinate
        $('#btnGenSetdownCfCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_setdown_cf_coord').val();
            var input2      = $('#titik_cctv2_setdown_cf_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            
            if(input1 == '' || input2 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-2 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetdownCfCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image img_setdown_cf_coord dan img_setdown_cf_line_coord
                            img_down_cf_coord       = "";
                            hasil_down_cf_coord     = "";
                            img_down_cf_line_coord  = "";
                            hasil_down_cf_line_coord= "";
                            // add variabel img_setdown_cf_coord dan set hasil cf coord
                            img_down_cf_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_down_cf_coord += json.data.hasil;
                            // change foto after setdown cf coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_setdown_cf_coord2").attr("src", id_img);
                            // change foto hasil setdown cf coord kalau update di berhasil untuk setdown cf line coord
                            $("#img_setdown_cf_line_coord").attr("src", img_down_cf_coord);
                            $("#img_setdown_cf_line_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetdownCfLineCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Down Contra Flow Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set down Cf coordinate untuk lanjut set down Cf Line coordinate

        //next set down cf line coordinate step 10
        $('#btnNextSetdownCfLineCoord').click(function(){
            if(img_down_cf_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Lajur Contra Flow Arah ke Bawah Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'block';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set down cf line coordinate step 10
        // end step 9
        
        // step 10 set down cf line
        //back to set down cf coordinate step 9
        $('#btnBackSetdownCfCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'block';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set down cf coordinate step 9

        //generate foto set down cf line coordinate untuk lanjut set down coordinate
        $('#btnGenSetdownCfLineCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_setdown_cf_line_coord').val();
            var input2      = $('#titik_cctv2_setdown_cf_line_coord').val();
            var input3      = $('#titik_cctv3_setdown_cf_line_coord').val();
            var input4      = $('#titik_cctv4_setdown_cf_line_coord').val();
            var input5      = $('#titik_cctv5_setdown_cf_line_coord').val();
            var input6      = $('#titik_cctv6_setdown_cf_line_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            formData.append('input3', input3);
            formData.append('input4', input4);
            formData.append('input5', input5);
            formData.append('input6', input6);
            
            if(input1 == '' || input2 == '' || input3 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-3 Tidak Boleh Kosong'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetdownCfLineCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image img_cf_line_coord dan img_setdown_coord
                            img_down_cf_line_coord   = "";
                            hasil_down_cf_line_coord = "";
                            img_pointup_coord        = "";
                            hasil_pointup_coord      = "";
                            // add variabel img setdown cf line coord dan set hasil cf line coord
                            img_down_cf_line_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_down_cf_line_coord += json.data.hasil;
                            // change foto after setup cf line coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_setdown_cf_line_coord2").attr("src", id_img);
                            // change foto hasil set up cf line coord kalau update di berhasil untuk set pointup coord
                            $("#img_set_pointup_coord").attr("src", img_down_cf_line_coord);
                            $("#img_set_pointup_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetPointupCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Down Contra Flow Line Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set down coordinate untuk lanjut set down line coordinate

        //next set pointup coordinate step 11
        $('#btnNextSetPointupCoord').click(function(){
            if(img_down_cf_line_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Tiap Lajur Contra Flow Arah ke Bawah Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'block';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set pointup coordinate step 11
        // end step 10

        // step 11 set distance point up
        //back to set down cf line coordinate step 10
        $('#btnBackSetdownCfLineCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'block';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set down cf line coordinate step 10

        //generate foto set pointup coordinate untuk lanjut set pointdown coordinate
        $('#btnGenSetPointupCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_set_pointup_coord').val();
            var input2      = $('#titik_cctv2_set_pointup_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            
            if(isNaN(input2)){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik 2 Hanya Boleh Angka Saja'
                })
            }else if(input1 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-2 Tidak Boleh Kosong'
                })
            }else if(input2 < 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 2 Tidak Boleh Kurang < 0'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetPointupCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image img_set_pointup_coord dan img_setpointdown_coord
                            img_pointup_coord       = "";
                            hasil_pointup_coord     = "";
                            hasil_pointup_coord2    = "";
                            img_pointdown_coord     = "";
                            hasil_pointdown_coord   = "";
                            hasil_pointdown_coord2  = "";
                            // add variabel img_set_pointup_coord dan set hasil pointup coord
                            img_pointup_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_pointup_coord += json.data.hasil;
                            hasil_pointup_coord2 += json.data.jarak_sebenarnya;
                            // change foto after set pointup coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_set_pointup_coord2").attr("src", id_img);
                            // change foto hasil set pointup coord kalau update di berhasil untuk set pointdown coord
                            $("#img_set_pointdown_coord").attr("src", img_pointup_coord);
                            $("#img_set_pointdown_coord2").attr("src", img_notfound);
                            document.getElementById('resetTitikSetPointdownCoord').click();

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Point Distance Up Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set pointup coordinate untuk lanjut set pointdown coordinate

        //next set pointup coordinate step 12
        $('#btnNextSetPointdownCoord').click(function(){
            if(img_pointup_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Set Point Arah Ke Atas Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'block';
                document.getElementById('div-cctv13').style.display = 'none';
            }
        });
        //end next set pointup coordinate step 12
        // end step 11

        // step 12 set distance point down
        //back to set pointup coordinate step 11
        $('#btnBackSetPointupCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'block';
            document.getElementById('div-cctv12').style.display = 'none';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set pointup coordinate step 11

        //generate foto set pointdown coordinate untuk lanjut preview hasil
        $('#btnGenSetPointdownCoord').click(function(){
            //get semua data
            var input1      = $('#titik_cctv1_set_pointdown_coord').val();
            var input2      = $('#titik_cctv2_set_pointdown_coord').val();
            
            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('input1', input1);
            formData.append('input2', input2);
            
            if(isNaN(input2)){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik 2 Hanya Boleh Angka Saja'
                })
            }else if(input1 == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 1-2 Tidak Boleh Kosong'
                })
            }else if(input2 < 0){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik CCTV 2 Tidak Boleh Kurang < 0'
                })
            }else{
                $.ajax({
                    type: "POST",
                    contentType: false,
                    processData: false,
                    data: formData,
                    url: "{{ route('getSetPointdownCoord') }}",
                    beforeSend: function() {
                        $('body').loading();
                    },
                    success: function(response){
                        $('body').loading('stop');
                        var json    = JSON.parse(response);
                        var sts     = json.data.status_id;
                        var code    = json.status;
                        if(code == 200){
                            // null variable image img_setpointdown_coord
                            img_pointdown_coord     = "";
                            hasil_pointdown_coord   = "";
                            hasil_pointdown_coord2  = "";
                            // add variabel img_set_pointdown_coord dan set hasil pointdown coord
                            img_pointdown_coord += "data:image/png;base64,"+json.data.get_image;
                            hasil_pointdown_coord += json.data.hasil;
                            hasil_pointdown_coord2 += json.data.jarak_sebenarnya;
                            // change foto after set pointdown coord
                            var id_img = "data:image/png;base64,"+json.data.get_image;
                            $("#img_set_pointdown_coord2").attr("src", id_img);

                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal!!!',
                                text: 'Gagal Set Point Distance Down Coordinate Foto, Coba Lagi!',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    },
                    error: function(jqXHR, exception) {
                        $('body').loading('stop');
                        if (jqXHR.status === 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Not connect.\n Verify Network.'
                            })
                        } else if (jqXHR.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested page not found. [404]'
                            })
                        } else if (jqXHR.status == 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Internal Server Error [500].'
                            })
                        } else if (exception === 'parsererror') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Requested JSON parse failed.'
                            })
                        } else if (exception === 'timeout') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Time out error.'
                            })
                        } else if (exception === 'abort') {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Ajax request aborted.'
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                text: 'Uncaught Error.\n' + jqXHR.responseText
                            })
                        }
                    }
                });
            }

        });
        //end generate foto set pointdown coordinate untuk lanjut preview hasil

        //next Preview Hasil
        $('#btnNextPreviewHasil').click(function(){
            if(img_pointdown_coord == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hasil Titik Koordinat Set Point Arah Ke Bawah Gambar Belum Di Temukan!!'
                })
            }else{
                document.getElementById('div-cctv1').style.display  = 'none';
                document.getElementById('div-cctv2').style.display  = 'none';
                document.getElementById('div-cctv3').style.display  = 'none';
                document.getElementById('div-cctv4').style.display  = 'none';
                document.getElementById('div-cctv5').style.display  = 'none';
                document.getElementById('div-cctv6').style.display  = 'none';
                document.getElementById('div-cctv7').style.display  = 'none';
                document.getElementById('div-cctv8').style.display  = 'none';
                document.getElementById('div-cctv9').style.display  = 'none';
                document.getElementById('div-cctv10').style.display = 'none';
                document.getElementById('div-cctv11').style.display = 'none';
                document.getElementById('div-cctv12').style.display = 'none';
                document.getElementById('div-cctv13').style.display = 'block';
                // set image preview
                // img awal
                $("#img_preview1").attr("src", img_awal);
                // masking
                $("#img_preview2").attr("src", img_masking);
                $("#img_preview2_text").html(hasil_masking);
                // set up coordinate
                $("#img_preview3").attr("src", img_coord);
                $("#img_preview3_text").html(hasil_coord);
                // set up line coordinate
                $("#img_preview4").attr("src", img_line_coord);
                $("#img_preview4_text").html(hasil_line_coord);
                // set up cf coordinate
                $("#img_preview5").attr("src", img_cf_coord);
                $("#img_preview5_text").html(hasil_cf_coord);
                // set up cf line coordinate
                $("#img_preview6").attr("src", img_cf_line_coord);
                $("#img_preview6_text").html(hasil_cf_line_coord);
                // set down coordinate
                $("#img_preview7").attr("src", img_down_coord);
                $("#img_preview7_text").html(hasil_down_coord);
                // set down line coordinate
                $("#img_preview8").attr("src", img_down_line_coord);
                $("#img_preview8_text").html(hasil_down_line_coord);
                // set down cf coordinate
                $("#img_preview9").attr("src", img_down_cf_coord);
                $("#img_preview9_text").html(hasil_down_cf_coord);
                // set down cf line coordinate
                $("#img_preview10").attr("src", img_down_cf_line_coord);
                $("#img_preview10_text").html(hasil_down_cf_line_coord);
                // set pointup coordinate
                $("#img_preview11").attr("src", img_pointup_coord);
                $("#img_preview11_text").html("Titik Coordinate : "+hasil_pointup_coord);
                $("#img_preview11_text2").html("Jarak Sebenarnya : "+hasil_pointup_coord2+ " M");
                // set pointdown coordinate
                $("#img_preview12").attr("src", img_pointdown_coord);
                $("#img_preview12_text").html("Titik Coordinate : "+hasil_pointdown_coord);
                $("#img_preview12_text2").html("Jarak Sebenarnya : "+hasil_pointdown_coord2+ " M");
            }
        });
        //end Preview Hasil
        // end step 12

        // step 13 di preview
        //back to set pointdown coordinate step 12
        $('#btnBackSetPointdownCoord').click(function(){
            document.getElementById('div-cctv1').style.display  = 'none';
            document.getElementById('div-cctv2').style.display  = 'none';
            document.getElementById('div-cctv3').style.display  = 'none';
            document.getElementById('div-cctv4').style.display  = 'none';
            document.getElementById('div-cctv5').style.display  = 'none';
            document.getElementById('div-cctv6').style.display  = 'none';
            document.getElementById('div-cctv7').style.display  = 'none';
            document.getElementById('div-cctv8').style.display  = 'none';
            document.getElementById('div-cctv9').style.display  = 'none';
            document.getElementById('div-cctv10').style.display = 'none';
            document.getElementById('div-cctv11').style.display = 'none';
            document.getElementById('div-cctv12').style.display = 'block';
            document.getElementById('div-cctv13').style.display = 'none';
        });
        //end back to set pointdown coordinate step 12

        //save CCTV baru 
        $('#btnFinish').click(function(){
            //get semua data
            var e                   = document.getElementById("ruas_id");
            var ruas_id             = e.value;
            var ruas_nama           = e.options[e.selectedIndex].text;
            var titik_ruas          = $('#titik_ruas').val();
            var titik_km            = $('#titik_km').val();
            var titik_meter         = $('#titik_meter').val();
            var link                = $('#link_kamera').val();
            var link_kamera         = link.trim();
            var titik_cctv          = titik_ruas.concat(' ', titik_km, ' ', titik_meter);
            var jumlah_lajur        = $('#jumlah_lajur').val();
            var conf_1              = $('#conf_siang').val();
            var conf_2              = $('#conf_malam').val();
            var conf_siang          = conf_1.replaceAll(",", ".");
            var conf_malam          = conf_2.replaceAll(",", ".");
            var posisi_kamera       = $('#posisi_kamera').val();
            var klasifikasi_bus     = $('#klasifikasi_bus').val();
            var klasifikasi_car     = $('#klasifikasi_car').val();
            var klasifikasi_truck   = $('#klasifikasi_truck').val();
            var timezone            = $('#timezone').val();
            var ip_addr             = $('#ip_addr').val();

            var formData = new FormData();
            formData.append('_token', "{{ csrf_token() }}");
            formData.append('lokasi_cctv', titik_cctv);
            formData.append('source_cam', link_kamera);
            formData.append('maskcoord', hasil_masking);
            formData.append('upcoord', hasil_coord);
            formData.append('upcoord_lane', hasil_line_coord);
            formData.append('upcoord_cf', hasil_cf_coord);
            formData.append('upcoord_lane_cf', hasil_cf_line_coord);
            formData.append('upcoord_speed', hasil_pointup_coord);
            formData.append('upcoord_speed_distance', hasil_pointup_coord2);
            formData.append('downcoord', hasil_down_coord);
            formData.append('downcoord_lane', hasil_down_line_coord);
            formData.append('downcoord_cf', hasil_down_cf_coord);
            formData.append('downcoord_lane_cf', hasil_down_cf_line_coord);
            formData.append('downcoord_speed', hasil_pointdown_coord);
            formData.append('downcoord_speed_distance', hasil_pointdown_coord2);
            formData.append('apptype', '1');
            formData.append('conf_day', conf_siang);
            formData.append('conf_night', conf_malam);
            formData.append('classes_bus', klasifikasi_bus);
            formData.append('classes_car', klasifikasi_car);
            formData.append('classes_truck', klasifikasi_truck);
            formData.append('ruas', ruas_nama);
            formData.append('ruas_id', ruas_id);
            formData.append('jumlah_lajur', jumlah_lajur);
            formData.append('timezone', timezone);
            formData.append('dataset', posisi_kamera);
            formData.append('address', ip_addr);
            
            if(isNaN(conf_siang) || isNaN(conf_malam)){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hanya Boleh di Isi dengan Angka!!'
                })
            }else if(conf_siang < 0 ||conf_siang > 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Confidance AI Siang Tidak Boleh Kurang dari 0 dan Lebih dari 1'
                })
            }else if(conf_malam < 0 ||conf_malam > 1){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Confidance AI Malam Tidak Boleh Kurang dari 0 dan Lebih dari 1'
                })
            }else if(ruas_id == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Mohon Pilih Ruas!!'
                })
            }else if(titik_ruas == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik Ruas Tidak Boleh kosong!!'
                })
            }else if(titik_km == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik KM Tidak Boleh kosong!!'
                })
            }else if(titik_meter == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Titik Meter Tidak Boleh kosong!!'
                })
            }else if(link_kamera == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Link Kamera Tidak Boleh kosong!!'
                })
            }else if(titik_cctv == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal Concat titik CCTV!!'
                })
            }else if(jumlah_lajur == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jumlah Lajur Tidak Boleh Kosong!!'
                })
            }else if(posisi_kamera == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Posisi Kamera!!'
                })
            }else if(klasifikasi_bus == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Klasifikasi Bus!!'
                })
            }else if(klasifikasi_car == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Klasifikasi Car!!'
                })
            }else if(klasifikasi_truck == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Klasifikasi Truck!!'
                })
            }else if(timezone == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Timezone!!'
                })
            }else if(ip_addr == ''){
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Jangan Lupa Pilih Alamat Server!!'
                })
            }else{
                Swal.fire({
                    title: 'Yakin Data CCTV Sudah Benar? Dan Siap Di Simpan?',
                    customClass: 'swal-wide',
                    showCancelButton: true,
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#0000cc',
                    confirmButtonText: 'Ya, Simpan',
                    reverseButtons: true
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            type: "POST",
                            contentType: false,
                            processData: false,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: formData,
                            dataType: "JSON",
                            url: "{{ route('saveCctv') }}",
                            beforeSend: function() {
                                $('body').loading();
                            },
                            success: function(response){
                                $('body').loading('stop');
                                var sts     = response.data.status_id;
                                var code    = response.status;
                                if(sts == 1 && code == 200){
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Berhasil Simpan CCTV Baru!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    location.href = "{{ route('cctv') }}";
                                }else if(sts == 0 && code == 200){
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal Simpan CCTV, Karena Nama CCTV Tersebut Sudah Tersedia! Silahkan Ganti!!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!!!',
                                        text: 'Gagal Simpan CCTV Baru!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                }
                            },
                            error: function(jqXHR, exception) {
                                $('body').loading('stop');
                                if (jqXHR.status === 0) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Not connect.\n Verify Network.'
                                    })
                                } else if (jqXHR.status == 404) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Requested page not found. [404]'
                                    })
                                } else if (jqXHR.status == 500) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Internal Server Error [500].'
                                    })
                                } else if (exception === 'parsererror') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Requested JSON parse failed.'
                                    })
                                } else if (exception === 'timeout') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Time out error.'
                                    })
                                } else if (exception === 'abort') {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Ajax request aborted.'
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'DATA TIDAK TER RELOAD DENGAN BAIK',
                                        text: 'Uncaught Error.\n' + jqXHR.responseText
                                    })
                                }
                            }
                        });
                    }else{
                        $('body').loading('stop');
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Batal Simpan Data CCTV Baru!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
        
                })
            }

        });
        //end CCTV Baru
        // step 13
    });
</script>
@endsection

