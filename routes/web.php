<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;            
            

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');

	
Route::group(['middleware' => 'auth'], function () {
	Route::get('/daftar-user', [RegisterController::class, 'create'])->name('register');
	Route::post('/daftar-user', [RegisterController::class, 'store'])->name('register.perform');
	Route::get('/reset-kode', [ResetPassword::class, 'show'])->name('reset-password');
	Route::post('/reset-kode', [ResetPassword::class, 'send'])->name('reset.perform');
	Route::get('/ganti-kode', [ChangePassword::class, 'show'])->name('change-password');
	Route::post('/ganti-kode', [ChangePassword::class, 'update'])->name('change.perform');
	Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
	Route::get('/fola', [HomeController::class, 'index2'])->name('fola')->middleware('auth');
	Route::get('/data/{type}', [HomeController::class, 'realtime'])->name('realtime')->middleware('auth');
	Route::get('/data/chart/{type}', [HomeController::class, 'realtimeChart'])->name('realtimeChart')->middleware('auth');
	Route::get('/data2/{type}', [HomeController::class, 'realtime2'])->name('realtime2')->middleware('auth');
	Route::get('/data2/chart/{type}', [HomeController::class, 'realtimeChart2'])->name('realtimeChart2')->middleware('auth');
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/rtl2', [PageController::class, 'rtl2'])->name('rtl2');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static'); 
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static'); 
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::get('/exportReport/{params?}', [PageController::class, 'exportReport'])->name('exportReport');
	Route::get('/exportReport2/{params?}', [PageController::class, 'exportReport2'])->name('exportReport2');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');
	Route::get('/file-import',[PageController::class, 'importView'])->name('import-view');
    Route::post('/import',[PageController::class, 'import'])->name('import');
    Route::get('/export-lalin',[PageController::class, 'exportReportLalin'])->name('export-lalin');
});