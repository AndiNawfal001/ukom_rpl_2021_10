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
        $submitter= Auth::user()->id_pengguna;

        $data = DB::select('SELECT * FROM perbaikan WHERE submitter ='. $submitter);
        return view('pengajuan.perbaikan.index', compact('data' ));
    }

    public function pilihBarang(){
        $data = DB::table('barang_masuk_perbaikan')
        ->select('*')
        ->where('status', 'aktif')
        ->where('kondisi_barang', 'baik')
        ->paginate(10);
        return view('pengajuan.perbaikan.pilihbarang', compact('data'));
    }
    private function inputDataPerbaikan($id)
    {
        return collect(DB::select('SELECT * FROM detail_barang WHERE kode_barang = ?', [$id]))->firstOrFail();
    }

    public function perbaikan($id = null)
    {
        $perbaikan = $this->inputDataPerbaikan($id);
        return view('pengajuan.perbaikan.perbaikan', compact('perbaikan' ));
    }

    public function simpanperbaikan(Request $request)
    {
        try {

            $dariFunction = DB::select('SELECT newIdPerbaikan() AS id_perbaikan');
            // dd($dariFunction);
            $array = Arr::pluck($dariFunction, 'id_perbaikan');
            $id_perbaikan = Arr::get($array, '0');
            // dd($id_perbaikan);
            $submitter_id = Auth::user()->id_pengguna;

            $tambah_pengajuan_pb = DB::table('perbaikan')->insert([
                'id_perbaikan' => $id_perbaikan,
                'kode_barang' => $request->input('kode_barang'),
                'submitter' => $submitter_id,
                'ruangan' => $request->input('ruangan'),
                'tgl_perbaikan' => NOW(),
                'keluhan' => $request->input('keluhan'),

            ]);

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
