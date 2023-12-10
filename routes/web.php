<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;

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
// login dan logout
Route::get('/login' , [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login' , [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout' , [LoginController::class, 'logout'])->name('logout');



Route::group(['middleware' => ['auth', 'ceklevel:admin,gudang']], function(){
    Route::get('/home' , [HomeController::class, 'index'])->name('home');

    // ADMIN PUNYA
    // data user
    Route::get('/user', [UserController::class, 'index']);
    Route::post('/user/store', [UserController::class, 'store']);
    Route::post('/user/update/{id}', [UserController::class, 'update']);
    Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);

    // data barang
    Route::get('/barang', [BarangController::class, 'index']);
    Route::post('/barang/store', [BarangController::class, 'store']);
    Route::post('/barang/update/{id}', [BarangController::class, 'update']);
    Route::get('/barang/destroy/{id}', [BarangController::class, 'destroy']);
    // ADMIN PUNYA


    // GUDANG PUNYA
    // data barang masuk
    Route::get('/barang_masuk', [BarangMasukController::class, 'index']);
    Route::post('/barang_masuk/store/{id}', [BarangMasukController::class, 'store']);
    Route::post('/barang_masuk/update/{id}', [BarangMasukController::class, 'update']);
    Route::get('/barang_masuk/destroy/{id}', [BarangMasukController::class, 'destroy']);

    // data barang keluar
    Route::get('/barang_keluar', [BarangKeluarController::class, 'index']);
    Route::post('/barang_keluar/store/{id}', [BarangKeluarController::class, 'store']);
    Route::post('/barang_keluar/update/{id}', [BarangKeluarController::class, 'update']);
    Route::get('/barang_keluar/destroy/{id}', [BarangKeluarController::class, 'destroy']);
    // GUDANG PUNYA
});




