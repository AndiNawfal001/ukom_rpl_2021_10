<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class JenisBarangController extends Controller
{
    public function index()
    {
        $data = DB::select('SELECT * FROM log');
        return view('logging.index', compact('data'));
    }
}
