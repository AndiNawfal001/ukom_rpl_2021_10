<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\PerbaikanModel;
use App\Models\DetailBarangModel;

class PerbaikanController extends Controller
{
    public function index(Request $request)
    {
        $submitter = Auth::user()->id_pengguna;
        $data = null;
        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DB::table('perbaikan_detailbarang')
                ->where('perbaikan_detailbarang.kode_barang', 'like', "%" . $search . "%")
                ->where('perbaikan_detailbarang.submitter', $submitter)
                ->paginate(10);
        } else {
            $data = DB::table('perbaikan_detailbarang')
                ->where('perbaikan_detailbarang.submitter', $submitter)
                ->paginate(10);
        }
        // dd($data);
        return view('pengajuan.perbaikan.index', compact('data'));
    }

    public function pilihBarang(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DetailBarangModel::distinct()
                ->select('detail_barang.*', 'barang.nama_barang')
                ->leftJoin('barang', 'detail_barang.id_barang', '=', 'barang.id_barang')
                ->where('detail_barang.kondisi_barang', 'baik')
                ->where('detail_barang.status', 'aktif')
                ->where('detail_barang.kode_barang', 'like', "%" . $search . "%")
                ->orWhere('barang.nama_barang', 'like', "%" . $search . "%")
                ->orderBy('detail_barang.kode_barang', 'asc')
                ->paginate(10);
        } else {
            $data = DetailBarangModel::distinct()
                ->select('detail_barang.*', 'barang.nama_barang')
                ->leftJoin('barang', 'detail_barang.id_barang', '=', 'barang.id_barang')
                ->where('detail_barang.kondisi_barang', 'baik')
                ->where('detail_barang.status', 'aktif')
                ->orderBy('detail_barang.kode_barang', 'asc')
                ->paginate(10);
        }


        // dd($data);
        return view('pengajuan.perbaikan.pilihbarang', compact('data'));
    }

    public function simpanperbaikan(Request $request)
    {
        try {
            $submitter_id = Auth::user()->id_pengguna;

            $id_perbaikan = collect(DB::select('SELECT newIdPerbaikan() AS id_perbaikan'))->firstOrFail()->id_perbaikan;

            $tambah_pengajuan_pb = PerbaikanModel::insert([
                'id_perbaikan' => $id_perbaikan,
                'kode_barang' => $request->input('kode_barang'),
                'submitter' => $submitter_id,
                'tgl_perbaikan' => NOW(),
                'keluhan' => $request->input('keluhan'),

            ]);

            if ($tambah_pengajuan_pb) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('pengajuan/PB');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function simpanSelesaiPerbaikan(Request $request)
    {
        try {
            $data = [
                'nama_teknisi' => $request->input('nama_teknisi'),
                'penyebab_keluhan' => $request->input('penyebab_keluhan'),
                'status_perbaikan' => $request->input('status_perbaikan'),
                'solusi_barang' => $request->input('solusi_barang'),
                'tgl_selesai_perbaikan' => NOW(),
            ];

            $upd = PerbaikanModel::where('id_perbaikan', '=', $request->input('id_perbaikan'))
                ->update($data);
            if ($upd) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('pengajuan/PB');
                // dd("berhasil", $upd);
            }
            // dd("berhasil", $upd);
        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }


    public function hapus($id = null)
    {
        try {
            $hapus = PerbaikanModel::where('id_perbaikan', $id)
                ->delete();
            if ($hapus) {
                flash()->addSuccess('Data berhasil dihapus.');
                return redirect('pengajuan/PB');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
