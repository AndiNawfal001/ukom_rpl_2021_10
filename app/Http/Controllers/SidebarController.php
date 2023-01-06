<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class SidebarController extends Controller
{
    // public function index(){
    //     $pemutihanKaprog = DB::table('perbaikan')->where('approve_perbaikan', '=', 'rusak')->count();
    //     return view('partials.sidebar', compact('pemutihanKaprog'));
    // }
}
