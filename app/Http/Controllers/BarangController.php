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

    public function search(Request $request){
        $search = $request->input('search');
        $data = DB::table('barang')
        ->join('jenis_barang', 'barang.id_jenis_brg', '=', 'jenis_barang.id_jenis_brg')
        ->orderBy('id_barang')
        ->select('jenis_barang.nama_jenis', 'barang.*')
        ->where('nama_jenis','like',"%".$search."%")
        ->orWhere('nama_barang','like',"%".$search."%")
        ->paginate(10);

        return view('barang.index', compact('data'));
    }

    public function detail($id=null){
        $id_barang = $id;
        // dd('p');
        $data = DB::table('detail_barang')
            ->where('id_barang',$id)
            ->paginate(10);

        // dd($data);
        return view('barang.detail', compact('id_barang','data'));
    }
    public function searchdetail(Request $request, $id=null){
        // dd($id);
        $id_barang = $id;
        $search = $request->input('search');

        $data = DB::table('detail_barang')
            ->where('id_barang',$id)
            ->where('kode_barang','like',"%".$search."%")
            ->orWhere('kondisi_barang','like',"%".$search."%")
            ->orWhere('status','like',"%".$search."%")
            ->paginate(10);

        // dd($data);
        return view('barang.detail', compact('id_barang','data'));
    }
}
