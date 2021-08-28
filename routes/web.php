<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
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


Route::group(['middleware' => ['auth']], function () {
    Route::resource('user', UserController::class);
    // officer
    Route::resource('report', ReportController::class);
    Route::get('add/vehicle', [ReportController::class,'getAddVehicle'])->name('add.vehicle');
    Route::post('add/vehicle', [ReportController::class,'postAddVehicle'])->name('add.vehicle');
    // public
    Route::resource('report/public', PublicReportController::class);
    Route::get('public/add/vehicle', [PublicReportController::class,'getAddVehicle'])->name('public.add.vehicle');
    Route::post('public/add/vehicle', [ReportController::class,'postAddVehicle'])->name('public.add.vehicle');
    Route::resource('type', ReportTypeController::class);
    Route::resource('vehicle', VehicleController::class);
});
Auth::routes();
Route::get('/', [HomeController::class,'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/check/civil', [HomeController::class, 'getCheckCivilId'])->name('check.civil');
Route::post('/check/civil', [HomeController::class, 'postCheckCivilId'])->name('check.civil');
Route::get('language/{locale}', [HomeController::class,'changeLanguage'])->name('language.change');
