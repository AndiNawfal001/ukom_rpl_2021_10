<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\JenisBarangModel;

class JenisBarangController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'unique:jenis_barang,nama_jenis'
        ]);
        try {
            $kode_baru = collect(DB::select('SELECT newIdJenisbrg() AS id_jenis_brg'))->firstOrFail()->id_jenis_brg;
            $tambah_jenisbrg = JenisBarangModel::insert([
                'id_jenis_brg' => $kode_baru,
                'nama_jenis' => $request->input('nama_jenis'),
            ]);

            if ($tambah_jenisbrg) {
                flash()->addSuccess('Barang Berhasil disimpan.');
                return redirect('barangMasuk');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function hapus($id = null)
    {

        try {
            $hapus = JenisBarangModel::where('id_jenis_brg', $id)->delete();
            if ($hapus) {
                flash()->addSuccess('Barang Berhasil dihapus.');
                return redirect('barangMasuk');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
