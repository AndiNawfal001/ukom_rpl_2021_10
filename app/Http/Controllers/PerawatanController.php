<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

// use Illuminate\Support\Collection;

class PerawatanController extends Controller{
    public function index(){
        $data = DB::select('SELECT * FROM perawatan');
        return view('perawatan.index', compact('data'));
    }

    public function pilihbarangPerawatan(){
        $data = DB::select('SELECT * FROM detail_barang WHERE kondisi_barang = "baik" AND status = "aktif" ');
        return view('perawatan.pilihbarang', compact('data'));
    }

    private function databarangPerawatan($id)
    {
        return collect(DB::select('SELECT * FROM detail_barang WHERE kode_barang = ?', [$id]))->firstOrFail();
    }

    private function getPerawatan($id)
    {
        return collect(DB::select('SELECT * FROM perawatan WHERE id_perawatan = ?', [$id]))->firstOrFail();
    }

    public function perawatan($id = null)
    {
        $perawatan = $this->databarangPerawatan($id);
        return view('perawatan.tambah', compact('perawatan'));
    }

    public function simpanperawatan(Request $request)
    {
        try {

            $dariFunction = DB::select('SELECT newIdPerawatan() AS id_perawatan');
            // dd($dariFunction);
            $array = Arr::pluck($dariFunction, 'id_perawatan');
            $id_perawatan = Arr::get($array, '0');
            // dd($id_perawatan);

            $image = $request->file('image')->store('perawatan');

            $tambahPerawatan = DB::table('perawatan')->insert([
                'id_perawatan' => $id_perawatan,
                'kode_barang' => $request->input('kode_barang'),
                'nama_pelaksana' => $request->input('nama_pelaksana'),
                'ket_perawatan' => $request->input('ket_perawatan'),
                'tgl_perawatan' => NOW(),
                'foto_perawatan' => $image

            ]);
            if ($tambahPerawatan)
                return redirect('perawatan');
            else
                return "input data gagal";
            } catch (\Exception $e) {
            return  $e->getMessage();
            }
    }

    public function detail($id = null)
    {
        $detail = $this->getPerawatan($id);
        return view('perawatan.detail', compact('detail'));
    }

    public function edit($id = null)
    {

        $edit = $this->getPerawatan($id);

        return view('perawatan.editform', compact('edit'));
    }

    public function editsimpan(Request $request)
    {
        try {

            if($request->file('image')){
                if($request->oldImage){
                    Storage::delete($request->oldImage);
                }
                $image = $request->file('image')->store('perawatan');
            }

            $data = [
                'nama_pelaksana' => $request->input('nama_pelaksana'),
                'ket_perawatan' => $request->input('ket_perawatan'),
                'foto_perawatan' => $image,
            ];
            $upd = DB::table('perawatan')
                        ->where('id_perawatan', '=', $request->input('id_perawatan'))
                        ->update($data);
            // dd('berhasil');
            if($upd){
                // return redirect('perawatan/detail/'.$id_perawatan);
                return redirect('perawatan');
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
            $x = DB::table('perawatan')
                        ->where('id_perawatan', '=', $id)
                        ->get(); //AMBIL DATA FILE
            // dd($x);
            $flattened = Arr::pluck($x, 'foto_perawatan');
            // $y = Arr::flatten($flattened);
            $price = Arr::get($flattened, '0');
            // dd($price);
            Storage::delete($price); //HAPUS FILE DI STORAGE

            $hapus = DB::table('perawatan')
                            ->where('id_perawatan',$id)
                            ->delete();
            if($hapus){
                return redirect('perawatan');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

}
