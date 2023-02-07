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
                ->join('nama_kode_barang', 'pemutihan.kode_barang', '=', 'nama_kode_barang.kode_barang')
                ->leftJoin('perbaikan', 'pemutihan.id_perbaikan', '=', 'perbaikan.id_perbaikan')
                ->select('pemutihan.*', 'nama_kode_barang.nama_barang',
                    'tgl_perbaikan', 'penyebab_keluhan', 'tgl_selesai_perbaikan',
                    'nama_teknisi', 'status_perbaikan'
                )
                ->where('pemutihan.submitter', $submitter)
                ->paginate(10);
        return view('pengajuan.pemutihan.index', compact('data'));
    }

    // LANGSUNG

    public function pilihbarangPemutihanLangsung(){

        $data = DB::table('detail_barang')
        ->leftJoin('barang', 'detail_barang.id_barang', '=', 'barang.id_barang')
        ->where('detail_barang.kondisi_barang', 'baik')
        ->where('status', 'aktif')
        ->paginate(10);
        return view('pengajuan.pemutihan.pemutihanLangsung.pilihbarang', compact('data'));
    }

    public function searchPLangsung(Request $request){
        $search = $request->input('search');
        $data = DB::table('detail_barang')
        ->leftJoin('barang', 'detail_barang.id_barang', '=', 'barang.id_barang')
        ->where('detail_barang.kode_barang','like',"%".$search."%")
        ->orWhere('barang.nama_barang','like',"%".$search."%")
        ->where('kondisi_barang', 'baik')
        ->where('status', 'aktif')
        ->paginate(10);
        // dd($data);
        return view('pengajuan.pemutihan.pemutihanLangsung.pilihbarang', compact('data'));
    }

    public function simpanpemutihanLangsung(Request $request)
    {
        try {
            $image = $request->file('image')->store('pemutihan');

            $submitter_id = Auth::user()->id_pengguna;

            $x = DB::table('pemutihan')->insert([
                'id_perbaikan' => $request->input('id_perbaikan'),
                'kode_barang' => $request->input('kode_barang'),
                'submitter' => $submitter_id,
                'tgl_pemutihan' => NOW(),
                'ket_pemutihan' => $request->input('ket_pemutihan'),
                'foto_kondisi_terakhir' => $image
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

    public function pilihbarang()
    {
        $submitter = Auth::user()->id_pengguna;

        $data = DB::table('perbaikan_pemutihan')
        ->join('nama_kode_barang', 'perbaikan_pemutihan.asli', '=', 'nama_kode_barang.kode_barang')
        ->select('perbaikan_pemutihan.*','nama_kode_barang.nama_barang')
        ->whereNull('perbaikan_pemutihan.kode_barang')
        ->where('perbaikan_pemutihan.submitter', $submitter)
        ->where('perbaikan_pemutihan.approve_perbaikan', 'rusak')
        ->paginate(10);
        // dd($data);
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

    public function simpanpemutihan(Request $request)
    {
        try {
            $image = $request->file('image')->store('pemutihan');

            $submitter_id = Auth::user()->id_pengguna;

            $tambah_pengajuan_pb = DB::table('pemutihan')->insert([
                'id_perbaikan' => $request->input('id_perbaikan'),
                'kode_barang' => $request->input('kode_barang'),
                'submitter' => $submitter_id,
                'tgl_pemutihan' => NOW(),
                'ket_pemutihan' => $request->input('ket_pemutihan'),
                'foto_kondisi_terakhir' => $image
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
