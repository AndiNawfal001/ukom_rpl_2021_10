<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


class PenggunaController extends Controller
{
    public function index(){
        $data = DB::table('banyak_pengguna')
        ->select('*')
        ->orderBy('id_level')
        ->paginate(5);

        $admin = DB::table('admin')->count();
        $manajemen = DB::table('manajemen')->count();
        $kaprog = DB::table('kaprog')->count();

        return view('pengguna.index', compact('data', 'admin', 'manajemen', 'kaprog'));
    }

    private function getlevelUser(): Collection
    {
        return collect(DB::select('SELECT * FROM level_user'));
    }

    public function formTambah(){
        $levelUser = $this->getlevelUser();

        return view('pengguna.formtambah', compact('levelUser'));
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $tambahUser = DB::insert("CALL tambah_user(:username, :levelUser, :email, :password, :nip, :nama, :kontak)", [
                'username' => $request->input('username'),
                'levelUser' => $request->input('levelUser'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'nip' => $request->input('nip'),
                'nama' => $request->input('nama'),
                'kontak' => $request->input('kontak'),
            ]);

        if ($tambahUser)
            return redirect('pengguna');
        else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

    private function getPenggunaAdmin($id)
    {
        return collect(DB::table('admin')
        ->join('pengguna', 'admin.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('admin.*', 'pengguna.*')
        ->where('pengguna.id_pengguna', $id)
        ->get())->firstOrFail();
    }

    private function getPenggunaManajemen($id)
    {
        return collect(DB::table('manajemen')
        ->join('pengguna', 'manajemen.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('manajemen.*', 'pengguna.*')
        ->where('pengguna.id_pengguna', $id)
        ->get())->firstOrFail();
    }

    private function getPenggunaKaprog($id)
    {
        return collect(DB::table('kaprog')
        ->join('pengguna', 'kaprog.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('kaprog.*', 'pengguna.*')
        ->where('pengguna.id_pengguna', $id)
        ->get())->firstOrFail();
    }

    public function edit($id = null )
    {
        // dd($id);
        $admin = DB::table('admin')->select('id_pengguna')->where('id_pengguna', $id)->count();
        $manajemen = DB::table('manajemen')->select('id_pengguna')->where('id_pengguna', $id)->count();
        $kaprog = DB::table('kaprog')->select('id_pengguna')->where('id_pengguna', $id)->count();
        // dd($manajemen);
        if ($manajemen == 1) {
            $edit = $this->getPenggunaManajemen($id);
        }elseif($admin == 1){
            $edit = $this->getPenggunaAdmin($id);
        }elseif($kaprog == 1){
            $edit = $this->getPenggunaKaprog($id);
        }
        // $edit = $this->getPenggunaAdmin(1);

        return view('pengguna.editform', compact('edit'));
    }

    public function editsimpan(Request $request)
    {
        try {
            // dd($request->all());
            $updateUser = DB::update("CALL update_user(:kode, :username, :email, :nama, :kontak)", [
                'kode' => $request->input('kode'),
                'username' => $request->input('username'),
                'email' => $request->input('email'),
                'nama' => $request->input('nama'),
                'kontak' => $request->input('kontak'),
            ]);

        if ($updateUser)
            return redirect('pengguna');
        else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

    public function hapus($id=null){
        try {
            // dd($id);
            $deleteUser = DB::delete("CALL delete_user(:kode)", [
                'kode' => $id
            ]);

        if ($deleteUser)
            return redirect('pengguna');
        else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

}
