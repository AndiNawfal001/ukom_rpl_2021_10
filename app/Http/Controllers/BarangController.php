<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BarangController extends Controller
{
    //
    public function index(){
        $data = DB::table('barang_aktif_rusak')->paginate(10);
        return view('barang.index', compact('data'));
    }

    public function search(Request $request){
        $search = $request->input('search');
        $data = DB::table('barang_aktif_rusak')
        ->where('nama_jenis','like',"%".$search."%")
        ->orWhere('nama_barang','like',"%".$search."%")
        ->paginate(10);

        return view('barang.index', compact('data'));
    }

    public function detail($id=null){
        $id_barang = $id;
        $data = DB::table('barang')
        ->join('jenis_barang', 'barang.id_jenis_brg', '=', 'jenis_barang.id_jenis_brg')
        ->join('detail_barang', 'barang.id_barang', '=', 'detail_barang.id_barang')
        ->where('detail_barang.id_barang', $id)
        ->paginate(10);

        // dd($data);
        return view('barang.detail', compact('id_barang','data'));
    }

    public function searchdetail(Request $request, $id=null){
        // dd($id);
        $id_barang = $id;
        $search = $request->input('search');

        $data = DB::table('barang')
        ->join('jenis_barang', 'barang.id_jenis_brg', '=', 'jenis_barang.id_jenis_brg')
        ->join('detail_barang', 'barang.id_barang', '=', 'detail_barang.id_barang')
        ->where('barang.id_barang', $id)
        ->where('barang.nama_barang','like',"%".$search."%")
        ->orWhere('kode_barang','like',"%".$search."%")
        ->orWhere('kondisi_barang','like',"%".$search."%")
        ->orWhere('status','like',"%".$search."%")
        ->paginate(10);
        return view('barang.detail', compact('id_barang','data'));
    }

    private function getSpesifik($id)
    {
        return collect(DB::select('
        SELECT detail_barang.*, barang.nama_barang, jenis_barang.nama_jenis, ruangan.nama_ruangan
        FROM barang
        JOIN detail_barang
        ON barang.id_barang = detail_barang.id_barang
        JOIN jenis_barang
        ON barang.id_jenis_brg = jenis_barang.id_jenis_brg
        LEFT JOIN ruangan
        ON detail_barang.ruangan = ruangan.id_ruangan
        WHERE detail_barang.kode_barang = ?', [$id])
        )->firstOrFail();
    }

    public function spesifik($id=null){
        $data = $this->getSpesifik($id);
        $modal = DB::table('barang')
        ->join('jenis_barang', 'barang.id_jenis_brg', '=', 'jenis_barang.id_jenis_brg')
        ->join('detail_barang', 'barang.id_barang', '=', 'detail_barang.id_barang')
        ->where('detail_barang.kode_barang', $id)
        ->paginate(10);
        // dd($data);
        return view('barang.spesifik', compact('data', 'modal'));
    }

    public function update(Request $request, $id=null)
    {
        try {
            if($request->file('image')){
                $image = $request->file('image')->store('detail_barang');
                $data = [
                    'spesifikasi'   => $request->input('spesifikasi'),
                    'foto_barang' => $image
                ];
            }else{
                $data = [
                    'spesifikasi'   => $request->input('spesifikasi'),
                ];
            }

            DB::table('detail_barang')
                        ->where('kode_barang', '=', $id)
                        ->update($data);
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Data Berhasil diubah.');
            return redirect('/barang/detail/spesifik/'.$request->input('kode_barang'));

        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }
}
