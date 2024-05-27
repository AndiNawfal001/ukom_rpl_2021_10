<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\PengajuanBBModel;
use App\Models\PenggunaModel;
use App\Models\PerbaikanModel;
use App\Models\DetailBarangModel;
use App\Models\PemutihanModel;

class ApprovalController extends Controller
{

    private function getIDApprover()
    {
        $approver = Auth::user()->username;
        return PenggunaModel::where('username', $approver)->first()->id_pengguna;
    }

    //
    // BARANG BARU
    //

    public function indexBarangBaru(Request $request)
    {
        if ($request->has('search') || $request->has('filter_month') || $request->has('filter_year') || $request->has('filter_status')) { 
            $where = " 1=1";
            if ($request->has('search')) {
                $search = $request->input('search');
                $where .= " AND (nama_barang LIKE '%$search%' OR total_harga LIKE '%$search%' OR status_approval LIKE '%$search%')";
            }

            if ($request->has('filter_month')) {
                $filter_month = $request->input('filter_month'); 
                $where .= " AND MONTH(tgl) = '$filter_month'";
            }
            
            if ($request->has('filter_year')) {
                $filter_year = $request->input('filter_year'); 
                $where .= " AND YEAR(tgl) = '$filter_year'";
            }
            
            if ($request->has('filter_status')) {
                $filter_status = $request->input('filter_status'); 
                $where .= " AND status_approval = '$filter_status'";
            }
        
            $data = DB::table('pengajuan_bb')
                ->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan') 
                ->whereRaw($where) 
                ->paginate(10);
  
        } else {
            $data = PengajuanBBModel::leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')->paginate(10); 
        }

        return view('approval.barang_baru.index', compact('data'));
    }

    public function statusSetujuBarangBaru($id = null)
    {
        try {
            $approver = $this->getIDApprover();
            $status = [
                'approver' => $approver,
                'status_approval' => ('setuju'),
                'tgl_approve' => NOW()
            ];
            $hapus = PengajuanBBModel::where('id_pengajuan_bb', $id)->update($status);
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
            $approver = $this->getIDApprover();
            $status = [
                'approver' => $approver,
                'status_approval' => ('tidak'),
                'tgl_approve' => NOW()
            ];
            $hapus = PengajuanBBModel::where('id_pengajuan_bb', $id)->update($status);
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
            $data = PerbaikanModel::select('perbaikan.*', 'barang.nama_barang', 'ruangan.nama_ruangan')
                ->leftJoin('detail_barang', 'perbaikan.kode_barang', '=', 'detail_barang.kode_barang')
                ->leftJoin('barang', 'detail_barang.id_barang', '=', 'barang.id_barang')
                ->leftJoin('ruangan', 'detail_barang.ruangan', '=', 'ruangan.id_ruangan')
                ->whereNotNull('tgl_selesai_perbaikan')
                ->where('perbaikan.kode_barang', 'like', "%" . $search . "%")
                ->orWhere('barang.nama_barang', 'like', "%" . $search . "%")
                ->paginate(10);
        } else {
            // TIDAK DIJADIKAN VIEW KARENA DATA JOIN UNTUK DETAIL
            $data = PerbaikanModel::select('perbaikan.*', 'barang.nama_barang', 'ruangan.nama_ruangan')
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
            $approver = $this->getIDApprover();
            $status = [
                'approver' => $approver,
                'approve_perbaikan' => ('sudah diperbaiki'),
                'tgl_approve' => NOW()
            ];
            $hapus = PerbaikanModel::where('id_perbaikan', $id)->update($status);
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
            $approver = $this->getIDApprover();
            $status = [
                'approver' => $approver,
                'approve_perbaikan' => ('rusak'),
                'tgl_approve' => NOW()
            ];

            $kondisi = [
                'kondisi_barang' => ('rusak'),
            ];

            $perbaikan = PerbaikanModel::where('id_perbaikan', $id)->update($status);

            $detail_barang = DetailBarangModel::where('kode_barang', $kode)->update($kondisi);

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
            $data = PemutihanModel::join('nama_kode_barang', 'pemutihan.kode_barang', '=', 'nama_kode_barang.kode_barang')
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
            $data = PemutihanModel::join('nama_kode_barang', 'pemutihan.kode_barang', '=', 'nama_kode_barang.kode_barang')
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
            $approver = $this->getIDApprover();
            $status = [
                'approver' => $approver,
                'approve_penonaktifan' => ('setuju'),
                'tgl_approve' => NOW()
            ];

            $kondisi = [
                'status' => ('nonaktif')
            ];

            $pemutihan = PemutihanModel::where('id_pemutihan', $id)->update($status);
            DetailBarangModel::where('kode_barang', $kode)->update($kondisi);

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
            $approver = $this->getIDApprover();
            $status = [
                'approver' => $approver,
                'approve_penonaktifan' => ('tidak setuju'),
                'tgl_approve' => NOW()
            ];

            $pemutihan = PemutihanModel::where('id_pemutihan', $id)->update($status);

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
