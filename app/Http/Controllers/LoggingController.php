<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LogModel;

class LoggingController extends Controller
{
    //
    public function index()
    {
        $data = LogModel::orderByDesc('id_log')->paginate(10);
        return view('logging.index', compact('data'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');

        $data = LogModel::where('username','like',"%".$search."%")
                ->orWhere('aktifitas','like',"%".$search."%")
                ->orWhere('id_log','like',"%".$search."%")
                ->orWhere('tgl','like',"%".$search."%")
                ->orderByDesc('id_log')
                ->paginate(10);
        return view('logging.index', compact('data'));
    }
}
