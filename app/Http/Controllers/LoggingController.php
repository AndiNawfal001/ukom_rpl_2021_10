<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoggingController extends Controller
{
    //
    public function index()
    {
        $data = DB::select('SELECT * FROM log');
        return view('logging.index', compact('data'));
    }
}
