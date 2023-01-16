<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


class PengajuanBBController extends Controller
{
    public function index(){
        $submitter = Auth::user()->id_pengguna;
        $data = DB::table('pengajuan_bb')
                ->where('submitter', $submitter)
                ->paginate(10);

        return view('pengajuan.barang_baru.index', compact('data'));
    }

    public function search(Request $request){
        $submitter = Auth::user()->id_pengguna;
        $search = $request->input('search');
        $data = DB::table('pengajuan_bb')
                ->where('submitter', $submitter)
                ->where('nama_barang','like',"%".$search."%")
                // ->orWhere('status_approval','like',"%".$search."%")
                // ->orWhere('tgl','like',"%".$search."%")
                ->paginate(10);
        return view('pengajuan.barang_baru.index', compact('data'));
    }

    private function getManajemen(): Collection
    {
        return collect(DB::select('SELECT * FROM manajemen'));
    }

    private function getKaprog(): Collection
    {
        return collect(DB::select('SELECT * FROM kaprog'));
    }

    private function getRuangan(): Collection
    {
        return collect(DB::select('SELECT * FROM ruangan'));
    }

    public function formTambah(){
        $manajemen = $this->getManajemen();
        $kaprog = $this->getKaprog();
        $ruangan = $this->getRuangan();
        return view('pengajuan.barang_baru.formtambah', compact('manajemen', 'kaprog', 'ruangan' ));
    }

    private function getPengajuanBb($id)
    {
        return collect(DB::select('SELECT * FROM pengajuan_bb WHERE id_pengajuan_bb = ?', [$id]))->firstOrFail();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|unique:pengajuan_bb,nama_barang'
        ]) ;
        try {
            $submitter_id = Auth::user()->id_pengguna;

            $tambah_pengajuan_bb = DB::table('pengajuan_bb')->insert([
                'submitter' => $submitter_id,
                'nama_barang' => $request->input('nama_barang'),
                'spesifikasi' => $request->input('spesifikasi'),
                'harga_satuan' => $request->input('harga_satuan'),
                'total_harga' => $request->input('total_harga'),
                'jumlah' => $request->input('jumlah'),
                'tgl' => NOW(),
                'ruangan' => $request->input('ruangan'),

            ]);
        if ($tambah_pengajuan_bb)
            return redirect('pengajuan/BB');
        else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

    public function edit($id = null)
    {

        $edit = $this->getPengajuanBb($id);

        return view('pengajuan.barang_baru.editform', compact('edit'));
    }

    public function detail($id = null)
    {

        $detail = $this->getPengajuanBb($id);
        return view('pengajuan.barang_baru.detail', compact('detail'));
    }


    public function editsimpan(Request $request)
    {
        try {
            $data = [
                'nama_barang' => $request->input('nama_barang'),
                'spesifikasi' => $request->input('spesifikasi'),
                'harga_satuan' => $request->input('harga_satuan'),
                'total_harga' => $request->input('total_harga'),
                'jumlah' => $request->input('jumlah')
            ];
            $upd = DB::table('pengajuan_bb')
                        ->where('id_pengajuan_bb', '=', $request->input('id_pengajuan_bb'))
                        ->update($data);
            if($upd){
                return redirect('pengajuan/BB');
            }
            // dd("berhasil", $upd);
        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id=null){
        // delete yg pending
        try{
            $hapus = DB::table('pengajuan_bb')
                            ->where('id_pengajuan_bb',$id, 'AND status_approval = "pending" ')
                            ->delete();
            if($hapus){
                return redirect('pengajuan/BB');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }




}
