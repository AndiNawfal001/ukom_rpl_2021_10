<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;



class BarangMasukController extends Controller
{
    public function index(){
        $data = DB::select('SELECT * FROM barang_masuk');
        $approved = DB::select('SELECT * FROM pengajuan_bb WHERE status_approval = "setuju" ');
        return view('barangMasuk.index', compact('data', 'approved'));
     }

    public function getJumlahPengajuan(){
        $data = DB::select('SELECT COUNT(id_pengajuan_bb) AS jumlah FROM pengajuan_bb WHERE status_approval = "setuju"');
        return view('partials.sidebar', compact('data'));
    }

    private function getJenisBarang(): Collection
    {
        return collect(DB::select('SELECT * FROM jenis_barang'));
    }

    private function getSupplier(): Collection
    {
        return collect(DB::select('SELECT * FROM supplier'));
    }

    private function getPengajuanBb($id)
    {
        return collect(DB::select('SELECT * FROM pengajuan_bb WHERE id_pengajuan_bb = ? AND status_approval = "setuju" ', [$id]))->firstOrFail();
    }

    public function formTambah($id = null)
    {
        $manajemen = DB::table('pengguna_manajemen')
        ->select('nama')
        ->where('username',Auth::user()->username)
        ->get();
        $array = Arr::pluck($manajemen, 'nama');
        $kode_baru = Arr::get($array, '0');

        $tambah = $this->getPengajuanBb($id);
        $jenisBarang = $this->getJenisBarang();
        $supplier = $this->getSupplier();

        // SISA PENGAJUAN
        $x= (DB::select('SELECT SUM(jml_masuk) AS jml FROM barang_masuk WHERE id_pengajuan = ' .$tambah->id_pengajuan_bb));
        $array = Arr::pluck($x, 'jml');
        $jml_masuk = Arr::get($array, '0');
        $jml_pengajuan = $tambah->jumlah;
        $max_input = $jml_pengajuan - $jml_masuk;
        // dd($max_input);

        return view('barangMasuk.formtambah', compact('jenisBarang', 'supplier', 'tambah', 'kode_baru', 'max_input'));
    }

    public function store(Request $request)
    {
        try {

        $tambahBarangMasuk = DB::insert("CALL tambah_barangmasuk( :nama_barang, :jml_barang, :spesifikasi, :kondisi_barang, :supplier, :nama_manajemen, :jenis_barang, :foto_barang)", [

            'nama_barang' => $request->input('nama_barang'),
            'jml_barang' => $request->input('jml_barang'),
            'spesifikasi' => $request->input('spesifikasi'),
            'kondisi_barang' => ('baik'),
            'supplier' => $request->input('supplier'),
            'nama_manajemen' => $request->input('nama_manajemen'),
            'jenis_barang' => $request->input('jenis_barang'),
            'foto_barang' => $request->input('foto_barang'),
            // dd($request->all())
        ]);
            // dd($tambahBarangMasuk);

        if ($tambahBarangMasuk)
            return redirect('barangMasuk');
        else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }
}
