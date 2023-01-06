<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    private function getJenisBarang(): Collection
    {
        return collect(DB::select('SELECT * FROM jenis_barang'));
    }

    public function index()
    {
        $jenisBarang = $this->getJenisBarang();
        return view('barang.formtambah', compact('jenisBarang'));
    }
}
