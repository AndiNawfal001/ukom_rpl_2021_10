<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\PemutihanController;
use App\Http\Controllers\PengajuanBBController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PerawatanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RuanganController;

// use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/dashboard', [DashboardController::class, 'dashboard']);


Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth', 'level:admin']], function () {
    Route::get('/log', [LoggingController::class, 'index'])->middleware('auth');
});

//Route Group untuk menggabungkan banyaknya middleware
Route::group(['middleware' => ['auth', 'level:admin,manajemen']], function () {

    // APPROVAL BARANG BARU
    Route::get('/approval/BB', [ApprovalController::class, 'indexBarangBaru'])->middleware('auth');
    Route::get('/approval/BB/setuju/{id}', [ApprovalController::class, 'statusSetujuBarangBaru'])->middleware('auth');
    Route::get('/approval/BB/tidaksetuju/{id}', [ApprovalController::class, 'statusTidakSetujuBarangBaru'])->middleware('auth');

    // APPROVAL PERBAIKAN
    Route::get('/approval/PB', [ApprovalController::class, 'indexPerbaikan'])->middleware('auth');
    Route::get('/approval/PB/setuju/{id}', [ApprovalController::class, 'statusSetujuPerbaikan'])->middleware('auth');
    Route::get('/approval/PB/tidaksetuju/{id}/{kode}', [ApprovalController::class, 'statusTidakSetujuPerbaikan'])->middleware('auth');

    // APPROVAL PEMUTIHAN
    Route::get('/approval/pemutihan', [ApprovalController::class, 'indexPemutihan'])->middleware('auth');
    Route::get('/approval/pemutihan/setuju/{id}/{kode}', [ApprovalController::class, 'statusSetujuPemutihan'])->middleware('auth');
    Route::get('/approval/pemutihan/tidaksetuju/{id}', [ApprovalController::class, 'statusTidakSetujuPemutihan'])->middleware('auth');

    // BARANG MASUK
    Route::get('/barangMasuk', [BarangMasukController::class, 'index'])->middleware('auth');
    Route::get('/barangMasuk/tambah/{id}', [BarangMasukController::class, 'formTambah'])->middleware('auth');
    Route::post('/barangMasuk/tambah/simpan', [BarangMasukController::class, 'store'])->middleware('auth');

    // JENIS BARANG
    Route::post('/jenisBarang/tambah', [JenisBarangController::class, 'store'])->middleware('auth');
    Route::get('/jenisBarang/hapus/{id}', [JenisBarangController::class, 'hapus'])->middleware('auth');

    // HISTORY BARANGMASUK
    Route::get('/barangMasuk/history/{id}', [BarangMasukController::class, 'detailBarangMasuk'])->middleware('auth');
});

// BARANG
Route::get('/barang', [BarangController::class, 'index'])->middleware('auth');
Route::get('/barang/detail/{id}', [BarangController::class, 'detail'])->middleware('auth');
Route::get('/barang/detail/spesifik/{id}', [BarangController::class, 'spesifik'])->middleware('auth');
Route::post('/barang/detail/update/{id}', [BarangController::class, 'update'])->middleware('auth');

// SUPPLIER
Route::get('/supplier', [SupplierController::class, 'index'])->middleware('auth');
Route::get('/supplier/tambah', [SupplierController::class, 'formTambah'])->middleware('auth');
Route::post('/supplier/simpan', [SupplierController::class, 'store'])->middleware('auth');
Route::get('/supplier/edit/{id}', [SupplierController::class, 'edit'])->middleware('auth');
Route::post('/supplier/editsimpan', [SupplierController::class, 'update'])->middleware('auth');
Route::get('/supplier/hapus/{id}', [SupplierController::class, 'hapus'])->middleware('auth');

