@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'FOLA'])
<div class="container-fluid py-4">
    <form id="form">
        <div class="row">
            <div class="col-lg-5" style="z-index: 0;">  
            </div>
            <div class="col-lg-3" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="lokasi">
                    <option value="-- Lokasi --">-- Lokasi --</option>
                    @foreach($location['list_titik_cctv'] as $value)
                    <option value="<?=str_replace('+', ' ', str_replace('-', ' ', $value))?>" {{$value == request()->lokasi ? 'selected' : ''}}> <?=str_replace('+', ' ', str_replace('-', ' ', $value))?></option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-1" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="count">
                    <option value="-- Jam --">-- Jam --</option>
                    <option value="1" {{$value == request()->count ? 'selected' : ''}}>1</option>
                    <option value="2" {{$value == request()->count ? 'selected' : ''}}>2</option>
                    <option value="3" {{$value == request()->count ? 'selected' : ''}}>3</option>
                    <option value="4" {{$value == request()->count ? 'selected' : ''}}>4</option>
                    <option value="5" {{$value == request()->count ? 'selected' : ''}}>5</option>
                    <option value="6" {{$value == request()->count ? 'selected' : ''}}>6</option>
                    <option value="7" {{$value == request()->count ? 'selected' : ''}}>6</option>
                    <option value="8" {{$value == request()->count ? 'selected' : ''}}>6</option>
                    <option value="9" {{$value == request()->count ? 'selected' : ''}}>6</option>
                    <option value="10" {{$value == request()->count ? 'selected' : ''}}>6</option>
                    <option value="11" {{$value == request()->count ? 'selected' : ''}}>6</option>
                    <option value="12" {{$value == request()->count ? 'selected' : ''}}>6</option>
                </select>
            </div>
            <div class="col-lg-1" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="arah">
                    <option value="-- Jam --">-- Arah --</option>
                    <option value="A" {{$value == request()->count ? 'selected' : ''}}>A</option>
                    <option value="B" {{$value == request()->count ? 'selected' : ''}}>B</option>
                </select>
            </div>
            <div class="col-lg-2" style="z-index: 0;">
                <button type="submit" class="btn btn-success">Submit</button>
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
        @include('components.dashboard-lalin2', ['jenisLalin' => 'A', 'datacounter'=> $datacounter['A'] , 'datachart' =>$datachart['A']])
    </div>
    @endif
    @if($datacounter['B']['all'] != 0)
    <div class="pt-2"></div>
    <div id="content-B">
        @include('components.dashboard-lalin2', ['jenisLalin' => 'B', 'datacounter'=> $datacounter['B'], 'datachart'=>$datachart['B']])
    </div>
    @endif

    @include('layouts.footers.auth.footer')
    
</div>
@endsection

@push('js')
<script src="./assets/js/plugins/Chart.min.js"></script>
<script src="./assets/js/plugins/chartjs-plugin-datalabels.min.js"></script>
@endpush