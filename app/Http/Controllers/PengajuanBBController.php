<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

use App\Models\PengajuanBBModel;
use App\Models\RuanganModel;


class PengajuanBBController extends Controller
{

    public function index(Request $request)
    {
        $submitter = Auth::user()->id_pengguna;

        if ($request->has('search')) {
            $search = $request->input('search');
            $data = PengajuanBBModel::where('nama_barang', 'like', "%" . $search . "%")
                ->where('submitter', $submitter)
                ->leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
                ->paginate(10);
        } else {
            $data = PengajuanBBModel::leftJoin('ruangan', 'pengajuan_bb.ruangan', '=', 'ruangan.id_ruangan')
                ->where('submitter', $submitter)
                ->paginate(10);
        }

        $submitter = Auth::user()->id_pengguna;


        return view('pengajuan.barang_baru.index', compact('data'));
    }

    private function getRuangan(): Collection
    {
        return collect(RuanganModel::get());
    }

    public function formTambah()
    {
        $ruangan = $this->getRuangan();
        return view('pengajuan.barang_baru.formtambah', compact('ruangan'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_barang' => 'unique:pengajuan_bb,nama_barang',
                // 'harga_satuan' => 'max:15'
            ],
            [
                'nama_barang.unique' => 'Nama tersebut sudah digunakan!',
            ]
        );
        try {
            $submitter_id = Auth::user()->id_pengguna;
            $total_harga = $request->input('harga_satuan') * $request->input('jumlah');
            $tambah_pengajuan_bb = PengajuanBBModel::insert([
                'submitter' => $submitter_id,
                'nama_barang' => $request->input('nama_barang'),
                'spesifikasi' => $request->input('spesifikasi'),
                'harga_satuan' => $request->input('harga_satuan'),
                'total_harga' => $total_harga,
                'jumlah' => $request->input('jumlah'),
                'tgl' => NOW(),
                'ruangan' => $request->input('ruangan'),

            ]);
            if ($tambah_pengajuan_bb) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('pengajuan/BB');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    private function getPengajuanBb($id)
    {
        return collect(PengajuanBBModel::where('id_pengajuan_bb', $id)->get())->firstOrFail();
    }

    public function edit($id = null)
    {
        $edit = $this->getPengajuanBb($id);
        return view('pengajuan.barang_baru.editform', compact('edit'));
    }

    public function update(Request $request, $id = null)
    {
        $pengajuan_bb = PengajuanBBModel::where('id_pengajuan_bb', $id)->first();
        if ($request->input('nama_barang') !== $pengajuan_bb->nama_barang) {

            $request->validate(
                [
                    'nama_barang' => 'unique:pengajuan_bb,nama_barang',
                ],
                [
                    'nama_barang.unique' => 'Nama tersebut sudah digunakan!',
                ]
            );
        }
        try {
            $total_harga = $request->input('harga_satuan') * $request->input('jumlah');
            $data = [
                'nama_barang' => $request->input('nama_barang'),
                'spesifikasi' => $request->input('spesifikasi'),
                'harga_satuan' => $request->input('harga_satuan'),
                'total_harga' => $total_harga,
                'jumlah' => $request->input('jumlah')
            ];
            $update_pengajuan_bb = PengajuanBBModel::where('id_pengajuan_bb', '=', $id)->update($data);
            if ($update_pengajuan_bb) {
                flash()->addSuccess('Data berhasil diubah.');
            }
            return redirect('pengajuan/BB');
        }
        // dd("berhasil", $upd);
        catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id = null)
    {
        try {
            $hapus = PengajuanBBModel::where('id_pengajuan_bb', $id, 'AND status_approval = "pending" ')
                ->delete();
            if ($hapus) {
                flash()->addSuccess('Data berhasil dihapus.');
                return redirect('pengajuan/BB');
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
