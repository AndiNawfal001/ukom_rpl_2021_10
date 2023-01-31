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

        $data = DB::table('barang_masuk_perbaikan')
                ->where('submitter', $submitter)
                ->paginate(10);
        // $data = DB::table('perbaikan')->join('barang_masuk_perbaikan', 'perbaikan.kode_barang', '=', 'barang_masuk_perbaikan.kode_barang')->where('submitter',$submitter)->paginate(10);
        return view('pengajuan.perbaikan.index', compact('data' ));
    }

    public function search(Request $request){
        $submitter= Auth::user()->id_pengguna;
        $search = $request->input('search');

        $data = DB::table('perbaikan')
                ->where('submitter', $submitter)
                ->where('kode_barang','like',"%".$search."%")
                ->paginate(10);
        return view('pengajuan.perbaikan.index', compact('data' ));
    }

    private function getRuangan(): Collection
    {
        return collect(DB::select('SELECT * FROM ruangan'));
    }

    public function pilihBarang(){
        $ruangan = $this->getRuangan();

        // VIEW
        $data = DB::table('barang_masuk_perbaikan')
        ->distinct()
        ->select('nama_barang', 'asli', 'kondisi_barang', 'status', 'submitter', 'approve_perbaikan')
        ->where('status', 'aktif')
        ->where('kondisi_barang', 'baik')
        ->whereNull('submitter')
        ->orWhere('approve_perbaikan', 'sudah diperbaiki')
        // ->orWhere(function($query) {
        //     $query->where('approve_perbaikan', 'sudah diperbaiki')
        //           ;
        // })
        // ->whereNull('approve_perbaikan')
        // ->orWhereNull('id_perbaikan')
        // ->orWhere('approve_perbaikan','sudah diperbaiki')
        ->paginate(10);
        // $data = DB::table('barang_masuk_perbaikan')
        // ->select('*')
        // ->where('status', 'aktif')
        // ->where('kondisi_barang', 'baik')
        // // ->whereNull('id_perbaikan')
        // // ->where('approve_perbaikan','sudah diperbaiki')
        // ->paginate(10);
        // dd($data);
        return view('pengajuan.perbaikan.pilihbarang', compact('data', 'ruangan'));
    }

    public function searchpilihbarang(Request $request){
        $ruangan = $this->getRuangan();

        $search = $request->input('search');
        $data = DB::table('barang_masuk_perbaikan')
        ->select('*')
        ->where('asli','like',"%".$search."%")
        ->orWhere('nama_barang','like',"%".$search."%")
        ->where('status', 'aktif')
        ->where('kondisi_barang', 'baik')
        ->paginate(10);
        return view('pengajuan.perbaikan.pilihbarang', compact('data','ruangan'));
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
            // dd($request->input('ruangan'));
            $tambah_pengajuan_pb = DB::table('perbaikan')->insert([
                'id_perbaikan' => $id_perbaikan,
                'kode_barang' => $request->input('kode_barang'),
                'submitter' => $submitter_id,
                // 'ruangan' => $request->input('ruangan'),
                'tgl_perbaikan' => NOW(),
                'keluhan' => $request->input('keluhan'),

            ]);

            if ($tambah_pengajuan_pb){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Data berhasil disimpan.');
                return redirect('pengajuan/PB');
            }else
                return "input data gagal";
            } catch (\Exception $e) {
            return  $e->getMessage();
            }
    }

    private function getPengajuanPb($id)
    {
        // return collect(DB::select('SELECT perbaikan.*, barang_masuk_perbaikan.* FROM perbaikan JOIN barang_masuk_perbaikan ON perbaikan.kode_barang = barang_masuk_perbaikan.kode_barang WHERE perbaikan.id_perbaikan = ?', [$id]))->firstOrFail();
        return collect(DB::select('SELECT barang_masuk_perbaikan.*, ruangan.nama_ruangan
        FROM barang_masuk_perbaikan
        LEFT JOIN detail_barang ON barang_masuk_perbaikan.kode_barang = detail_barang.kode_barang
        LEFT JOIN ruangan ON detail_barang.ruangan = ruangan.id_ruangan
        WHERE barang_masuk_perbaikan.id_perbaikan = ?', [$id]))->firstOrFail();
    }

    public function detail($id = null)
    {
        $detail = $this->getPengajuanPb($id);
        return view('pengajuan.perbaikan.detail', compact('detail'));
    }

    public function hapus($id=null){
        try{
            $hapus = DB::table('perbaikan')
                            ->where('id_perbaikan',$id)
                            ->delete();
            if($hapus){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Data berhasil dihapus.');
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

        // dd($request->input('id_perbaikan'));
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
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Data berhasil disimpan.');
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
