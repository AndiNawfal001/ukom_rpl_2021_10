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
        $data = DB::table('perawatan')->paginate(5);
        return view('perawatan.index', compact('data'));
    }

    public function search(Request $request){
        $search = $request->input('search');

        $data = DB::table('perawatan')
                ->where('kode_barang','like',"%".$search."%")
                ->orWhere('tgl_perawatan','like',"%".$search."%")
                ->orWhere('nama_pelaksana','like',"%".$search."%")
                ->paginate(5);
        return view('perawatan.index', compact('data'));
    }

    public function pilihbarangPerawatan(){
        $data = DB::table('detail_barang')
                ->where('kondisi_barang','baik')
                ->Where('status','aktif')
                ->paginate(10);
        return view('perawatan.pilihbarang', compact('data'));
    }

    public function searchpilihbarangPerawatan(Request $request){
        $search = $request->input('search');

        $data = DB::table('detail_barang')
                ->where('kondisi_barang','baik')
                ->where('status','aktif')
                ->where('kode_barang','like',"%".$search."%")
                ->orWhere('kondisi_barang','like',"%".$search."%")
                ->orWhere('status','like',"%".$search."%")
                ->paginate(10);
        return view('perawatan.pilihbarang', compact('data'));
    }


    private function databarangPerawatan($id)
    {
        return collect(DB::select('SELECT * FROM detail_barang WHERE kode_barang = ?', [$id]))->firstOrFail();
    }

    private function getPerawatan($id)
    {
        return collect(DB::select('SELECT nama_kode_barang.nama_barang, perawatan.*, ruangan.nama_ruangan
        FROM perawatan
        LEFT JOIN detail_barang
        ON perawatan.kode_barang = detail_barang.kode_barang
        LEFT JOIN ruangan
        ON detail_barang.ruangan = ruangan.id_ruangan
        LEFT JOIN nama_kode_barang
        ON perawatan.kode_barang = nama_kode_barang.kode_barang
        WHERE perawatan.id_perawatan = ?', [$id]
        ))->firstOrFail();
    }

    public function detail($id = null)
    {
        $detail = $this->getPerawatan($id);
        // dd($detail);
        return view('perawatan.detail', compact('detail'));
    }

    public function perawatan($id = null)
    {
        $perawatan = $this->databarangPerawatan($id);
        return view('perawatan.tambah', compact('perawatan'));
    }

    public function simpanperawatan(Request $request)
    {
        $request->validate([
            'image' => 'mimes:jpeg,jpg,png'
        ],
        [
            'image.mimes' => 'File harus bertipe: jpeg, jpg, png!',
        ]);
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
            if ($tambahPerawatan){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Data berhasil disimpan.');
                return redirect('perawatan');
            }else
                return "input data gagal";
            } catch (\Exception $e) {
            return  $e->getMessage();
            }
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
                $data = [
                    'nama_pelaksana' => $request->input('nama_pelaksana'),
                    'ket_perawatan' => $request->input('ket_perawatan'),
                    'foto_perawatan' => $image,
                ];
            }else{
                $data = [
                    'nama_pelaksana' => $request->input('nama_pelaksana'),
                    'ket_perawatan' => $request->input('ket_perawatan'),
                ];
            }
            $upd = DB::table('perawatan')
                            ->where('id_perawatan', '=', $request->input('id_perawatan'))
                            ->update($data);


            // dd('berhasil');
            if($upd){
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Data berhasil diubah.');
                // return redirect('perawatan/detail/'.$id_perawatan);
                return back();
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
                flash()->options([
                    'timeout' => 3000, // 3 seconds
                    'position' => 'top-center',
                ])->addSuccess('Data berhasil dihapus.');
                return redirect('perawatan');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }

}