// PENGGUNA
Route::get('/pengguna', [PenggunaController::class, 'index'])->middleware('auth');
Route::group(['middleware' => ['auth', 'level:admin']], function () {
    Route::get('/pengguna/tambah', [PenggunaController::class, 'formTambah'])->middleware('auth');
    Route::post('/pengguna/simpan', [PenggunaController::class, 'store'])->middleware('auth');
    Route::get('/pengguna/edit/{id}', [PenggunaController::class, 'edit'])->middleware('auth');
    Route::post('/pengguna/edit/editsimpan', [PenggunaController::class, 'editsimpan'])->middleware('auth');
    Route::get('/pengguna/hapus/{id}', [PenggunaController::class, 'hapus'])->middleware('auth');
});

// PENGAJUAN BARANG BARU
Route::get('/pengajuan/BB', [PengajuanBBController::class, 'index'])->middleware('auth');
Route::get('/pengajuan/BB/tambah', [PengajuanBBController::class, 'formTambah'])->middleware('auth');
Route::post('/pengajuan/BB/simpan', [PengajuanBBController::class, 'store'])->middleware('auth');
Route::get('/pengajuan/BB/edit/{id}', [PengajuanBBController::class, 'edit'])->middleware('auth');
Route::post('/pengajuan/BB/update/{id}', [PengajuanBBController::class, 'update'])->middleware('auth');
Route::get('/pengajuan/BB/hapus/{id}', [PengajuanBBController::class, 'hapus'])->middleware('auth');

// PENGAJUAN PERBAIKAN
Route::get('/pengajuan/PB', [PerbaikanController::class, 'index'])->middleware('auth');
Route::get('/pengajuan/PB/pilihBarang', [PerbaikanController::class, 'pilihBarang'])->middleware('auth');
Route::post('/pengajuan/PB/perbaikan/simpanperbaikan', [PerbaikanController::class, 'simpanperbaikan'])->middleware('auth');
Route::get('/pengajuan/PB/hapus/{id}', [PerbaikanController::class, 'hapus'])->middleware('auth');
Route::post('/PB/selesaiPerbaikan/simpanSelesaiPerbaikan', [PerbaikanController::class, 'simpanSelesaiPerbaikan'])->middleware('auth');

// PENGAJUAN PEMUTIHAN
Route::get('/pemutihan', [PemutihanController::class, 'index'])->middleware('auth');
Route::get('/pemutihan/pilihbarang', [PemutihanController::class, 'pilihbarang'])->middleware('auth');
Route::post('/pemutihan/pemutihan/simpanpemutihan', [PemutihanController::class, 'simpanpemutihan'])->middleware('auth');
Route::get('/pemutihanLangsung/pilihBarang', [PemutihanController::class, 'pilihbarangPemutihanLangsung'])->middleware('auth');
Route::post('/pemutihan/pemutihanLangsung/simpanpemutihanLangsung', [PemutihanController::class, 'simpanpemutihanLangsung'])->middleware('auth');

// PERAWATAN
Route::get('/perawatan', [PerawatanController::class, 'index'])->middleware('auth');
Route::get('/perawatan/pilihBarang', [PerawatanController::class, 'pilihbarangPerawatan'])->middleware('auth');
Route::post('/perawatan/simpanperawatan', [PerawatanController::class, 'simpanperawatan'])->middleware('auth');
Route::post('/perawatan/edit/editsimpan', [PerawatanController::class, 'editsimpan'])->middleware('auth');
Route::get('/perawatan/hapus/{id}', [PerawatanController::class, 'hapus'])->middleware('auth');

// RUANGAN
Route::get('/ruangan', [RuanganController::class, 'index'])->middleware('auth');
Route::get('/ruangan/tambah', [RuanganController::class, 'formTambah'])->middleware('auth');
Route::post('/ruangan/simpan', [RuanganController::class, 'store'])->middleware('auth');
Route::get('/ruangan/edit/{id}', [RuanganController::class, 'edit'])->middleware('auth');
Route::post('/ruangan/editsimpan', [RuanganController::class, 'update'])->middleware('auth');
Route::get('/ruangan/hapus/{id}', [RuanganController::class, 'hapus'])->middleware('auth');
