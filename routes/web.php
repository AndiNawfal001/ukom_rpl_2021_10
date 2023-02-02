<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBarangController;
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

Route::get('/barang',[ BarangController::class,'index'])->middleware('auth');
Route::get('/barang/search',[ BarangController::class,'search'])->middleware('auth');
Route::get('/barang/detail/{id}',[ BarangController::class,'detail'])->middleware('auth');
Route::get('/barang/detail/spesifik/{id}',[ BarangController::class,'spesifik'])->middleware('auth');
Route::get('/barang/detail/search/{id}',[ BarangController::class,'searchdetail'])->middleware('auth');
Route::post('/barang/detail/update/{id}',[ BarangController::class,'update'])->middleware('auth');


Route::get('/levelUser/tambah',[LevelUserController::class,'formTambah'])->middleware('auth');
Route::post('/levelUser/simpan',[LevelUserController::class,'simpan'])->middleware('auth');

Route::get('login',[LoginController::class,'login'])->name('login');
Route::post('/login',[LoginController::class,'authenticate']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::group(['middleware' => ['auth','level:admin']], function (){
    Route::get('/log',[ LoggingController::class,'index'])->middleware('auth');
    Route::get('/log/search',[ LoggingController::class,'search'])->middleware('auth');
});

//Route Group untuk menggabungkan banyaknya middleware
Route::group(['middleware' => ['auth','level:admin,manajemen']], function (){
    // Route::get('/levelUser',[LevelUserController::class,'index'])->middleware('auth');
    Route::get('/approval/BB',[ ApprovalController::class,'indexBarangBaru'])->middleware('auth');
    Route::get('/approval/BB/search',[ ApprovalController::class,'searchindexBarangBaru'])->middleware('auth');
    Route::get('/approval/BB/detail/{id}',[ApprovalController::class,'detailBarangBaru'])->middleware('auth');
    Route::get('/approval/BB/setuju/{id}',[ApprovalController::class,'statusSetujuBarangBaru'])->middleware('auth');
    Route::get('/approval/BB/tidaksetuju/{id}',[ApprovalController::class,'statusTidakSetujuBarangBaru'])->middleware('auth');

    Route::get('/approval/PB',[ ApprovalController::class,'indexPerbaikan'])->middleware('auth');
    Route::get('/approval/PB/search',[ ApprovalController::class,'searchindexPerbaikan'])->middleware('auth');
    Route::get('/approval/PB/detail/{id}',[ApprovalController::class,'detailPerbaikan'])->middleware('auth');
    Route::get('/approval/PB/setuju/{id}',[ApprovalController::class,'statusSetujuPerbaikan'])->middleware('auth');
    Route::get('/approval/PB/tidaksetuju/{id}/{kode}',[ApprovalController::class,'statusTidakSetujuPerbaikan'])->middleware('auth');

    Route::get('/approval/pemutihan',[ ApprovalController::class,'indexPemutihan'])->middleware('auth');
    Route::get('/approval/pemutihan/search',[ ApprovalController::class,'searchindexPemutihan'])->middleware('auth');
    Route::get('/approval/pemutihan/detail/{id}',[ApprovalController::class,'detailPemutihan'])->middleware('auth');
    Route::get('/approval/pemutihan/setuju/{id}/{kode}',[ApprovalController::class,'statusSetujuPemutihan'])->middleware('auth');
    Route::get('/approval/pemutihan/tidaksetuju/{id}',[ApprovalController::class,'statusTidakSetujuPemutihan'])->middleware('auth');
});

Route::get('/User',[ UserController::class,'index'])->middleware('auth');
Route::get('/User/tambah',[ UserController::class,'formTambah'])->middleware('auth');
Route::post('/User/simpan',[ UserController::class,'simpan'])->middleware('auth');
Route::get('/User/edit/{id}',[UserController::class,'edit'])->middleware('auth');
Route::post('/User/edit/editsimpan',[ UserController::class,'editsimpan'])->middleware('auth');
Route::get('/User/hapus/{id}',[UserController::class,'hapus'])->middleware('auth');

Route::get('/User/kaprog', [KaprogController::class, 'index'])->middleware('auth');

// Route::group(['middleware' => ['auth','level:manajemen']], function (){

// });
Route::get('/barangMasuk',[ BarangMasukController::class,'index'])->middleware('auth');
Route::get('/barangMasuk/searchPengajuan',[ BarangMasukController::class,'searchPengajuan'])->middleware('auth');
Route::get('/barangMasuk/searchBarangMasuk',[ BarangMasukController::class,'searchBarangMasuk'])->middleware('auth');
Route::get('/barangMasuk/tambah/{id}',[ BarangMasukController::class,'formTambah'])->middleware('auth');
Route::post('/barangMasuk/tambah/simpan',[ BarangMasukController::class,'store'])->middleware('auth');

Route::get('/supplier',[ SupplierController::class,'index'])->middleware('auth');
Route::get('/supplier/search',[ SupplierController::class,'search'])->middleware('auth');
Route::get('/supplier/tambah',[ SupplierController::class,'formTambah'])->middleware('auth');
Route::post('/supplier/simpan',[ SupplierController::class,'store'])->middleware('auth');
Route::get('/supplier/edit/{id}',[SupplierController::class,'edit'])->middleware('auth');
Route::post('/supplier/editsimpan',[ SupplierController::class,'update'])->middleware('auth');
Route::get('/supplier/hapus/{id}',[SupplierController::class,'hapus'])->middleware('auth');

Route::get('/pengguna',[ PenggunaController::class,'index'])->middleware('auth');
Route::get('/pengguna/search',[ PenggunaController::class,'search'])->middleware('auth');
Route::get('/pengguna/tambah',[ PenggunaController::class,'formTambah'])->middleware('auth');
Route::post('/pengguna/simpan',[ PenggunaController::class,'store'])->middleware('auth');
Route::get('/pengguna/edit/{id}',[PenggunaController::class,'edit'])->middleware('auth');
Route::post('/pengguna/edit/editsimpan',[ PenggunaController::class,'editsimpan'])->middleware('auth');
Route::get('/pengguna/hapus/{id}',[PenggunaController::class,'hapus'])->middleware('auth');



Route::get('/pengajuan/BB',[ PengajuanBBController::class,'index'])->middleware('auth');
Route::get('/pengajuan/BB/search',[ PengajuanBBController::class,'search'])->middleware('auth');
// Route::get('/pengajuan/BB/tambah',[ PengajuanBBController::class,'formTambah'])->middleware('auth');
Route::post('/pengajuan/BB/tambah',[ PengajuanBBController::class,'store'])->middleware('auth');
// Route::get('/pengajuan/BB/edit/{id}',[PengajuanBBController::class,'edit'])->middleware('auth');
Route::post('/pengajuan/BB/update/{id}',[ PengajuanBBController::class,'update'])->middleware('auth');
Route::get('/pengajuan/BB/hapus/{id}',[PengajuanBBController::class,'hapus'])->middleware('auth');
Route::get('/pengajuan/BB/detail/{id}',[PengajuanBBController::class,'detail'])->middleware('auth');

Route::get('/pengajuan/PB',[ PerbaikanController::class,'index'])->middleware('auth');
Route::get('/pengajuan/PB/search',[ PerbaikanController::class,'search'])->middleware('auth');
Route::get('/pengajuan/PB/pilihBarang',[ PerbaikanController::class,'pilihBarang'])->middleware('auth');
Route::get('/pengajuan/PB/pilihBarang/search',[ PerbaikanController::class,'searchpilihbarang'])->middleware('auth');
Route::get('/pengajuan/PB/edit/{id}',[PerbaikanController::class,'edit'])->middleware('auth');
// Route::get('/pengajuan/PB/perbaikan/{id}',[PerbaikanController::class,'perbaikan'])->middleware('auth');
Route::post('/pengajuan/PB/perbaikan/simpanperbaikan',[PerbaikanController::class,'simpanperbaikan'])->middleware('auth');
Route::post('/pengajuan/PB/edit/editsimpan',[ PerbaikanController::class,'editsimpan'])->middleware('auth');
Route::get('/pengajuan/PB/hapus/{id}',[PerbaikanController::class,'hapus'])->middleware('auth');
Route::get('/PB/selesaiPerbaikan/{id}',[PerbaikanController::class,'selesaiPerbaikan'])->middleware('auth');
Route::post('/PB/selesaiPerbaikan/simpanSelesaiPerbaikan',[ PerbaikanController::class,'simpanSelesaiPerbaikan'])->middleware('auth');
Route::get('/pengajuan/PB/detail/{id}',[PerbaikanController::class,'detail'])->middleware('auth');


Route::get('/pemutihan',[ PemutihanController::class,'index'])->middleware('auth');
Route::get('/pemutihan/pilihbarang',[ PemutihanController::class,'pilihbarang'])->middleware('auth');
Route::get('/pemutihan/pilihbarang/search',[ PemutihanController::class,'pilihbarang'])->middleware('auth');
Route::get('/pemutihan/pemutihan/{id}',[PemutihanController::class,'pemutihan'])->middleware('auth');
Route::post('/pemutihan/pemutihan/simpanpemutihan',[PemutihanController::class,'simpanpemutihan'])->middleware('auth');
Route::get('/pemutihan/detail/{id}',[PemutihanController::class,'detail'])->middleware('auth');

Route::get('/pemutihanLangsung/pilihBarang',[ PemutihanController::class,'pilihbarangPemutihanLangsung'])->middleware('auth');
Route::get('/pemutihanLangsung/pilihBarang/searchPLangsung',[ PemutihanController::class,'searchPLangsung'])->middleware('auth');
Route::get('/pemutihan/pemutihanLangung/{id}',[PemutihanController::class,'pemutihanLangsung'])->middleware('auth');
Route::post('/pemutihan/pemutihanLangsung/simpanpemutihanLangsung',[PemutihanController::class,'simpanpemutihanLangsung'])->middleware('auth');

Route::get('/perawatan',[ PerawatanController::class,'index'])->middleware('auth');
Route::get('/perawatan/search',[ PerawatanController::class,'search'])->middleware('auth');
Route::get('/perawatan/pilihBarang',[ PerawatanController::class,'pilihbarangPerawatan'])->middleware('auth');
Route::get('/perawatan/pilihBarang/search',[ PerawatanController::class,'searchpilihbarangPerawatan'])->middleware('auth');
Route::get('/perawatan/tambah/{id}',[PerawatanController::class,'perawatan'])->middleware('auth');
Route::post('/perawatan/simpanperawatan',[PerawatanController::class,'simpanperawatan'])->middleware('auth');
Route::get('/perawatan/detail/{id}',[PerawatanController::class,'detail'])->middleware('auth');
// Route::get('/perawatan/edit/{id}',[PerawatanController::class,'edit'])->middleware('auth');
Route::post('/perawatan/edit/editsimpan',[ PerawatanController::class,'editsimpan'])->middleware('auth');
Route::get('/perawatan/hapus/{id}',[PerawatanController::class,'hapus'])->middleware('auth');


Route::get('/ruangan',[ RuanganController::class,'index'])->middleware('auth');
Route::get('/ruangan/search',[ RuanganController::class,'search'])->middleware('auth');
Route::get('/ruangan/tambah',[ RuanganController::class,'formTambah'])->middleware('auth');
Route::post('/ruangan/simpan',[ RuanganController::class,'store'])->middleware('auth');
Route::get('/ruangan/edit/{id}',[RuanganController::class,'edit'])->middleware('auth');
Route::post('/ruangan/editsimpan',[ RuanganController::class,'update'])->middleware('auth');
Route::get('/ruangan/hapus/{id}',[RuanganController::class,'hapus'])->middleware('auth');


Route::post('/jenisBarang/tambah',[ JenisBarangController::class,'store'])->middleware('auth');
Route::get('/jenisBarang/hapus/{id}',[ JenisBarangController::class,'hapus'])->middleware('auth');


