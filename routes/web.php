<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\TransaksiDetail;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

//auth
Route::get('/daftar', [AuthController::class, 'index']);
Route::post('/user/daftar', [AuthController::class, 'store'])->name('store');
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get('/logout', [AuthController::class, 'logout']);



Route::group(['middleware' => ['auth', 'cekrole:admin']], function(){
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard']);

    //produk
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/admin/produk/store', [ProdukController::class, 'store']);
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit']);
    Route::put('/admin/produk/{id}', [ProdukController::class, 'update']);
    Route::delete('/admin/produk/{id}', [ProdukController::class, 'delete']);


    //stock
    Route::get('/admin/stock/{id}/edit', [ProdukController::class, 'editStock'])->name('editStock');
    Route::put('/admin/stock/{id}', [ProdukController::class, 'stock']);


    //user
    Route::get('/admin/user', [UserController::class, 'user']);
    Route::post('/admin/user/store', [UserController::class, 'store']);
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit']);
    Route::put('/admin/user/{id}', [UserController::class, 'update']);
    Route::delete('/admin/user/{id}', [UserController::class, 'delete']);
});

Route::group(['middleware' => ['auth', 'cekrole:kasir']], function(){
    //penjualan
    Route::get('/kasir/dashboard', [DashboardController::class, 'index']);
    // Route::get('/kasir/penjualan', [PenjualanController::class, 'index']);
    Route::get('/kasir/penjualan/pelanggan/user', [PelangganController::class, 'user']);
    Route::get('/kasir/penjualan/pelanggan', [PelangganController::class, 'index']);
    Route::post('/kasir/penjualan/pelanggan', [PelangganController::class, 'store'])->name('kasir.pelanggan.store');
    Route::delete('/kasir/penjualan/pelanggan/{id}', [PelangganController::class, 'delete']);
    Route::get('/kasir/penjualan/pelanggan/{id}/edit', [PelangganController::class, 'edit']);
    Route::put('/kasir/penjualan/pelanggan/{id}', [PelangganController::class, 'update']);
    Route::post('/kasir/penjualan', [PenjualanController::class, 'store']);
    Route::get('/kasir/penjualan/form', [PenjualanController::class, 'form']);
    Route::get('/penjualan/export-pdf', [PenjualanController::class, 'exportPDF']);
    Route::get('/kasir/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
    Route::delete('/kasir/penjualan/{id}', [ProdukController::class, 'delete']);
    // routes/web.php
    Route::get('/kasir/penjualan/{id}/detail', [PenjualanController::class, 'showDetail'])->name('penjualan.detail');

});
    


