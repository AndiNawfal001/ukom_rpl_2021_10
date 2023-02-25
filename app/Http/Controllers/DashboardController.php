<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\BarangModel;
use App\Models\LogModel;
use App\Models\PengajuanBBModel;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $ceklogin = Auth::user();
        if ($ceklogin == null) {
            return redirect('login');
        }
        $submitter = Auth::user()->id_pengguna;
        $barang_masuk = collect(DB::select("SELECT * FROM total_barang_masuk"))
            ->firstOrFail()
            ->ttl_barang_masuk;
        $supplier = collect(DB::select("SELECT * FROM jumlah_supplier"))
            ->firstOrFail()
            ->jml_supplier;
        $ruangan = collect(DB::select("SELECT * FROM jumlah_ruangan"))
            ->firstOrFail()
            ->jml_ruangan;
        $pengajuan_bb = collect(DB::select("SELECT * FROM jumlah_pengajuan_bb_s"))
            ->firstOrFail()
            ->jml_pengajuan_bb_s;
        $pemutihan = collect(DB::select("SELECT * FROM jumlah_pemutihan_s"))
            ->firstOrFail()
            ->jml_pemutihan_s;
        $latest_detail_barang = BarangModel::select('detail_barang.kode_barang', 'jenis_barang.nama_jenis')
            ->join('detail_barang', 'barang.id_barang', '=', 'detail_barang.id_barang')
            ->leftJoin('jenis_barang', 'barang.id_jenis_brg', '=', 'jenis_barang.id_jenis_brg')
            ->orderByDesc('detail_barang.kode_barang')
            ->paginate(5);
        $latest_logging = LogModel::orderByDesc('id_log')->paginate(5);
        $bb_outstanding = PengajuanBBModel::whereNotNull('approver')
            ->where('status_approval', 'setuju')
            ->where('status_pembelian', NULL)
            ->paginate(5);
        $kode_rusak = DB::table('perbaikan_pemutihan')
            ->whereNull('kode_barang')
            ->where('submitter', $submitter)
            ->paginate(10);

        return view('partials.dashboard', compact(
            'barang_masuk',
            'supplier',
            'pengajuan_bb',
            'pemutihan',
            'ruangan',
            'latest_detail_barang',
            'latest_logging',
            'bb_outstanding',
            'kode_rusak'
        ));
    }
}
