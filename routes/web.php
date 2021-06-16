<?php

use App\Http\Controllers\HomeController;
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
    Route::resource('report', ReportController::class);
    Route::resource('type', ReportTypeController::class);
    Route::resource('vehicle', VehicleController::class);
});
Auth::routes();
Route::get('/', [HomeController::class,'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('language/{locale}', [HomeController::class,'changeLanguage'])->name('language.change');
