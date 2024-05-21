<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\RuanganModel;

class RuanganController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');

            $data = RuanganModel::where('nama_ruangan', 'like', "%" . $search . "%")
                ->orWhere('penanggung_jawab', 'like', "%" . $search . "%")
                ->orWhere('ket', 'like', "%" . $search . "%")
                ->orderBy('id_ruangan', 'DESC')
                ->paginate(10);
        } else {
            $data = RuanganModel::orderBy('id_ruangan', 'DESC')->paginate(10);
        }

        return view('ruangan.index', compact('data'));
    }

    public function formTambah()
    {
        return view('ruangan.formtambah');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_ruangan' => 'unique:ruangan,nama_ruangan',
            ],
            [
                'nama_ruangan.unique' => 'Nama tersebut sudah digunakan!',
            ]
        );
        try {

            // if($request->file('image')){
            //     $image = $request->file('image')->store('images');
            // }


            $kode_baru = collect(DB::select('SELECT newIdRuangan() AS id_ruangan'))->firstOrFail()->id_ruangan;
            $tambah_ruangan = RuanganModel::insert([
                'id_ruangan' => $kode_baru,
                'nama_ruangan' => $request->input('nama_ruangan'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'ket' => $request->input('ket'),
            ]);


            if ($tambah_ruangan) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('ruangan');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    private function getRuangan($id)
    {
        return collect(RuanganModel::where('id_ruangan', $id)->get())->firstOrFail();
    }

    public function edit($id = null)
    {
        $edit = $this->getRuangan($id);
        return view('ruangan.editform', compact('edit'));
    }

    public function update(Request $request)
    {
        $ruangan = RuanganModel::firstWhere('id_ruangan', '=', $request->input('id_ruangan'));

        if ($request->input('nama_ruangan') !== $ruangan->nama_ruangan) {

            $request->validate(
                [
                    'nama_ruangan' => 'unique:ruangan,nama_ruangan',
                ],
                [
                    'nama_ruangan.unique' => 'Nama tersebut sudah digunakan!',
                ]
            );
        }
        try {

            // if($request->file('image')){
            //     if($request->oldImage){
            //         Storage::delete($request->oldImage);
            //     }
            //     $image = $request->file('image')->store('images');
            // }
            // dd($request->all());
            $data = [
                'nama_ruangan' => $request->input('nama_ruangan'),
                'penanggung_jawab' => $request->input('penanggung_jawab'),
                'ket' => $request->input('ket'),
                // 'image' => $image,
            ];
            $update_ruangan = RuanganModel::where('id_ruangan', '=', $request->input('id_ruangan'))->update($data);
            if ($update_ruangan) {
                flash()->addSuccess('Data berhasil disimpan.');
            }
            return redirect('ruangan');
        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id = null)
    {

        try {
            // dd($id);
            // $x = DB::table('ruangan')
            //             ->where('id_ruangan', '=', $id)
            //             ->get(); //AMBIL DATA FILE
            // // dd($x);
            // $flattened = Arr::pluck($x, 'image');
            // // $y = Arr::flatten($flattened);
            // $price = Arr::get($flattened, '0');
            // Storage::delete($price); //HAPUS FILE DI STORAGE

            $hapus = RuanganModel::where('id_ruangan', $id)->delete();
            if ($hapus) {
                flash()
                    ->addSuccess('Data berhasil dihapus.');
                return back();
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
