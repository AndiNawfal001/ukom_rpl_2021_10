<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;

// use Illuminate\Support\Collection;

class PerawatanController extends Controller
{
    public function index()
    {
        $data = DB::table('perawatan')
            ->select('perawatan.*', 'nama_kode_barang.nama_barang', 'ruangan.nama_ruangan')
            ->leftJoin('detail_barang', 'perawatan.kode_barang', '=', 'detail_barang.kode_barang')
            ->leftJoin('ruangan', 'detail_barang.ruangan', '=', 'ruangan.id_ruangan')
            ->leftJoin('nama_kode_barang', 'perawatan.kode_barang', 'nama_kode_barang.kode_barang')
            ->paginate(10);
        return view('perawatan.index', compact('data'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $data = DB::table('perawatan')
            ->where('kode_barang', 'like', "%" . $search . "%")
            ->orWhere('tgl_perawatan', 'like', "%" . $search . "%")
            ->orWhere('nama_pelaksana', 'like', "%" . $search . "%")
            ->paginate(5);
        return view('perawatan.index', compact('data'));
    }

    public function pilihbarangPerawatan()
    {
        $data = DB::table('detail_barang')
            ->select('detail_barang.*', 'nama_kode_barang.nama_barang')
            ->leftJoin('nama_kode_barang', 'detail_barang.kode_barang', '=', 'nama_kode_barang.kode_barang')
            ->where('kondisi_barang', 'baik')
            ->where('status', 'aktif')
            ->paginate(10);
        return view('perawatan.pilihbarang', compact('data'));
    }

    public function searchpilihbarangPerawatan(Request $request)
    {
        $search = $request->input('search');

        $data = DB::table('detail_barang')
            ->select('detail_barang.*', 'nama_kode_barang.nama_barang')
            ->leftJoin('nama_kode_barang', 'detail_barang.kode_barang', '=', 'nama_kode_barang.kode_barang')
            ->where('kondisi_barang', 'baik')
            ->where('status', 'aktif')
            ->where('nama_kode_barang.nama_barang', 'like', "%" . $search . "%")
            ->orWhere('detail_barang.kode_barang', 'like', "%" . $search . "%")
            ->orWhere('kondisi_barang', 'like', "%" . $search . "%")
            ->orWhere('status', 'like', "%" . $search . "%")
            ->paginate(10);
        return view('perawatan.pilihbarang', compact('data'));
    }

    public function simpanperawatan(Request $request)
    {
        $request->validate(
            [
                'image' => 'mimes:jpeg,jpg,png'
            ],
            [
                'image.mimes' => 'File harus bertipe: jpeg, jpg, png!',
            ]
        );
        try {

            $dariFunction = DB::select('SELECT newIdPerawatan() AS id_perawatan');
            // dd($dariFunction);
            $array = Arr::pluck($dariFunction, 'id_perawatan');
            $id_perawatan = Arr::get($array, '0');
            // dd($id_perawatan);

            $tambahPerawatan = DB::table('perawatan')->insert([
                'id_perawatan' => $id_perawatan,
                'kode_barang' => $request->input('kode_barang'),
                'nama_pelaksana' => $request->input('nama_pelaksana'),
                'ket_perawatan' => $request->input('ket_perawatan'),
                'tgl_perawatan' => NOW(),

            ]);
            if ($tambahPerawatan) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('perawatan');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function editsimpan(Request $request)
    {
        try {

            if ($request->file('image')) {
                if ($request->oldImage) {
                    Storage::delete($request->oldImage);
                }
                $image = $request->file('image')->store('perawatan');
                $data = [
                    'nama_pelaksana' => $request->input('nama_pelaksana'),
                    'ket_perawatan' => $request->input('ket_perawatan'),
                    'foto_perawatan' => $image,
                ];
            } else {
                $data = [
                    'nama_pelaksana' => $request->input('nama_pelaksana'),
                    'ket_perawatan' => $request->input('ket_perawatan'),
                ];
            }
            $update_perawatan = DB::table('perawatan')
                ->where('id_perawatan', '=', $request->input('id_perawatan'))
                ->update($data);

            if ($update_perawatan) {
                flash()->addSuccess('Data berhasil diubah.');
            }
            return back();
            // dd("berhasil", $upd);
        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id = null)
    {

        try {
            $hapus = DB::table('perawatan')
                ->where('id_perawatan', $id)
                ->delete();
            if ($hapus) {
                flash()->addSuccess('Data berhasil dihapus.');
                return redirect('perawatan');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
