<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanPembelian;
use App\Http\Controllers\LaporanPembelianController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReturController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');
Route::resource('/pegawai', PegawaiController::class);
Route::resource('/supplier', SupplierController::class);
Route::resource('/produk', ProdukController::class);
Route::resource('/kategori', KategoriController::class);
Route::resource('/unit', UnitController::class);
Route::resource('/pembelian', PembelianController::class);
Route::resource('/laporan-pembelian', LaporanPembelianController::class);
Route::resource('/penjualan', PenjualanController::class);
Route::resource('/laporan-penjualan', LaporanPenjualanController::class);

// Route::get('/penjualan/add-item', [PenjualanController::class, 'addItem']);
Route::post('/penjualan/add-item', [PenjualanController::class, 'addItem']);
Route::post('/penjualan/update-produk', [PenjualanController::class, 'updateProduk']);
Route::delete('/penjualan-hapus/{id}', [PenjualanController::class, 'hapus']);
// Route::delete('/penjualan-hapus/{id}', 'PenjualanController@hapus')->name('penjualan.hapus');
Route::get('/produk-export', [ProdukController::class, 'produkExport']);
Route::get('/sessions', [SessionController::class, 'index'])->name('sessions.index');



Route::resource('/retur', ReturController::class);
