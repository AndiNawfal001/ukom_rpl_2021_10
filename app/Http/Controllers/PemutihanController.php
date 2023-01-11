<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class PemutihanController extends Controller
{
    public function index(){
        // $pemutihanKaprog = DB::table('perbaikan')->where('approve_perbaikan', '=', 'rusak')->count();
        // dd($pemutihanKaprog);
        $data = DB::select('SELECT * FROM pemutihan');
        return view('pengajuan.pemutihan.index', compact('data'));
    }

    public function pilihbarangPemutihanLangsung(){
        // $data = DB::select('SELECT * FROM barang_masuk_perbaikan');
        $data = DB::table('barang_masuk_perbaikan')
        ->select('*')
        ->where('kondisi_barang', 'baik')
        ->where('status', 'aktif')
        ->paginate(10);
        return view('pengajuan.pemutihan.pemutihanLangsung.pilihbarang', compact('data'));
    }

    public function pilihbarang()
    {
        $data = DB::select('SELECT * FROM perbaikan WHERE approve_perbaikan = "rusak"');
        return view('pengajuan.pemutihan.pilihbarang', compact('data'));
    }

    private function inputDataPemutihan($id)
    {
        return collect(DB::select('SELECT * FROM perbaikan WHERE id_perbaikan = ?', [$id]))->firstOrFail();
    }

    private function inputDataPemutihanLangsung($id)
    {
        return collect(DB::select('SELECT * FROM detail_barang WHERE kode_barang = ?', [$id]))->firstOrFail();
    }

    private function getPemutihan($id)
    {
        return collect(DB::select('SELECT * FROM pemutihan WHERE id_pemutihan = ?', [$id]))->firstOrFail();
    }
    public function detail($id = null)
    {
        $detail = $this->getPemutihan($id);
        return view('pengajuan.pemutihan.detail', compact('detail'));
    }

    public function pemutihanLangsung($id = null)
    {
        $kaprog = DB::table('pengguna_kaprog')
        ->select('nama')
        ->where('username',Auth::user()->username)
        ->get();
        $array = Arr::pluck($kaprog, 'nama');
        $kode_baru = Arr::get($array, '0');
        // dd($kode_baru);
        $pemutihanLangsung = $this->inputDataPemutihanLangsung($id);
        return view('pengajuan.pemutihan.pemutihanLangsung.tambah', compact('pemutihanLangsung', 'kode_baru'));
    }

    public function simpanpemutihanLangsung(Request $request)
    {
        try {

            $x = DB::table('kaprog')
                ->select('nip')
                ->where('nama', $request->input('kaprog'))
                ->get();
                $array = Arr::pluck($x, 'nip');
                $kode_baru = Arr::get($array, '0');

            $hehe = DB::insert("CALL tambah_pemutihan_langsung(:kode_barang, :kaprog, :ket_pemutihan)", [
                'kode_barang' => $request->input('kode_barang'),
                'kaprog' => $kode_baru,
                'ket_pemutihan' => $request->input('ket_pemutihan'),

                // dd($request->all())
            ]);

            if ($hehe)
                return redirect('pemutihan');
            else
                return "input data gagal";
            } catch (\Exception $e) {
            return  $e->getMessage();
            }
    }






    public function pemutihan($id = null)
    {
        $kaprog = DB::table('pengguna_kaprog')
        ->select('nama')
        ->where('username',Auth::user()->username)
        ->get();
        $array = Arr::pluck($kaprog, 'nama');
        $kode_baru = Arr::get($array, '0');
        // dd($kode_baru);
        $pemutihan = $this->inputDataPemutihan($id);
        return view('pengajuan.pemutihan.tambah', compact('pemutihan', 'kode_baru'));
    }


    public function simpanpemutihan(Request $request)
    {
        try {
            $x = DB::table('kaprog')
                ->select('nip')
                ->where('nama', $request->input('kaprog'))
                ->get();
                $array = Arr::pluck($x, 'nip');
                $kode_baru = Arr::get($array, '0');

            $tambah_pengajuan_pb = DB::insert("CALL tambah_pemutihan(:id_perbaikan, :kode_barang, :kaprog, :ket_pemutihan)", [
                'id_perbaikan' => $request->input('id_perbaikan'),
                'kode_barang' => $request->input('kode_barang'),
                'kaprog' => $kode_baru,
                'ket_pemutihan' => $request->input('ket_pemutihan'),

                // dd($request->all())
            ]);

            if ($tambah_pengajuan_pb)
                return redirect('pemutihan');
            else
                return "input data gagal";
            } catch (\Exception $e) {
            return  $e->getMessage();
            }
    }

    // APPROVAL PENGAJUAN
    public function statusSetuju($id=null, $kode=null){
        try{
            $manajemen = DB::table('pengguna_manajemen')
                ->select('nama')
                ->where('username',Auth::user()->username)
                ->get();
                $array = Arr::pluck($manajemen, 'nama');
                $kode_lama = Arr::get($array, '0');

            $x = DB::table('manajemen')
                ->select('nip')
                ->where('nama', $kode_lama)
                ->get();
                $array = Arr::pluck($x, 'nip');
                $kode_baru = Arr::get($array, '0');
            // dd($kode_baru);

            $approve = [
                'manajemen' => $kode_baru,
                'approve_penonaktifan' => ('setuju'),
                'tgl_approve' => NOW()
            ];

            $status = [
                'status' => ('nonaktif')
            ];

            $pemutihan = DB::table('pemutihan')
                            ->where('id_pemutihan',$id)
                            ->update($approve);

            $detail_barang = DB::table('detail_barang')
                            ->where('kode_barang',$kode)
                            ->update($status);

            if($pemutihan){
                return redirect('pemutihan');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    public function statusTidakSetuju($id=null){
        try{
            $manajemen = DB::table('pengguna_manajemen')
                ->select('nama')
                ->where('username',Auth::user()->username)
                ->get();
                $array = Arr::pluck($manajemen, 'nama');
                $kode_lama = Arr::get($array, '0');

            $x = DB::table('manajemen')
                ->select('nip')
                ->where('nama', $kode_lama)
                ->get();
                $array = Arr::pluck($x, 'nip');
                $kode_baru = Arr::get($array, '0');
            // dd($kode_baru);

            $approve = [
                'manajemen' => $kode_baru,
                'approve_penonaktifan' => ('tidak setuju'),
                'tgl_approve' => NOW()
            ];

            $pemutihan = DB::table('pemutihan')
                            ->where('id_pemutihan',$id)
                            ->update($approve);

            if($pemutihan){
                return redirect('pemutihan');
            // dd("berhasil");

            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
