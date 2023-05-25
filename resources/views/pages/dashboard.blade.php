@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard V2'])
<div class="container-fluid py-4">
    <form id="form">
        <div class="row">
        <div class="col-lg-3" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="region" onchange="$('#form').submit()">
                    <option value="-- Jasa Marga Group --">-- Jasa Marga Group --</option>
                    @foreach($region as $value)
                    <option value="{{$value}}" {{$value == request()->region ? 'selected' : ''}}> {{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="ruas" onchange="$('#form').submit()">
                    <option value="-- Ruas --">-- Ruas --</option>
                    @foreach($ruas as $value)
                    <option value="{{$value}}" {{$value == request()->ruas ? 'selected' : ''}}> {{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="lokasi" onchange="$('#form').submit()">
                    <option value="-- Lokasi --">-- Lokasi --</option>
                    @foreach($location as $value)
                    <option value="{{$value}}" {{$value == request()->lokasi ? 'selected' : ''}}> {{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-3" style="z-index: 0;">
                <input type="date" name="tanggal" value="{{request()->tanggal}}" class="form-control" id="" onchange="$('#form').submit()">
            </div>
        </div>
    </form>

    @if($datacounter['A']['all'] != 0)
    <div class="pt-4"></div>
    <div class="row">
        <h2>{{$datacounter['A']['location']}}</h1>
    </div>
    @elseif($datacounter['B']['all'] != 0)
    <div class="pt-4"></div>
    <div class="row">
        <h2>{{$datacounter['B']['location']}}</h1>
    </div>
    @endif
    @if($datacounter['A']['all'] != 0)
    <div class="pt-2"></div>
    <div id="content-A">
        @include('components.dashboard-lalin', ['jenisLalin' => 'A', 'datacounter'=> $datacounter['A'] , 'datachart' =>$datachart['A']])
    </div>
    @endif
    @if($datacounter['B']['all'] != 0)
    <div class="pt-2"></div>
    <div id="content-B">
        @include('components.dashboard-lalin', ['jenisLalin' => 'B', 'datacounter'=> $datacounter['B'], 'datachart'=>$datachart['B']])
    </div>
    @endif

    @include('layouts.footers.auth.footer')
    
</div>
@endsection

@push('js')
<script src="./assets/js/plugins/Chart.min.js"></script>
<script src="./assets/js/plugins/chartjs-plugin-datalabels.min.js"></script>
@endpush