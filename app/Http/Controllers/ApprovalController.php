<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    //
    // BARANG BARU
    //

    public function indexBarangBaru(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DB::table('pengajuan_bb')->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
                ->where('nama_barang', 'like', "%" . $search . "%")
                ->orWhere('total_harga', 'like', "%" . $search . "%")
                ->orWhere('tgl', 'like', "%" . $search . "%")
                ->orWhere('status_approval', 'like', "%" . $search . "%")
                ->paginate(10);
        } else {
            $data = DB::table('pengajuan_bb')
                ->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
                ->paginate(10);
        }


        return view('approval.barang_baru.index', compact('data'));
    }

    public function statusSetujuBarangBaru($id = null)
    {
        try {
            $id_pengguna = DB::table('pengguna')
                ->select('id_pengguna')
                ->where('username', Auth::user()->username)
                ->get();
            $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');
            // dd($id);

            $status = [
                'approver' => $approver,
                'status_approval' => ('setuju'),
                'tgl_approve' => NOW()
            ];
            $hapus = DB::table('pengajuan_bb')
                ->where('id_pengajuan_bb', $id)
                ->update($status);
            if ($hapus) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('approval/BB');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
    public function statusTidakSetujuBarangBaru($id = null)
    {
        try {
            $id_pengguna = DB::table('pengguna')
                ->select('id_pengguna')
                ->where('username', Auth::user()->username)
                ->get();
            $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');

            $status = [
                'approver' => $approver,
                'status_approval' => ('tidak'),
                'tgl_approve' => NOW()
            ];
            $hapus = DB::table('pengajuan_bb')
                ->where('id_pengajuan_bb', $id)
                ->update($status);
            if ($hapus) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('approval/BB');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }


    //
    // PERBAIKAN
    //


    public function indexPerbaikan(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DB::table('perbaikan')
                ->select('perbaikan.*', 'barang.nama_barang', 'ruangan.nama_ruangan')
                ->leftJoin('detail_barang', 'perbaikan.kode_barang', '=', 'detail_barang.kode_barang')
                ->leftJoin('barang', 'detail_barang.id_barang', '=', 'barang.id_barang')
                ->leftJoin('ruangan', 'detail_barang.ruangan', '=', 'ruangan.id_ruangan')
                ->whereNotNull('tgl_selesai_perbaikan')
                ->where('perbaikan.kode_barang', 'like', "%" . $search . "%")
                ->orWhere('barang.nama_barang', 'like', "%" . $search . "%")
                ->paginate(10);
        } else {
            // TIDAK DIJADIKAN VIEW KARENA DATA JOIN UNTUK DETAIL
            $data = DB::table('perbaikan')
                ->select('perbaikan.*', 'barang.nama_barang', 'ruangan.nama_ruangan')
                ->leftJoin('detail_barang', 'perbaikan.kode_barang', '=', 'detail_barang.kode_barang')
                ->leftJoin('barang', 'detail_barang.id_barang', '=', 'barang.id_barang')
                ->leftJoin('ruangan', 'detail_barang.ruangan', '=', 'ruangan.id_ruangan')
                ->whereNotNull('tgl_selesai_perbaikan')
                ->paginate(10);
        }


        return view('approval.perbaikan.index', compact('data'));
    }

    public function statusSetujuPerbaikan($id = null)
    {
        try {
            $id_pengguna = DB::table('pengguna')
                ->select('id_pengguna')
                ->where('username', Auth::user()->username)
                ->get();
            $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');

            $status = [
                'approver' => $approver,
                'approve_perbaikan' => ('sudah diperbaiki'),
                'tgl_approve' => NOW()
            ];
            $hapus = DB::table('perbaikan')
                ->where('id_perbaikan', $id)
                ->update($status);
            // dd('berhasil');
            if ($hapus) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('approval/PB');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function statusTidakSetujuPerbaikan($id = null, $kode = null)
    {
        try {
            $id_pengguna = DB::table('pengguna')
                ->select('id_pengguna')
                ->where('username', Auth::user()->username)
                ->get();
            $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');

            $approve = [
                'approver' => $approver,
                'approve_perbaikan' => ('rusak'),
                'tgl_approve' => NOW()
            ];

            $kondisi = [
                'kondisi_barang' => ('rusak'),
            ];

            $perbaikan = DB::table('perbaikan')
                ->where('id_perbaikan', $id)
                ->update($approve);

            $detail_barang = DB::table('detail_barang')
                ->where('kode_barang', $kode)
                ->update($kondisi);

            if ($perbaikan and $detail_barang) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('approval/PB');
                // dd("berhasil");

            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    //
    // PEMUTIHAN
    //

    public function indexPemutihan(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DB::table('pemutihan')
                ->join('nama_kode_barang', 'pemutihan.kode_barang', '=', 'nama_kode_barang.kode_barang')
                ->leftJoin('perbaikan', 'pemutihan.id_perbaikan', '=', 'perbaikan.id_perbaikan')
                ->select(
                    'pemutihan.*',
                    'nama_kode_barang.nama_barang',
                    'tgl_perbaikan',
                    'penyebab_keluhan',
                    'tgl_selesai_perbaikan',
                    'nama_teknisi',
                    'status_perbaikan'
                )
                ->where('pemutihan.kode_barang', 'like', "%" . $search . "%")
                ->orWhere('nama_kode_barang.nama_barang', 'like', "%" . $search . "%")
                ->paginate(10);
        } else {
            // TIDAK DIJADIKAN VIEW KARENA DATA JOIN UNTUK DETAIL
            $data = DB::table('pemutihan')
                ->join('nama_kode_barang', 'pemutihan.kode_barang', '=', 'nama_kode_barang.kode_barang')
                ->leftJoin('perbaikan', 'pemutihan.id_perbaikan', '=', 'perbaikan.id_perbaikan')
                ->select(
                    'pemutihan.*',
                    'nama_kode_barang.nama_barang',
                    'tgl_perbaikan',
                    'penyebab_keluhan',
                    'tgl_selesai_perbaikan',
                    'nama_teknisi',
                    'status_perbaikan'
                )
                ->paginate(10);
        }


        return view('approval.pemutihan.index', compact('data'));
    }

    public function statusSetujuPemutihan($id = null, $kode = null)
    {
        try {
            $id_pengguna = DB::table('pengguna')
                ->select('id_pengguna')
                ->where('username', Auth::user()->username)
                ->get();
            $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');

            $approve = [
                'approver' => $approver,
                'approve_penonaktifan' => ('setuju'),
                'tgl_approve' => NOW()
            ];

            $status = [
                'status' => ('nonaktif')
            ];
            // dd('hehe');

            $pemutihan = DB::table('pemutihan')
                ->where('id_pemutihan', $id)
                ->update($approve);
            DB::table('detail_barang')
                ->where('kode_barang', $kode)
                ->update($status);

            if ($pemutihan) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('approval/pemutihan');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }

    public function statusTidakSetujuPemutihan($id = null)
    {
        try {
            $id_pengguna = DB::table('pengguna')
                ->select('id_pengguna')
                ->where('username', Auth::user()->username)
                ->get();
            $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');

            $approve = [
                'approver' => $approver,
                'approve_penonaktifan' => ('tidak setuju'),
                'tgl_approve' => NOW()
            ];

            $pemutihan = DB::table('pemutihan')
                ->where('id_pemutihan', $id)
                ->update($approve);

            if ($pemutihan) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('approval/pemutihan');
                // dd("berhasil");

            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
