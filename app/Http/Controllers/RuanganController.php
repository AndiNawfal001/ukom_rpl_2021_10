<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;


class RuanganController extends Controller
{
    public function index(){
        $data = DB::select('SELECT * FROM ruangan');
        // dd($data);
        $jumlah = DB::select('SELECT COUNT(id_ruangan) FROM ruangan');

        return view('ruangan.index', compact('data', 'jumlah'));
    }

    private function getRuangan($id)
    {
        return collect(DB::select('SELECT * FROM ruangan WHERE id_ruangan = ?', [$id]))->firstOrFail();
    }

    public function formTambah(){

        return view('ruangan.formtambah');
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

        $tambah_ruangan = DB::table('ruangan')->insert([
            'id_ruangan' => $kode_baru,
            'nama_ruangan' => $request->input('nama_ruangan'),
            'penanggung_jawab' => $request->input('penanggung_jawab'),
            'ket' => $request->input('ket'),

        ]);
        // $tambah_ruangan = DB::insert("CALL tambah_ruangan(:id_ruangan, :nama_ruangan, :penanggung_jawab, :ket, :image)", [
        //     'id_ruangan' => $kode_baru,
        //     'nama_ruangan' => $request->input('nama_ruangan'),
        //     'penanggung_jawab' => $request->input('penanggung_jawab'),
        //     'ket' => $request->input('ket'),
        //     // 'image' => $image,

        //     // dd($request->all())
        // ]);

        if ($tambah_ruangan)
            return redirect('ruangan');
        else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

    public function edit($id = null)
    {

        $edit = $this->getRuangan($id);

        return view('ruangan.editform', compact('edit'));
    }

    public function editsimpan(Request $request)
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
            $upd = DB::table('ruangan')
                        ->where('id_ruangan', '=', $request->input('id_ruangan'))
                        ->update($data);
            if($upd){
                return redirect('ruangan');
            }
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

            $hapus = DB::table('ruangan')
                            ->where('id_ruangan',$id)
                            ->delete();
            if($hapus){
                return redirect('ruangan');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
