<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DaftarjurusanController;
use App\Http\Controllers\DaftardosenController;

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

Route::get('get-master-product-paging', [ProductController::class,'get_product_paging']);

Route::get('list/product',[ProductController::class, 'index']);

Route::post('store-product',[ProductController::class,'store_product']);

Route::get('get-product/{id}',[ProductController::class,'get_detail']);

Route::delete('hapus-product/{id}',[ProductController::class,'hapus_product']);

Route::get('get-master-product-paging', [DaftarjurusanController::class,'get_product_paging']);

Route::get('list/daftarjurusan',[DaftarjurusanController::class, 'index']);

Route::post('store-daftarjurusan',[DaftarjurusanController::class,'store_daftarjurusan']);

Route::get('get-daftarjurusan/{id}',[DaftarjurusanController::class,'get_detail']);

Route::delete('hapus-daftarjurusan/{id}',[DaftarjurusanController::class,'hapus_daftarjurusan']);

Route::get('get-master-product-paging', [DaftardosenController::class,'get_product_paging']);

Route::get('list/daftardosen',[DaftardosenController::class, 'index']);

Route::post('store-daftardosen',[DaftardosenController::class,'store_daftardosen']);

Route::get('get-daftardosen/{id}',[DaftardosenController::class,'get_detail']);

Route::delete('hapus-daftardosen/{id}',[Daftardosen::class,'hapus_daftardosen']);


