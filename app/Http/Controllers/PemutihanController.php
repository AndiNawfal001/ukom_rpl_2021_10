<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PemutihanController extends Controller
{
    public function index(){
        $submitter = Auth::user()->id_pengguna;

        $data = DB::select('SELECT * FROM pemutihan WHERE submitter ='.$submitter);
        return view('pengajuan.pemutihan.index', compact('data'));
    }

    public function pilihbarangPemutihanLangsung(){
        $data = DB::table('barang_masuk_perbaikan')
        ->select('*')
        ->where('kondisi_barang', 'baik')
        ->where('status', 'aktif')
        ->paginate(10);
        return view('pengajuan.pemutihan.pemutihanLangsung.pilihbarang', compact('data'));
    }

    public function pilihbarang()
    {
        $data = DB::select('SELECT * FROM perbaikan_pemutihan WHERE kode_barang IS NULL AND approve_perbaikan = "rusak" ');
        return view('pengajuan.pemutihan.pilihbarang', compact('data'));
    }

    private function inputDataPemutihan($id)
    {
        return collect(DB::select('SELECT * FROM perbaikan WHERE id_perbaikan = ?', [$id]))->firstOrFail();
    }

    private function inputDataPemutihanLangsung($id)
    {
        return collect(DB::select('SELECT * FROM detail_barang WHERE kode_barang = ?', [$id]))->firstOrFail();
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






    public function pemutihan($id = null)
    {
        $pemutihan = $this->inputDataPemutihan($id);
        return view('pengajuan.pemutihan.tambah', compact('pemutihan'));
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
