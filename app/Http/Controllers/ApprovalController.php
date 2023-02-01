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

    public function indexBarangBaru(){

        // data pending manajemen
        $data = DB::table('pengajuan_bb')->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')->paginate(10);

        return view('approval.barang_baru.index', compact('data'));
    }

    public function searchindexBarangBaru(Request $request){
        $search = $request->input('search');

        // data pending manajemen
        $data = DB::table('pengajuan_bb')->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
                    ->where('nama_barang','like',"%".$search."%")
                    ->orWhere('total_harga','like',"%".$search."%")
                    ->orWhere('tgl','like',"%".$search."%")
                    ->orWhere('status_approval','like',"%".$search."%")
                    ->paginate(10);

        return view('approval.barang_baru.index', compact('data'));
    }

    private function getPengajuanBb($id)
    {
        return collect(DB::select('SELECT * FROM pengajuan_bb WHERE id_pengajuan_bb = ?', [$id]))->firstOrFail();
    }

    public function detailBarangBaru($id = null)
    {

        $detail = $this->getPengajuanBb($id);
        return view('approval.barang_baru.detail', compact('detail'));
    }

        // APPROVAL
    public function statusSetujuBarangBaru($id=null){
        try{
            $id_pengguna = DB::table('pengguna')
                ->select('id_pengguna')
                ->where('username',Auth::user()->username)
                ->get();
                $array = Arr::pluck($id_pengguna, 'id_pengguna');
                $approver = Arr::get($array, '0');
            // dd($id);

            $status = [
                'approver'=> $approver,
                'status_approval' => ('setuju'),
                'tgl_approve' => NOW()
            ];
            $hapus = DB::table('pengajuan_bb')
                            ->where('id_pengajuan_bb',$id)
                            ->update($status);
            if($hapus){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])
                ->addSuccess('Data berhasil disimpan.');
                return redirect('approval/BB');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
    public function statusTidakSetujuBarangBaru($id=null){
        try{
            $id_pengguna = DB::table('pengguna')
                ->select('id_pengguna')
                ->where('username',Auth::user()->username)
                ->get();
                $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');

            $status = [
                'approver'=>$approver,
                'status_approval' => ('tidak'),
                'tgl_approve' => NOW()
            ];
            $hapus = DB::table('pengajuan_bb')
                            ->where('id_pengajuan_bb',$id)
                            ->update($status);
            if($hapus){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])
                ->addSuccess('Data berhasil disimpan.');
                return redirect('approval/BB');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }


    //
    // PERBAIKAN
    //


    public function indexPerbaikan(){
        $data = DB::table('barang_masuk_perbaikan')
                ->whereNotNull('tgl_selesai_perbaikan')
                ->paginate(10);
        return view('approval.perbaikan.index', compact('data'));
    }

    public function searchindexPerbaikan(Request $request){
        $search = $request->input('search');
        $data = DB::table('perbaikan')
                    ->whereNotNull('tgl_selesai_perbaikan')
                    ->where('kode_barang','like',"%".$search."%")
                    ->paginate(10);
        return view('approval.perbaikan.index', compact('data'));
    }

    private function getPengajuanPb($id)
    {
        return collect(DB::select('SELECT barang_masuk_perbaikan.*, ruangan.nama_ruangan
        FROM barang_masuk_perbaikan
        LEFT JOIN detail_barang
        ON barang_masuk_perbaikan.asli = detail_barang.kode_barang
        LEFT JOIN ruangan
        ON detail_barang.ruangan = ruangan.id_ruangan
        WHERE barang_masuk_perbaikan.id_perbaikan = ?', [$id]))->firstOrFail();
    }
    public function detailPerbaikan($id = null)
    {
        $detail = $this->getPengajuanPb($id);
        return view('approval.perbaikan.detail', compact('detail'));
    }

    public function statusSetujuPerbaikan($id=null){
        try{
            $id_pengguna = DB::table('pengguna')
            ->select('id_pengguna')
            ->where('username',Auth::user()->username)
            ->get();
            $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');

            $status = [
                'approver' => $approver,
                'approve_perbaikan' => ('sudah diperbaiki'),
                'tgl_approve' => NOW()
            ];
            $hapus = DB::table('perbaikan')
                            ->where('id_perbaikan',$id)
                            ->update($status);
            // dd('berhasil');
            if($hapus){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])
                ->addSuccess('Data berhasil disimpan.');
                return redirect('approval/PB');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    public function statusTidakSetujuPerbaikan($id=null, $kode=null){
        try{
            $id_pengguna = DB::table('pengguna')
            ->select('id_pengguna')
            ->where('username',Auth::user()->username)
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
                            ->where('id_perbaikan',$id)
                            ->update($approve);

            $detail_barang = DB::table('detail_barang')
                            ->where('kode_barang',$kode)
                            ->update($kondisi);

            if($perbaikan AND $detail_barang){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])
                ->addSuccess('Data berhasil disimpan.');
                return redirect('approval/PB');
            // dd("berhasil");

            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    //
    // PEMUTIHAN
    //

    public function indexPemutihan(){
        $data = DB::table('pemutihan')
        ->join('nama_kode_barang', 'pemutihan.kode_barang', '=', 'nama_kode_barang.kode_barang')
        ->leftJoin('perbaikan', 'pemutihan.id_perbaikan', '=', 'perbaikan.id_perbaikan')
        ->select('pemutihan.*', 'nama_kode_barang.nama_barang',
            'tgl_perbaikan', 'penyebab_keluhan', 'tgl_selesai_perbaikan',
            'nama_teknisi'
        )
        ->paginate(10);
        return view('approval.pemutihan.index', compact('data'));
    }

    public function searchindexPemutihan(Request $request){
        $search = $request->input('search');
        $data = DB::table('pemutihan')
                ->where('kode_barang','like',"%".$search."%")
                ->paginate(10);
        return view('approval.pemutihan.index', compact('data'));
    }

    private function getPemutihan($id)
    {
        return collect(DB::select('SELECT * FROM pemutihan WHERE id_pemutihan = ?', [$id]))->firstOrFail();
    }

    public function detailPemutihan($id = null)
    {
        $detail = $this->getPemutihan($id);
        return view('approval.pemutihan.detail', compact('detail'));
    }

    public function statusSetujuPemutihan($id=null, $kode=null){
        try{
            $id_pengguna = DB::table('pengguna')
            ->select('id_pengguna')
            ->where('username',Auth::user()->username)
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
                            ->where('id_pemutihan',$id)
                            ->update($approve);
            // dd('hehe');
            $detail_barang = DB::table('detail_barang')
                            ->where('kode_barang',$kode)
                            ->update($status);

            if($pemutihan){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])
                ->addSuccess('Data berhasil disimpan.');
                return redirect('approval/pemutihan');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    public function statusTidakSetujuPemutihan($id=null){
        try{
            $id_pengguna = DB::table('pengguna')
            ->select('id_pengguna')
            ->where('username',Auth::user()->username)
            ->get();
            $array = Arr::pluck($id_pengguna, 'id_pengguna');
            $approver = Arr::get($array, '0');

            $approve = [
                'approver' => $approver,
                'approve_penonaktifan' => ('tidak setuju'),
                'tgl_approve' => NOW()
            ];

            $pemutihan = DB::table('pemutihan')
                            ->where('id_pemutihan',$id)
                            ->update($approve);

            if($pemutihan){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])
                ->addSuccess('Data berhasil disimpan.');
                return redirect('approval/pemutihan');
            // dd("berhasil");

            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
