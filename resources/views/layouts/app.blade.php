<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        Intelligent Traffic Analysis 
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
	<script src="{{ asset('vendor/fontawesome/css/all.min.css') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/fontawesome/js/all.min.js') }}" type="text/javascript"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css" rel="stylesheet" />
    {{-- select 2 --}}
	<script src="{{ asset('assets/css/select2.min.css') }}" type="text/javascript"></script>
    {{-- datatables --}}
	<link href="{{ asset('vendor/datatables-bs4/css/dataTables.css') }}" rel="stylesheet" type="text/css" />
	{{-- <link href="{{ asset('vendor/datatables-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('vendor/datatables-responsive/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('vendor/datatables-buttons/css/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" /> --}}

    {{-- sweetalert --}}
	<link href="{{ asset('vendor/sweetalert/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
	<script src="{{ asset('vendor/sweetalert/sweetalert2.min.js') }}" type="text/javascript"></script>
    {{-- loading --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/loading/loading.css') }}">
    <style>
        .footer {
            position: relative;
            left: 0;
            bottom: 0;
            width: 100%;
            border-top: 1px solid #dee2e6;
            background-color: #869099;
            color: white;
            text-align: center;
            padding: 1rem;
            margin-top: 2rem;
        }
        .footer-text-left {
            padding-left:20px;
            float:left;
        }
        .footer-content-right {
            padding-right:20px;
            float:right;
        }
    </style>
	
</head>

<body class="{{ $class ?? '' }}">

    @guest
    @yield('content')
    @endguest

    @auth
    @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'virtual-reality']))
    @yield('content')
    @else
    @if (!in_array(request()->route()->getName(), ['profile', 'profile-static']))
    <div class="min-height-150 bg-primary position-absolute w-100"></div>
    @elseif (in_array(request()->route()->getName(), ['profile-static', 'profile']))
    <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>
    @endif
    @include('layouts.navbars.auth.sidenav')
    <main class="main-content border-radius-lg">
        @yield('content')
		
    </main>
    @endif
    @endauth

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
	
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="assets/js/argon-dashboard.js"></script>

    {{-- datatables --}}
	<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/datatables-bs4/js/dataTables.js') }}" type="text/javascript"></script>
	{{-- <script src="{{ asset('vendor/datatables-bs4/js/dataTables.bootstrap4.min.js') }}" type="text/javascript"></script> --}}
	<script src="{{ asset('vendor/datatables-responsive/js/dataTables.responsive.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/datatables-responsive/js/responsive.bootstrap4.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/datatables-buttons/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/datatables-buttons/js/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/datatables-buttons/js/buttons.html5.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/datatables-buttons/js/buttons.print.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/datatables-buttons/js/buttons.colVis.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/jszip/jszip.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/pdfmake/pdfmake.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('vendor/pdfmake/vfs_fonts.js') }}" type="text/javascript"></script>

    {{-- select2 --}}
	<script src="{{ asset('assets/js/select2.min.js') }}" type="text/javascript"></script>

    {{-- loading --}}
    <script src="{{ asset('vendor/loading/loading.js') }}"></script>
    <script src="{{ asset('vendor/loading/jquery.loading.min.js') }}"></script>
    
	@yield('script')
    @stack('js')
    @stack('js-chart')
	
</body>

</html>