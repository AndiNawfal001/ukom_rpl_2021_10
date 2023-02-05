<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


class PengajuanBBController extends Controller
{

    private function getRuangan(): Collection
    {
        return collect(DB::select('SELECT * FROM ruangan'));
    }

    public function index(){
        $ruangan = $this->getRuangan();
        $submitter = Auth::user()->id_pengguna;
        $data = DB::table('pengajuan_bb')
                ->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
                ->where('submitter', $submitter)
                ->paginate(10);

        return view('pengajuan.barang_baru.index', compact('data', 'ruangan'));
    }

    public function search(Request $request){
        $ruangan = $this->getRuangan();
        $submitter = Auth::user()->id_pengguna;
        $search = $request->input('search');
        $data = DB::table('pengajuan_bb')
                ->where('submitter', $submitter)
                ->where('nama_barang','like',"%".$search."%")
                // ->orWhere('status_approval','like',"%".$search."%")
                // ->orWhere('tgl','like',"%".$search."%")
                ->paginate(10);
        return view('pengajuan.barang_baru.index', compact('data', 'ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|unique:pengajuan_bb,nama_barang',
            // 'harga_satuan' => 'max:15'
        ]) ;
        try {
            $submitter_id = Auth::user()->id_pengguna;
            $total_harga = $request->input('harga_satuan') * $request->input('jumlah');
            $tambah_pengajuan_bb = DB::table('pengajuan_bb')->insert([
                'submitter' => $submitter_id,
                'nama_barang' => $request->input('nama_barang'),
                'spesifikasi' => $request->input('spesifikasi'),
                'harga_satuan' => $request->input('harga_satuan'),
                'total_harga' => $total_harga,
                'jumlah' => $request->input('jumlah'),
                'tgl' => NOW(),
                'ruangan' => $request->input('ruangan'),

            ]);
        if ($tambah_pengajuan_bb){
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Data berhasil disimpan.');
            return redirect('pengajuan/BB');
        }else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

    public function update(Request $request, $id = null)
    {
        try {
            $total_harga = $request->input('harga_satuan') * $request->input('jumlah');
            $data = [
                'nama_barang' => $request->input('nama_barang'),
                'spesifikasi' => $request->input('spesifikasi'),
                'harga_satuan' => $request->input('harga_satuan'),
                'total_harga' => $total_harga,
                'jumlah' => $request->input('jumlah')
            ];
            DB::table('pengajuan_bb')
                        ->where('id_pengajuan_bb', '=', $id)
                        ->update($data);
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Data berhasil diubah.');
                return redirect('pengajuan/BB');
            }
            // dd("berhasil", $upd);
        catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id=null){
        try{
            $hapus = DB::table('pengajuan_bb')
                            ->where('id_pengajuan_bb',$id, 'AND status_approval = "pending" ')
                            ->delete();
            if($hapus){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Data berhasil dihapus.');
                return redirect('pengajuan/BB');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }




}
