@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Report V2'])
    <div class="container-fluid py-4">
        <form id="form">
            <div class="row">
                <div class="col-lg-1" style="z-index: 0;"></div>
                <div class="col-lg-2" style="z-index: 0;">
                    <select class="js-example-basic-single form-control" name="region" id="region" onchange="$('#form').submit()">
                        <option value="-- Jasa Marga Group --">-- Jasa Marga Group --</option>
                        @foreach($region as $value)
                        <option value="{{$value}}" {{$value == request()->region ? 'selected' : ''}}> {{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2" style="z-index: 0;">
                    <select class="js-example-basic-single form-control" name="ruas" id="ruas" onchange="$('#form').submit()">
                        <option value="-- Ruas --">-- Ruas --</option>
                        @foreach($ruas as $value)
                        <option value="{{$value}}" {{$value == request()->ruas ? 'selected' : ''}}> {{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2" style="z-index: 0;">
                    <select class="js-example-basic-single form-control" name="lokasi" id="lokasi" onchange="$('#form').submit()">
                        <option value="-- Lokasi --">-- Lokasi --</option>
                        @foreach($location as $value)
                        <option value="{{$value}}" {{$value == request()->lokasi ? 'selected' : ''}}> {{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2" style="z-index: 0;">
                    <input type="date" name="tanggalawal" value="{{request()->tanggalawal}}" class="form-control" id="tanggalawal" onchange="$('#form').submit()">
                </div>
                <div class="col-lg-2" style="z-index: 0;">
                    <input type="date" name="tanggalakhir" value="{{request()->tanggalakhir}}" class="form-control" id="tanggalakhir" onchange="$('#form').submit()">
                </div>
                
                <div class="col-lg-1" style="z-index: 0;"></div>
            </div>
        </form>
        <div class="pt-4"></div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>{{$datareport[0]->location}} Tanggal {{$datareport[0]->tanggalawal}} s.d {{$datareport[0]->tanggalakhir}}</h6>
						 <div style="float: right;">
						  <button type="button" class="btn btn-sm btn-success" onclick="exportxls()">
						  
							<i class="fas fa-file-excel"></i> Export Excel
						  </button>						  
						</div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <h6>Tanggal</h6></th>
                                        <th rowspan="2" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <h6>Jam</h6></th>
                                        <th colspan="5" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <h6>Jalur A</h6></th>
                                        <th colspan="5" class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            <h6>Jalur B</h6></th>
                                    </tr>
                                    <tr>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Car</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Bus</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Truk</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            AVG Speed</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Car</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Bus</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Truk</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Total</th>
                                        <th class="align-middle text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            AVG Speed</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($datareport as $value)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->tanggal}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->jam}}:00 - {{$value->jam}}:59</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->car_down_all}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->bus_down_all}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->truck_down_all}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->all_down}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->speedavg_down}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->car_up_all}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->bus_up_all}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->truck_up_all}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->all_up}}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$value->speedavg_up}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		    @include('layouts.footers.auth.footer')
  </div>
@endsection
@section('script')
  <script type="text/javascript">
   
	function exportxls() {
      var region = $('#region').find(':selected').val(),
        ruas = $('#ruas').find(':selected').val(),
        lokasi = $('#lokasi').find(':selected').val(),
        tanggalawal = $('#tanggalawal').val(),
        tanggalakhir = $('#tanggalakhir').val()

      var params = {
        region: region,
        ruas: ruas,
        lokasi: lokasi,
        tanggalawal: tanggalawal,
        tanggalakhir: tanggalakhir
      };
      let url = '{{ route('exportReport2', ':params') }}';
      url = url.replace(':params', JSON.stringify(params));
      document.location.href = url;

    }
  </script>
@endsection

