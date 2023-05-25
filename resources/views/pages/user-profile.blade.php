@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

<style>
    video {
    width: 100%;
    height: auto;
    }
</style>

<link href="https://vjs.zencdn.net/7.2.3/video-js.css" rel="stylesheet">

@section('content')
@include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
<div class="container-fluid py-4">
    <form id="form">
        <div class="row">
        <div class="col-lg-3" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="region" onchange="$('#form').submit()">
                    <option value="-- Jasa Marga Group --">-- Jasa Marga Group --</option>
                </select>
            </div>
            <div class="col-lg-3" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="ruas" onchange="$('#form').submit()">
                    <option value="-- Ruas --">-- Ruas --</option>
                </select>
            </div>
            <div class="col-lg-3" style="z-index: 0;">
                <select class="js-example-basic-single form-control" name="lokasi" onchange="$('#form').submit()">
                    <option value="-- Lokasi --">-- Lokasi --</option>
                </select>
            </div>
            <div class="col-lg-3" style="z-index: 0;">
                <input type="date" name="tanggal" value="{{request()->tanggal}}" class="form-control" id="" onchange="$('#form').submit()">
            </div>
        </div>
    </form>

    <div class="pt-4"></div>
    <div class="row mt-2">
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example1' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/1/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example2' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/2/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example3' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/3/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example4' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/4/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example5' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/5/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example6' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/6/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example7' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/7/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example8' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/8/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example9' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/9/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div><div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example10' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/10/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example11' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/11/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example12' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/12/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg-3 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
                <div class="card-body p-3">
                    <video id='hls-example13' width="300" class="video-js vjs-default-skin" controls muted playsinline>
                        <source src="./video/13/index.m3u8" type="application/x-mpegURL"/>
                    </video>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth.footer')
    
</div>
@endsection

@push('js')
<script src="https://vjs.zencdn.net/ie8/ie8-version/videojs-ie8.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/videojs-contrib-hls/5.14.1/videojs-contrib-hls.js"></script>
<script src="https://vjs.zencdn.net/7.2.3/video.js"></script>

<script>
    var player1 = videojs('hls-example1');
    var player2 = videojs('hls-example2');
    var player3 = videojs('hls-example3');
    var player4 = videojs('hls-example4');
    var player5 = videojs('hls-example5');
    var player6 = videojs('hls-example6');
    var player7 = videojs('hls-example7');
    var player8 = videojs('hls-example8');
    var player9 = videojs('hls-example9');
    var player10 = videojs('hls-example10');
    var player11 = videojs('hls-example11');
    var player12 = videojs('hls-example12');
    var player13 = videojs('hls-example13');

    player1.play();
    player2.play();
    player3.play();
    player4.play();
    player5.play();
    player6.play();
    player7.play();
    player8.play();
    player9.play();
    player10.play();
    player11.play();
    player12.play();
    player13.play();
</script>
<script src="./assets/js/plugins/chartjs.min.js"></script>
@endpush