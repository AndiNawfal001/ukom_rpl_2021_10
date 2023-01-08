<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class DashboardController extends Controller
{
    public function dashboard () {
        $barang_masuk = DB::table('barang_masuk')->sum('jml_masuk');
        // dd($barang_masuk);
        $supplier = DB::table('supplier')->count();
        $ruangan = DB::table('ruangan')->count();
        $pengajuan_bb = DB::table('pengajuan_bb')->where('status_approval', 'setuju')->count();
        $pemutihan = DB::table('pemutihan')->where('approve_penonaktifan', 'setuju')->count();
        $latest_detail_barang = DB::table('detail_barang_jenis_barang')->paginate(5);
        $latest_logging = DB::table('log')->orderByDesc('id_log')->paginate(5);
        $bb_outstanding = DB::table('pengajuan_bb')->where('status_pembelian', NULL)->paginate(5);

        // $id_perbaikan_rusak = DB::select('SELECT kode_barang FROM perbaikan WHERE approve_perbaikan = "rusak"'
        // dd($cek_pemutihan);
        // dd($latest_detail_barang);

        return view('partials.dashboard', compact(
            'barang_masuk',
            'supplier',
            'pengajuan_bb',
            'pemutihan',
            'ruangan',
            'latest_detail_barang',
            'latest_logging',
            'bb_outstanding'
        ));
    }
}
