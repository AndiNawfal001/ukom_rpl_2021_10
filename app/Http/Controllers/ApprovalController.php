<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    //
    public function indexBarangBaru(){

        // data pending manajemen
        $data = DB::select('SELECT * FROM pengajuan_bb');

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
                return redirect('approval/BB');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }






    public function indexPerbaikan(){
        $data = DB::select('SELECT * FROM perbaikan');
        $admin = DB::select('SELECT * FROM perbaikan WHERE tgl_selesai_perbaikan IS NOT NULL');
        return view('approval.perbaikan.index', compact('data', 'admin'));
    }

    private function getPengajuanPb($id)
    {
        return collect(DB::select('SELECT * FROM perbaikan WHERE id_perbaikan = ?', [$id]))->firstOrFail();
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
                return redirect('approval/PB');
            // dd("berhasil");

            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }


}
