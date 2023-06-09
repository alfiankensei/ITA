<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="{{ route('home') }}" target="_blank">
            <img src="./img/cctv-yl-removebg-preview.png" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Intelligent Traffic Analysis</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chart-bar-32 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'fola' ? 'active' : '' }}" href="{{ route('fola') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-chart-bar-32 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">FOLA</span>
                </a>
            </li> -->
            <!-- <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'tables1') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'tables1']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Report</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{ str_contains(request()->url(), 'tables2') == true ? 'active' : '' }}" href="{{ route('page', ['page' => 'tables2']) }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Report</span>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'rtl' ? 'active' : '' }}" href="{{ route('rtl') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Live</span>
                </a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'rtl2' ? 'active' : '' }}" href="{{ route('rtl2') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Live</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'ruas' ? 'active' : '' }}" href="{{ route('ruas') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-world-2 text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Ruas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'cctv' || Route::currentRouteName() == 'tambahCctv' ? 'active' : '' }}" href="{{ route('cctv') }}">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-camera-compact text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">CCTV</span>
                </a>
            </li>
        </ul>
    </div>
</aside>