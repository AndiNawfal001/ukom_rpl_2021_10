<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemutihanController extends Controller
{
    public function index(){
        $submitter = Auth::user()->id_pengguna;

        $data = DB::table('pemutihan')
                ->where('submitter', $submitter)
                ->paginate(10);
        return view('pengajuan.pemutihan.index', compact('data'));
    }

    private function getPemutihan($id)
    {
        return collect(DB::select('SELECT * FROM pemutihan WHERE id_pemutihan = ?', [$id]))->firstOrFail();
    }
    public function detail($id = null)
    {
        $detail = $this->getPemutihan($id);
        return view('pengajuan.pemutihan.detail', compact('detail'));
    }



    // LANGSUNG

    public function pilihbarangPemutihanLangsung(){
        // $data = DB::table('barang_masuk_perbaikan')
        // ->select('nama_barang', 'asli', 'spesifikasi', 'kondisi_barang', 'status')
        // ->whereNull('kode_barang')
        // ->where('submitter', $submitter)
        // ->where('approve_perbaikan', 'rusak')
        // ->paginate(10);

        $data = DB::table('barang_masuk_perbaikan')
        ->select('*')
        ->where('kondisi_barang', 'baik')
        ->where('status', 'aktif')
        ->paginate(10);
        return view('pengajuan.pemutihan.pemutihanLangsung.pilihbarang', compact('data'));
    }

    public function searchPLangsung(Request $request){
        $search = $request->input('search');
        $data = DB::table('barang_masuk_perbaikan')
        ->select('*')
        ->where('kondisi_barang', 'baik')
        ->where('status', 'aktif')
        ->where('kode_barang','like',"%".$search."%")
        ->orWhere('nama_barang','like',"%".$search."%")
        ->paginate(10);
        return view('pengajuan.pemutihan.pemutihanLangsung.pilihbarang', compact('data'));
    }

    private function inputDataPemutihanLangsung($id)
    {
        return collect(DB::select('SELECT * FROM detail_barang WHERE kode_barang = ?', [$id]))->firstOrFail();
    }

    public function pemutihanLangsung($id = null)
    {
        $pemutihanLangsung = $this->inputDataPemutihanLangsung($id);
        return view('pengajuan.pemutihan.pemutihanLangsung.tambah', compact('pemutihanLangsung'));
    }

    public function simpanpemutihanLangsung(Request $request)
    {
        try {
            $submitter_id = Auth::user()->id_pengguna;

            $x = DB::table('pemutihan')->insert([
                'id_perbaikan' => $request->input('id_perbaikan'),
                'kode_barang' => $request->input('kode_barang'),
                'submitter' => $submitter_id,
                'tgl_pemutihan' => NOW(),
                'ket_pemutihan' => $request->input('ket_pemutihan')

            ]);

            if ($x)
                return redirect('pemutihan');
            else
                return "input data gagal";
            } catch (\Exception $e) {
            return  $e->getMessage();
            }
    }



    // DARI PERBAIKAN

    private function inputDataPemutihan($id)
    {
        return collect(DB::select('SELECT * FROM perbaikan WHERE id_perbaikan = ?', [$id]))->firstOrFail();
    }

    public function pilihbarang()
    {
        $submitter = Auth::user()->id_pengguna;

        $data = DB::table('perbaikan_pemutihan')
        ->select('*')
        ->whereNull('kode_barang')
        ->where('submitter', $submitter)
        ->where('approve_perbaikan', 'rusak')
        ->paginate(10);
        return view('pengajuan.pemutihan.pilihbarang', compact('data', 'submitter'));
    }

    public function search(Request $request)
    {
        $submitter = Auth::user()->id_pengguna;
        $search = $request->input('search');
        $data = DB::table('perbaikan_pemutihan')
        ->select('*')
        ->whereNull('kode_barang')
        ->where('submitter', $submitter)
        ->where('approve_perbaikan', 'rusak')
        ->orWhere('asli','like',"%".$search."%")
        ->paginate(10);
        dd($data);
        return view('pengajuan.pemutihan.pilihbarang', compact('data'));
    }

    public function pemutihan($id = null)
    {
        $submitter = Auth::user()->id_pengguna;

        $pemutihan = $this->inputDataPemutihan($id);
        return view('pengajuan.pemutihan.tambah', compact('pemutihan', 'submitter'));
    }


    public function simpanpemutihan(Request $request)
    {
        try {
            $submitter_id = Auth::user()->id_pengguna;

            $tambah_pengajuan_pb = DB::table('pemutihan')->insert([
                'id_perbaikan' => $request->input('id_perbaikan'),
                'kode_barang' => $request->input('kode_barang'),
                'submitter' => $submitter_id,
                'tgl_pemutihan' => NOW(),
                'ket_pemutihan' => $request->input('ket_pemutihan')

            ]);

            if ($tambah_pengajuan_pb)
                return redirect('pemutihan');
            else
                return "input data gagal";
            } catch (\Exception $e) {
            return  $e->getMessage();
            }
    }

}
