<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KaprogController;
use App\Http\Controllers\LevelUserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LoggingController;
use App\Http\Controllers\PemutihanController;
use App\Http\Controllers\PengajuanBBController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PerawatanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SidebarController;
use App\Models\PenggunaModel;

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

Route::get('/dashboard',[DashboardController::class,'dashboard']);

Route::get('/barang',[ BarangController::class,'index']);
Route::get('/barang/search',[ BarangController::class,'search']);
Route::get('/barang/detail/{id}',[ BarangController::class,'detail']);
Route::get('/barang/detail/search/{id}',[ BarangController::class,'searchdetail']);


Route::get('/levelUser/tambah',[LevelUserController::class,'formTambah']);
Route::post('/levelUser/simpan',[LevelUserController::class,'simpan']);

Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('/login',[LoginController::class,'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//Route Group untuk menggabungkan banyaknya middleware
Route::group(['middleware' => ['auth','level:admin,manajemen']], function (){
    Route::get('/levelUser',[LevelUserController::class,'index']);
});

Route::get('/User',[ UserController::class,'index']);
Route::get('/User/tambah',[ UserController::class,'formTambah']);
Route::post('/User/simpan',[ UserController::class,'simpan']);
Route::get('/User/edit/{id}',[UserController::class,'edit']);
Route::post('/User/edit/editsimpan',[ UserController::class,'editsimpan']);
Route::get('/User/hapus/{id}',[UserController::class,'hapus']);

Route::get('/User/kaprog', [KaprogController::class, 'index']);

// Route::group(['middleware' => ['auth','level:manajemen']], function (){

// });
Route::get('/barangMasuk',[ BarangMasukController::class,'index']);
Route::get('/barangMasuk/tambah/{id}',[ BarangMasukController::class,'formTambah']);
Route::post('/barangMasuk/tambah/simpan',[ BarangMasukController::class,'store']);

Route::get('/supplier',[ SupplierController::class,'index']);
Route::get('/supplier/search',[ SupplierController::class,'search']);
Route::post('/supplier/tambah',[ SupplierController::class,'store']);
Route::post('/supplier/update/{id}',[ SupplierController::class,'update']);
Route::get('/supplier/hapus/{id}',[SupplierController::class,'hapus']);

Route::get('/pengguna',[ PenggunaController::class,'index']);
Route::get('/pengguna/search',[ PenggunaController::class,'search']);
Route::get('/pengguna/tambah',[ PenggunaController::class,'formTambah']);
Route::post('/pengguna/simpan',[ PenggunaController::class,'store']);
Route::get('/pengguna/edit/{id}',[PenggunaController::class,'edit']);
Route::post('/pengguna/edit/editsimpan',[ PenggunaController::class,'editsimpan']);
Route::get('/pengguna/hapus/{id}',[PenggunaController::class,'hapus']);

Route::get('/approval/BB',[ ApprovalController::class,'indexBarangBaru']);
Route::get('/approval/BB/search',[ ApprovalController::class,'searchindexBarangBaru']);
Route::get('/approval/BB/detail/{id}',[ApprovalController::class,'detailBarangBaru']);
Route::get('/approval/BB/setuju/{id}',[ApprovalController::class,'statusSetujuBarangBaru']);
Route::get('/approval/BB/tidaksetuju/{id}',[ApprovalController::class,'statusTidakSetujuBarangBaru']);

Route::get('/approval/PB',[ ApprovalController::class,'indexPerbaikan']);
Route::get('/approval/PB/search',[ ApprovalController::class,'searchindexPerbaikan']);
Route::get('/approval/PB/detail/{id}',[ApprovalController::class,'detailPerbaikan']);
Route::get('/approval/PB/setuju/{id}',[ApprovalController::class,'statusSetujuPerbaikan']);
Route::get('/approval/PB/tidaksetuju/{id}/{kode}',[ApprovalController::class,'statusTidakSetujuPerbaikan']);

Route::get('/approval/pemutihan',[ ApprovalController::class,'indexPemutihan']);
Route::get('/approval/pemutihan/search',[ ApprovalController::class,'searchindexPemutihan']);
Route::get('/approval/pemutihan/detail/{id}',[ApprovalController::class,'detailPemutihan']);
Route::get('/approval/pemutihan/setuju/{id}/{kode}',[ApprovalController::class,'statusSetujuPemutihan']);
Route::get('/approval/pemutihan/tidaksetuju/{id}',[ApprovalController::class,'statusTidakSetujuPemutihan']);

Route::get('/pengajuan/BB',[ PengajuanBBController::class,'index']);
Route::get('/pengajuan/BB/search',[ PengajuanBBController::class,'search']);
Route::get('/pengajuan/BB/tambah',[ PengajuanBBController::class,'formTambah']);
Route::post('/pengajuan/BB/simpan',[ PengajuanBBController::class,'store']);
Route::get('/pengajuan/BB/edit/{id}',[PengajuanBBController::class,'edit']);
Route::post('/pengajuan/BB/edit/editsimpan',[ PengajuanBBController::class,'editsimpan']);
Route::get('/pengajuan/BB/hapus/{id}',[PengajuanBBController::class,'hapus']);
Route::get('/pengajuan/BB/detail/{id}',[PengajuanBBController::class,'detail']);

Route::get('/pengajuan/PB',[ PerbaikanController::class,'index']);
Route::get('/pengajuan/PB/search',[ PerbaikanController::class,'search']);
Route::get('/pengajuan/PB/pilihBarang',[ PerbaikanController::class,'pilihBarang']);
Route::get('/pengajuan/PB/pilihBarang/search',[ PerbaikanController::class,'searchpilihbarang']);
Route::get('/pengajuan/PB/edit/{id}',[PerbaikanController::class,'edit']);
Route::get('/pengajuan/PB/perbaikan/{id}',[PerbaikanController::class,'perbaikan']);
Route::post('/pengajuan/PB/perbaikan/simpanperbaikan',[PerbaikanController::class,'simpanperbaikan']);
Route::post('/pengajuan/PB/edit/editsimpan',[ PerbaikanController::class,'editsimpan']);
Route::get('/pengajuan/PB/hapus/{id}',[PerbaikanController::class,'hapus']);
Route::get('/PB/selesaiPerbaikan/{id}',[PerbaikanController::class,'selesaiPerbaikan']);
Route::post('/PB/selesaiPerbaikan/simpanSelesaiPerbaikan',[ PerbaikanController::class,'simpanSelesaiPerbaikan']);
Route::get('/pengajuan/PB/detail/{id}',[PerbaikanController::class,'detail']);


Route::get('/pemutihan',[ PemutihanController::class,'index']);
Route::get('/pemutihan/pilihbarang',[ PemutihanController::class,'pilihbarang']);
Route::get('/pemutihan/pilihbarang/search',[ PemutihanController::class,'pilihbarang']);
Route::get('/pemutihan/pemutihan/{id}',[PemutihanController::class,'pemutihan']);
Route::post('/pemutihan/pemutihan/simpanpemutihan',[PemutihanController::class,'simpanpemutihan']);
Route::get('/pemutihan/detail/{id}',[PemutihanController::class,'detail']);

Route::get('/pemutihanLangsung/pilihBarang',[ PemutihanController::class,'pilihbarangPemutihanLangsung']);
Route::get('/pemutihanLangsung/pilihBarang/searchPLangsung',[ PemutihanController::class,'searchPLangsung']);
Route::get('/pemutihan/pemutihanLangung/{id}',[PemutihanController::class,'pemutihanLangsung']);
Route::post('/pemutihan/pemutihanLangsung/simpanpemutihanLangsung',[PemutihanController::class,'simpanpemutihanLangsung']);

Route::get('/perawatan',[ PerawatanController::class,'index']);
Route::get('/perawatan/search',[ PerawatanController::class,'search']);
Route::get('/perawatan/pilihBarang',[ PerawatanController::class,'pilihbarangPerawatan']);
Route::get('/perawatan/pilihBarang/search',[ PerawatanController::class,'searchpilihbarangPerawatan']);
Route::get('/perawatan/tambah/{id}',[PerawatanController::class,'perawatan']);
Route::post('/perawatan/simpanperawatan',[PerawatanController::class,'simpanperawatan']);
Route::get('/perawatan/detail/{id}',[PerawatanController::class,'detail']);
Route::get('/perawatan/edit/{id}',[PerawatanController::class,'edit']);
Route::post('/perawatan/edit/editsimpan',[ PerawatanController::class,'editsimpan']);
Route::get('/perawatan/hapus/{id}',[PerawatanController::class,'hapus']);


Route::get('/ruangan',[ RuanganController::class,'index']);
Route::get('/ruangan/search',[ RuanganController::class,'search']);
// Route::get('/ruangan/tambah',[ RuanganController::class,'formTambah']);
Route::post('/ruangan/tambah',[ RuanganController::class,'store']);
// Route::get('/ruangan/edit/{id}',[RuanganController::class,'edit']);
Route::post('/ruangan/update/{id}',[ RuanganController::class,'update']);
Route::get('/ruangan/hapus/{id}',[RuanganController::class,'hapus']);


Route::get('/log',[ LoggingController::class,'index']);
