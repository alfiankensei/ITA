@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Live V2'])
<div class="container-fluid py-4">
    <form id="form">
        <div class="row">
        <div class="col-lg-6" style="z-index: 0;">
                <select class="js-example-basic-single form-control" style="text-align-last:center;" name="region" onchange="$('#form').submit()">
                    <option value="-- Jasa Marga Group --">-- Jasa Marga Group --</option>
                    @foreach($region as $value)
                    <option value="{{$value}}" {{$value == request()->region ? 'selected' : ''}}> {{$value}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-6" style="z-index: 0;">
                <select class="js-example-basic-single form-control" style="text-align-last:center;" name="ruas" onchange="$('#form').submit()">
                    <option value="-- Ruas --">-- Ruas --</option>
                    @foreach($ruas as $value)
                    <option value="{{$value}}" {{$value == request()->ruas ? 'selected' : ''}}> {{$value}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <div class="pt-4"></div>
    <div class="row mt-2">
        @foreach($datavideo as $value)
        <div class="col-lg-3 mb-lg-0 mb-4 pb-2">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <center>
                        <h6>{{$value->location}}</h6>
                        @if($value->status == 1)
                        <video id="{{$value->id}}" class="video-js" preload="auto" data-setup="{}" style="width:100%; object-fit: contain;" height="240" controls autoplay muted playsinline>
                            <source src="{{$value->filestream}}" type="application/x-mpegURL"/>
                        </video>
                        @else
                        <br><br><br>
                        <h5>Location is currently inactive</h6>
                        <br><br><br><br>
                        @endif
                    </center>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @include('layouts.footers.auth.footer')
    
</div>
@endsection

@push('js')
<script>
    
</script>
<script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
<script src="./assets/js/plugins/chartjs.min.js"></script>
@endpush