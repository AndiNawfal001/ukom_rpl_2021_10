<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use App\Models\RuanganModel;
use Illuminate\Support\Arr;


class RuanganController extends Controller
{
    public function index(){
        $data = RuanganModel::paginate(5);
        // dd($data);
        return view('ruangan.index', compact('data' ));
    }

    public function search(Request $request){
        $search = $request->input('search');

        $data = RuanganModel::where('nama_ruangan','like',"%".$search."%")
                ->orWhere('penanggung_jawab','like',"%".$search."%")
                ->orWhere('ket','like',"%".$search."%")
                ->paginate(5);
        return view('ruangan.index', compact('data' ));
    }

    public function store(Request $request)
    {
        try {

        // if($request->file('image')){
        //     $image = $request->file('image')->store('images');
        // }

        $dariFunction = DB::select('SELECT newIdRuangan() AS id_ruangan');
        $array = Arr::pluck($dariFunction, 'id_ruangan');
        $kode_baru = Arr::get($array, '0');
        // dd($kode_baru);
        $tambah_ruangan = RuanganModel::insert([
            'id_ruangan' => $kode_baru,
            'nama_ruangan' => $request->input('nama_ruangan'),
            'penanggung_jawab' => $request->input('penanggung_jawab'),
            'ket' => $request->input('ket'),
        ]);

        if ($tambah_ruangan)
            return redirect('ruangan');
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
                'nama_ruangan' => $request->input('nama_ruangan'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'ket' => $request->input('ket'),
                // 'image' => $image,
            ];
                RuanganModel::where('id_ruangan', '=', $id)
                        ->update($data);
                return redirect('ruangan');
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

            $hapus = RuanganModel::where('id_ruangan',$id)
                            ->delete();
            if($hapus){
                return redirect('ruangan');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
