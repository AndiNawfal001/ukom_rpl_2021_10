<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BarangController extends Controller
{
    //
    public function index(){

        $data = DB::table('barang')
        ->join('jenis_barang', 'barang.id_jenis_brg', '=', 'jenis_barang.id_jenis_brg')
        ->orderBy('id_barang')
        ->select('jenis_barang.nama_jenis', 'barang.*')
        ->paginate(10);

        return view('barang.index', compact('data'));
    }

    public function detail($id=null){
        // dd($id);
        $data = DB::table('detail_barang')
            ->where('id_barang',$id)
            ->paginate(10);

        // dd($data);
        return view('barang.detail', compact('data'));
    }
}
