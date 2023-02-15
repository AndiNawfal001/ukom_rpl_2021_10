<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\SupplierModel;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $data = null;
        if ($request->has('search')) {
            $search = $request->input('search');

            $data = SupplierModel::where('nama', 'like', "%" . $search . "%")
                ->orWhere('kontak', 'like', "%" . $search . "%")
                ->orWhere('alamat', 'like', "%" . $search . "%")
                ->paginate(5);
        } else {
            $data = SupplierModel::paginate(5);
        }
        return view('supplier.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'unique:supplier,nama',
                'kontak' => 'unique:supplier,kontak'
            ],
            [
                'nama.unique' => 'Nama tersebut sudah digunakan!',
                'kontak.unique' => 'Kontak tersebut sudah digunakan!',
            ]
        );
        try {
            $dariFunction = DB::select('SELECT newIdSupplier() AS id_supplier');
            // dd($dariFunction);
            $array = Arr::pluck($dariFunction, 'id_supplier');
            $kode_baru = Arr::get($array, '0');
            // dd($kode_baru);
            $tambahSupplier = SupplierModel::insert([
                'id_supplier' => $kode_baru,
                'nama' => $request->input('nama'),
                'kontak' => $request->input('kontak'),
                'alamat' => $request->input('alamat')
            ]);
            if ($tambahSupplier) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('supplier');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function update(Request $request)
    {
        $supplier = SupplierModel::firstWhere('id_supplier', '=', $request->input('id_supplier'));

        if ($request->input('nama') !== $supplier->nama) {

            $request->validate(
                [
                    'nama' => 'unique:supplier,nama',
                ],
                [
                    'nama.unique' => 'Nama tersebut sudah digunakan!',
                ]
            );
        } elseif ($request->input('kontak') !== $supplier->kontak) {
            $request->validate(
                [
                    'kontak' => 'unique:supplier,kontak',
                ],
                [
                    'kontak.unique' => 'kontak tersebut sudah digunakan!',
                ]
            );
        }

        try {
            // dd($request->all());
            $data = [
                'nama'   => $request->input('nama'),
                'kontak' => $request->input('kontak'),
                'alamat' => $request->input('alamat')
            ];
            SupplierModel::where('id_supplier', '=', $request->input('id_supplier'))->update($data);
            flash()->addSuccess('Data berhasil diubah.');
            return redirect('supplier');
        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id = null)
    {
        try {
            $hapus = SupplierModel::where('id_supplier', $id)->delete();
            if ($hapus) {
                flash()->addSuccess('Data berhasil dihapus.');
                return back();
            }
        } catch (\Exception $e) {
            $e->getMessage();
        }
    }
}
