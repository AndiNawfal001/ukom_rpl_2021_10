<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Models\SupplierModel;

class SupplierController extends Controller
{
    public function index(){

        $data = SupplierModel::paginate(5);
        return view('supplier.index', compact('data'));
    }

    public function search(Request $request){
        $search = $request->input('search');

        $data = SupplierModel::where('nama','like',"%".$search."%")
                ->orWhere('kontak','like',"%".$search."%")
                ->orWhere('alamat','like',"%".$search."%")
                ->paginate(5);
        return view('supplier.index', compact('data'));
    }

    public function formTambah(){
        return view('supplier.formtambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'unique:supplier,nama',
            'kontak' => 'unique:supplier,kontak'
        ],
        [
            'nama.unique' => 'Nama tersebut sudah digunakan!',
            'kontak.unique' => 'Kontak tersebut sudah digunakan!',
        ]);
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
        if ($tambahSupplier){
            flash()->options([
                'timeout' => 3000, // seconds
                'position' => 'top-center',
            ])->addSuccess('Data berhasil disimpan.');
            return redirect('supplier');
        }else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

    public function update(Request $request )
    {
        try {
            // dd($request->all());
            $data = [
                'nama'   => $request->input('nama'),
                'kontak' => $request->input('kontak'),
                'alamat' => $request->input('alamat')
            ];
            SupplierModel::where('id_supplier', '=', $request->input('id_supplier'))->update($data);
            flash()->options([
                'timeout' => 3000, // seconds
                'position' => 'top-center',
            ])->addSuccess('Data berhasil diubah.');
            return redirect('supplier');

        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id=null){
        try{
            $hapus = SupplierModel::where('id_supplier',$id)->delete();
            if($hapus){
                flash()->options([
                'timeout' => 3000, // seconds
                'position' => 'top-center',
                ])->addSuccess('Data berhasil dihapus.');
                return back();
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }


}
