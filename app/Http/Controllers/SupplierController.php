<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;


class SupplierController extends Controller
{
    public function index(){
        $data = DB::table('supplier')->paginate(5);
        return view('supplier.index', compact('data'));
    }

    public function search(Request $request){
        $search = $request->input('search');

        $data = DB::table('supplier')
                ->where('nama','like',"%".$search."%")
                ->orWhere('kontak','like',"%".$search."%")
                ->orWhere('alamat','like',"%".$search."%")
                ->paginate(5);
        return view('supplier.index', compact('data'));
    }

    public function formTambah(){
        // dd($data);
        return view('supplier.formtambah');
    }

    private function getSupplier($id)
    {
        return collect(DB::select('SELECT * FROM supplier WHERE id_supplier = ?', [$id]))->firstOrFail();
    }

    public function store(Request $request)
    {
        try {
        $dariFunction = DB::select('SELECT newIdSupplier() AS id_supplier');
        // dd($dariFunction);
        $array = Arr::pluck($dariFunction, 'id_supplier');
        $kode_baru = Arr::get($array, '0');
        // dd($kode_baru);
        $tambahSupplier = DB::table('supplier')->insert([
            'id_supplier' => $kode_baru,
            'nama' => $request->input('nama'),
            'kontak' => $request->input('kontak'),
            'alamat' => $request->input('alamat')
        ]);
        if ($tambahSupplier)
            return redirect('supplier');
        else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

    public function edit($id = null)
    {

        $edit = $this->getSupplier($id);

        return view('supplier.editform', compact('edit'));
    }

    public function editsimpan(Request $request)
    {
        try {
            $data = [
                // 'nama'   => $request->input('nama'),
                'kontak' => $request->input('kontak'),
                'alamat' => $request->input('alamat')
            ];
            DB::table('supplier')
                        ->where('id_supplier', '=', $request->input('id_supplier'))
                        ->update($data);
            return redirect('supplier');

            // dd("berhasi", $upd);
        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapus($id=null){
        try{
            $hapus = DB::table('supplier')
                            ->where('id_supplier',$id)
                            ->delete();
            if($hapus){
                return redirect('supplier');
            }
        }catch(\Exception $e){
            $e->getMessage();
        }
    }


}
