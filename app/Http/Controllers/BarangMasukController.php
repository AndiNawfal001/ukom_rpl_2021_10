<?php

/*
BarangMasukController

Controller ini dibuat untuk modul barang masuk

Atribut yang digunakan  :
    PengajuanBBModel = untuk menampung table pengajuan_bb
    JenisBarangModel = untuk menampung table jenis_barang
    SupplierModel = untuk menampung table supplier
    BarangMasukModel = untuk menampung table barang_masuk

Method yang digunakan   :
    index()                     = untuk menampilkan data dan menerima request search
    getJenisBarang()            = untuk mengambil data table jenis_barang
    getSupplier()               = untuk mengambil data table supplier
    getPengajuanBb()            = untuk mengambil data table pengajuan_bb
    formTambah()                = untuk mengirim data ke form serta menampilkan form
    store()                     = untuk mengirim data ke database
    getBarangMasuk()            = untuk mengambil data table barang_masuk leftjoin dengan table supplier
    getPengajuanBbProgress()    = untuk mengambil data table pengajuan_bb leftjoin dengan table ruangan
    detailBarangMasuk()         = untuk menampilkan data ke halaman history barang masuk

Author  : Andi Nawfal Dzikra (usk_rpl_2021_02)
email   : nawfaldzikra1611@gmail.com
tujuan  : Untuk mengelola barang masuk dan history barang yang sudah masuk
Date    : 17/05/2023
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Models\PengajuanBBModel;
use App\Models\JenisBarangModel;
use App\Models\SupplierModel;
use App\Models\BarangMasukModel;

class BarangMasukController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('searchApproved')) {

            $search = $request->input('searchApproved');
            $data = DB::table('data_barang_masuk')->get();
            $approved = PengajuanBBModel::where('nama_barang', 'like', "%" . $search . "%")
                ->where('status_approval', 'setuju')
                ->paginate(10);
        } elseif ($request->has('searchData')) {

            $search = $request->input('searchData');
            $data = DB::table('data_barang_masuk')
                ->where('nama_barang', 'like', "%" . $search . "%")
                ->orWhere('progress', 'like', "%" . $search . "%")
                ->orWhere('target', 'like', "%" . $search . "%")
                ->get();
            $approved = PengajuanBBModel::where('status_approval', 'setuju')->paginate(10);
        } else {

            $data = DB::table('data_barang_masuk')->get();
            $approved = PengajuanBBModel::where('status_approval', 'setuju')->paginate(10);
        }

        $info = PengajuanBBModel::leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')->get();
        $jenisBarang = DB::table('jenis_barang_jml')->get();
        return view('barangMasuk.index', compact('data', 'info', 'approved', 'jenisBarang'));
    }

    private function getJenisBarang(): Collection
    {
        return collect(JenisBarangModel::get());
    }

    private function getSupplier(): Collection
    {
        return collect(SupplierModel::get());
    }

    private function getPengajuanBb($id)
    {
        return collect(DB::select('SELECT * FROM pengajuan_bb WHERE id_pengajuan_bb = ? AND status_approval = "setuju" ', [$id]))->firstOrFail();
    }

    public function formTambah($id = null)
    {
        $adder = Auth::user()->username;
        $tambah = $this->getPengajuanBb($id);
        $jenisBarang = $this->getJenisBarang();
        $supplier = $this->getSupplier();

        // SISA PENGAJUAN
        $jml_masuk = collect(DB::select('SELECT SUM(jml_masuk) AS jml FROM barang_masuk WHERE id_pengajuan = ' . $tambah->id_pengajuan_bb))->firstOrFail()->jml;

        $jml_pengajuan = $tambah->jumlah;
        $max_input = $jml_pengajuan - $jml_masuk;
        return view('barangMasuk.formtambah', compact('jenisBarang', 'supplier', 'tambah', 'adder', 'max_input'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'image' => 'mimes:jpeg,jpg,png',
                'jml_barang' => 'required',
            ],
            [
                'image.mimes' => 'File harus bertipe: jpeg, jpg, png!',
                'jml_barang.required' => 'Input supplier harus diisi!',
            ]
        );
        try {
            $image = 'barang/'.basename($request->file('image')->store('public/barang'));
            $tambahBarangMasuk = DB::insert("CALL tambah_barangmasuk( :nama_barang, :jml_barang, :spesifikasi, :kondisi_barang, :supplier, :adder, :jenis_barang, :foto_barang, :ruangan)", [

                'nama_barang' => $request->input('nama_barang'),
                'jml_barang' => $request->input('jml_barang'),
                'spesifikasi' => $request->input('spesifikasi'),
                'kondisi_barang' => ('baik'),
                'supplier' => $request->input('supplier'),
                'adder' => $request->input('adder'),
                'jenis_barang' => $request->input('jenis_barang'),
                'foto_barang' => $image,
                'ruangan' => $request->input('ruangan'),
                // dd($request->all())
            ]);
            // dd($tambahBarangMasuk);

            if ($tambahBarangMasuk) {
                flash()->addSuccess('Barang Berhasil Masuk.');
                return redirect('barangMasuk');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    private function getBarangMasuk($id)
    {
        return collect(BarangMasukModel::leftJoin('supplier', 'barang_masuk.supplier', '=', 'supplier.id_supplier')
            ->where('barang_masuk.id_pengajuan', $id)
            ->get());
    }

    private function getPengajuanBbProgress($id)
    {
        return collect(PengajuanBBModel::leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
            ->where('pengajuan_bb.id_pengajuan_bb', $id)
            ->get());
    }

    public function detailBarangMasuk($id = null)
    {
        $data = $this->getBarangMasuk($id);
        $card = $this->getPengajuanBbProgress($id);
        // dd($card);
        return view('barangMasuk.historybarangMasuk', compact('data', 'card'));
    }
}
