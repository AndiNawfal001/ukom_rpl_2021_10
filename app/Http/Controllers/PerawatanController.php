<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\PerawatanModel;
use App\Models\DetailBarangModel;

class PerawatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data = PerawatanModel::select('perawatan.*', 'nama_kode_barang.nama_barang', 'ruangan.nama_ruangan')
                ->leftJoin('detail_barang', 'perawatan.kode_barang', '=', 'detail_barang.kode_barang')
                ->leftJoin('ruangan', 'detail_barang.ruangan', '=', 'ruangan.id_ruangan')
                ->leftJoin('nama_kode_barang', 'perawatan.kode_barang', 'nama_kode_barang.kode_barang')
                ->where('perawatan.kode_barang', 'like', "%" . $search . "%")
                ->orWhere('nama_kode_barang.nama_barang', 'like', "%" . $search . "%")
                ->orWhere('perawatan.tgl_perawatan', 'like', "%" . $search . "%")
                ->orWhere('perawatan.nama_pelaksana', 'like', "%" . $search . "%")
                ->paginate(10);
        } else {
            // TIDAK DI JADIKAN VIEW KARENA DATA JOIN TERSEBUT HANYA UNTUK DETAIL
            $data = PerawatanModel::select('perawatan.*', 'nama_kode_barang.nama_barang', 'ruangan.nama_ruangan')
                ->leftJoin('detail_barang', 'perawatan.kode_barang', '=', 'detail_barang.kode_barang')
                ->leftJoin('ruangan', 'detail_barang.ruangan', '=', 'ruangan.id_ruangan')
                ->leftJoin('nama_kode_barang', 'perawatan.kode_barang', 'nama_kode_barang.kode_barang')
                ->paginate(10);
        }


        return view('perawatan.index', compact('data'));
    }

    public function pilihbarangPerawatan(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DetailBarangModel::select('detail_barang.*', 'nama_kode_barang.nama_barang')
                ->leftJoin('nama_kode_barang', 'detail_barang.kode_barang', '=', 'nama_kode_barang.kode_barang')
                ->where('kondisi_barang', 'baik')
                ->where('status', 'aktif')
                ->where('nama_kode_barang.nama_barang', 'like', "%" . $search . "%")
                ->orWhere('detail_barang.kode_barang', 'like', "%" . $search . "%")
                ->orWhere('kondisi_barang', 'like', "%" . $search . "%")
                ->orWhere('status', 'like', "%" . $search . "%")
                ->paginate(10);
        } else {
            $data = DetailBarangModel::select('detail_barang.*', 'nama_kode_barang.nama_barang')
                ->leftJoin('nama_kode_barang', 'detail_barang.kode_barang', '=', 'nama_kode_barang.kode_barang')
                ->where('kondisi_barang', 'baik')
                ->where('status', 'aktif')
                ->paginate(10);
        }


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

            $id_perawatan = collect(DB::select('SELECT newIdPerawatan() AS id_perawatan'))->firstOrFail()->id_perawatan;

            $tambahPerawatan = PerawatanModel::insert([
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
            $update_perawatan = PerawatanModel::where('id_perawatan', '=', $request->input('id_perawatan'))->update($data);

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
            $hapus = PerawatanModel::where('id_perawatan', $id)->delete();
            if ($hapus) {
                flash()->addSuccess('Data berhasil dihapus.');
                return redirect('perawatan');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
