<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\DosenController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('list/mahasiswa',[MahasiswaController::class, 'index']);

Route::get('get-mahasiswa',[MahasiswaController::class, 'get_data']);

Route::post('store-mahasiswa',[MahasiswaController::class,'store_mahasiswa']);

Route::get('get-mahasiswa/{id}',[MahasiswaController::class,'get_detail']);

Route::delete('hapus-mahasiswa/{id}',[MahasiswaController::class,'hapus_mahasiswa']);

Route::get('list/jurusan',[JurusanController::class,'index']);

Route::get('get-jurusan',[JurusanController::class,'get_jurusan']);

Route::post('store-jurusan',[JurusanController::class,'store_jurusan']);

Route::get('get-jurusan/{id}',[JurusanController::class,'get_detail']);

Route::delete('hapus-jurusan/{id}',[JurusanController::class,'hapus_jurusan']);

Route::get('list/dosen',[DosenController::class,'index']);

Route::get('get-dosen',[DosenController::class,'get_dosen']);

Route::post('store-dosen',[DosenController::class,'store_dosen']);

Route::get('get-dosen/{id}',[DosenController::class,'get_detail']);

Route::delete('hapus-dosen/{id}',[DosenController::class,'hapus_dosen']);



