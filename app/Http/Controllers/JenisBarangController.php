<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
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

        // if($request->file('image')){
        //     $image = $request->file('image')->store('images');
        // }

        $dariFunction = DB::select('SELECT newIdJenisbrg() AS id_jenis_brg');
        $array = Arr::pluck($dariFunction, 'id_jenis_brg');
        $kode_baru = Arr::get($array, '0');

        $tambah_jenisbrg = DB::table('jenis_barang')->insert([
            'id_jenis_brg' => $kode_baru,
            'nama_jenis' => $request->input('nama_jenis'),
        ]);

        if ($tambah_jenisbrg)
            return redirect('barangMasuk');
        else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }


    public function update(Request $request, $id = null)
    {

        try {

            // if($request->file('image')){
            //     if($request->oldImage){
            //         Storage::delete($request->oldImage);
            //     }
            //     $image = $request->file('image')->store('images');
            // }

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
            // dd($id);
            // $x = DB::table('ruangan')
            //             ->where('id_ruangan', '=', $id)
            //             ->get(); //AMBIL DATA FILE
            // // dd($x);
            // $flattened = Arr::pluck($x, 'image');
            // // $y = Arr::flatten($flattened);
            // $price = Arr::get($flattened, '0');
            // Storage::delete($price); //HAPUS FILE DI STORAGE

            $hapus = DB::table('jenis_barang')
                            ->where('id_jenis_brg',$id)
                            ->delete();
            if($hapus){
                return redirect('barangMasuk');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
