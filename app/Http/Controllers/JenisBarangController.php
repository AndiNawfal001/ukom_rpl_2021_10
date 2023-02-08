<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class JenisBarangController extends Controller
{
    public function index(){
        $data = DB::table('jenis_barang')->paginate(5);
        return view('jenisbarang.index', compact('data' ));
    }

    public function search(Request $request){
        $search = $request->input('search');

        $data = DB::table('jenis_barang')
                ->where('nama_jenis','like',"%".$search."%")
                ->paginate(5);
        return view('jenisbarang.index', compact('data' ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|unique:jenis_barang,nama_jenis'
        ]);
        try {
        $dariFunction = DB::select('SELECT newIdJenisbrg() AS id_jenis_brg');
        $array = Arr::pluck($dariFunction, 'id_jenis_brg');
        $kode_baru = Arr::get($array, '0');

        $tambah_jenisbrg = DB::table('jenis_barang')->insert([
            'id_jenis_brg' => $kode_baru,
            'nama_jenis' => $request->input('nama_jenis'),
        ]);

        if ($tambah_jenisbrg){
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Barang Berhasil disimpan.');
            return redirect('barangMasuk');
        }else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }


    public function update(Request $request, $id = null)
    {

        try {
            $data = [
                'nama_jenis' => $request->input('nama_jenis'),
                // 'image' => $image,
            ];
            DB::table('jenis_barang')
                        ->where('id_jenis_brg', '=', $id)
                        ->update($data);
                return redirect('jenis_barang');
            // dd("berhasil", $upd);
        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id=null){

        try{
            $hapus = DB::table('jenis_barang')
                            ->where('id_jenis_brg',$id)
                            ->delete();
            if($hapus){
                flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Barang Berhasil dihapus.');
                return redirect('barangMasuk');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
