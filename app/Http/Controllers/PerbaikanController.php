<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PerbaikanController extends Controller
{
    public function index(){
        $data = DB::select('SELECT * FROM perbaikan');
        $admin = DB::select('SELECT * FROM perbaikan WHERE tgl_selesai_perbaikan IS NOT NULL');
        return view('pengajuan.perbaikan.index', compact('data', 'admin'));
    }

    public function pilihBarang(){
        // $data = DB::select('SELECT * FROM barang_masuk_perbaikan');
        $data = DB::table('barang_masuk_perbaikan')
        ->select('*')
        ->where('status', 'aktif')
        ->where('kondisi_barang', 'baik')
        ->paginate(10);
        return view('pengajuan.perbaikan.pilihbarang', compact('data'));
    }

    private function getManajemen(): Collection
    {
        return collect(DB::select('SELECT * FROM manajemen'));
    }

    private function getKaprog(): Collection
    {
        return collect(DB::select('SELECT * FROM kaprog'));
    }

    private function getBarang(): Collection
    {
        return collect(DB::select('SELECT * FROM barang'));
    }

    private function inputDataPerbaikan($id)
    {
        return collect(DB::select('SELECT * FROM detail_barang WHERE kode_barang = ?', [$id]))->firstOrFail();
    }

    public function perbaikan($id = null)
    {
        // $kaprog = DB::table('pengguna_kaprog')
        // ->select('nama')
        // ->where('username',Auth::user()->username)
        // ->get();
        // $array = Arr::pluck($kaprog, 'nama');
        // $kode_baru = Arr::get($array, '0');
        // dd($kode_baru);
        $submitter = Auth::user()->username;
        $perbaikan = $this->inputDataPerbaikan($id);
        return view('pengajuan.perbaikan.perbaikan', compact('perbaikan', 'submitter'));
    }

    public function simpanperbaikan(Request $request)
    {
        try {
            // $x = DB::table('kaprog')
            //     ->select('nip')
            //     ->where('nama', $request->input('kaprog'))
            //     ->get();
            //     $array = Arr::pluck($x, 'nip');
            //     $kode_baru = Arr::get($array, '0');
            // dd($kode_baru);
                // dd($request->all());
            $dariFunction = DB::select('SELECT newIdPerbaikan() AS id_perbaikan');
            // dd($dariFunction);
            $array = Arr::pluck($dariFunction, 'id_perbaikan');
            $id_perbaikan = Arr::get($array, '0');
            // dd($id_perbaikan);

            $tambah_pengajuan_pb = DB::insert("CALL tambah_perbaikan(:id_perbaikan, :kode_barang, :approver, :submitter, :ruangan, :keluhan)", [
                'id_perbaikan' => $id_perbaikan,
                'kode_barang' => $request->input('kode_barang'),
                'approver' => $request->input('approver'),
                'submitter' => $request->input('submitter'),
                'ruangan' => $request->input('ruangan'),
                'keluhan' => $request->input('keluhan'),

                // dd($request->all())
            ]);
            // dd($request->all());

            if ($tambah_pengajuan_pb)
                return redirect('pengajuan/PB');
            else
                return "input data gagal";
            } catch (\Exception $e) {
            return  $e->getMessage();
            }
    }
    private function getPengajuanPb($id)
    {
        return collect(DB::select('SELECT * FROM perbaikan WHERE id_perbaikan = ?', [$id]))->firstOrFail();
    }
    public function detail($id = null)
    {
        $detail = $this->getPengajuanPb($id);
        return view('pengajuan.perbaikan.detail', compact('detail'));
    }
    // public function edit($id = null)
    // {

    //     $edit = $this->getPengajuanPb($id);

    //     return view('pengajuan.perbaikan.editform', compact('edit'));
    // }
    // public function editsimpan(Request $request)
    // {
    //     try {
    //         $data = [
    //             'manajemen' => $request->input('manajemen'),
    //             'kaprog' => $request->input('kaprog'),
    //             'nama_barang' => $request->input('nama_barang'),
    //             'ruangan' => $request->input('ruangan'),

    //         ];
    //         $upd = DB::table('pengajuan_pb')
    //                     ->where('id_perbaikan', '=', $request->input('id_perbaikan'))
    //                     ->update($data);
    //         if($upd){
    //             return redirect('pengajuan/PB');
    //         }
    //         // dd("berhasil", $upd);
    //     } catch (\Exception $e) {
    //         return $e->getMessage();
    //         dd("gagal");
    //     }
    // }

    public function hapus($id=null){
        try{
            $hapus = DB::table('pengajuan_pb')
                            ->where('id_perbaikan',$id)
                            ->delete();
            if($hapus){
                return redirect('pengajuan/PB');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    public function selesaiPerbaikan($id=null){
        $edit = $this->getPengajuanPb($id);

        return view('pengajuan.perbaikan.selesaiperbaikan', compact('edit'));
    }

    public function simpanSelesaiPerbaikan(Request $request)
    {
        $image = $request->file('image')->store('perbaikan');

        // dd($image);
        try {
            $data = [
                'nama_teknisi' => $request->input('nama_teknisi'),
                'penyebab_keluhan' => $request->input('penyebab_keluhan'),
                'status_perbaikan' => $request->input('status_perbaikan'),
                'solusi_barang' => $request->input('solusi_barang'),
                'tgl_selesai_perbaikan' => NOW(),
                'gambar_pelaksanaan' => $image
            //    dd($request->all())
            ];
            // dd("berhasil");

            $upd = DB::table('perbaikan')
                        ->where('id_perbaikan', '=', $request->input('id_perbaikan'))
                        ->update($data);
            if($upd){
                return redirect('pengajuan/PB');
            // dd("berhasil", $upd);
            }
            // dd("berhasil", $upd);
        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }
}
