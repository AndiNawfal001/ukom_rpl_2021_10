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
        ->paginate(10);

        $admin = DB::table('admin')
        ->join('pengguna', 'admin.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('admin.*', 'pengguna.*')
        ->get();

        $manajemen = DB::table('manajemen')
        ->join('pengguna', 'manajemen.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('manajemen.*', 'pengguna.*')
        ->get();

        $kaprog = DB::table('kaprog')
        ->join('pengguna', 'kaprog.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('kaprog.*', 'pengguna.*')
        ->get();

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

    //
    // ADMIN
    //


    private function getPenggunaAdmin($id)
    {
        return collect(DB::table('admin')
        ->join('pengguna', 'admin.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('admin.*', 'pengguna.*')
        ->where('id_admin', $id)
        ->get())->firstOrFail();
    }

    public function editAdmin($id = null )
    {
        $edit = $this->getPenggunaAdmin($id);
        return view('pengguna.editformAdmin', compact('edit'));
    }

    public function editsimpanAdmin(Request $request)
    {
        try {
            $pengguna = [
                'username'   => $request->input('username'),
                'email' => $request->input('email'),
            ];
            $admin = [
                'nama'   => $request->input('nama'),
                'kontak' => $request->input('kontak'),
            ];
            DB::table('pengguna')
                        ->where('id_pengguna', '=', $request->input('id_pengguna'))
                        ->update($pengguna);

            DB::table('admin')
                        ->where('id_admin', '=', $request->input('id_admin'))
                        ->update($admin);

            return redirect('pengguna');

        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapusAdmin($pengguna=null, $admin=null){
        try{

             DB::table('pengguna')
                            ->where('id_pengguna',$pengguna)
                            ->delete();

             DB::table('admin')
                            ->where('id_admin',$admin)
                            ->delete();

            // dd($pengguna);

            return redirect('pengguna');

        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    //
    // MANAJEMEN
    //


    private function Manajemen($id)
    {
        return collect(DB::table('manajemen')
        ->join('pengguna', 'manajemen.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('manajemen.*', 'pengguna.*')
        ->where('nip', $id)
        ->get())->firstOrFail();
    }

    public function editManajemen($id = null )
    {
        $edit = $this->Manajemen($id);
        return view('pengguna.editformManajemen', compact('edit'));
    }

    public function editsimpanManajemen(Request $request)
    {
        try {
            // dd($request->all());

            $pengguna = [
                'username'   => $request->input('username'),
                'email' => $request->input('email'),
            ];
            $manajemen = [
                'nama'   => $request->input('nama'),
                'kontak' => $request->input('kontak'),
            ];
            // dd($request->all());

            DB::table('pengguna')
                        ->where('id_pengguna', '=', $request->input('id_pengguna'))
                        ->update($pengguna);
            DB::table('manajemen')
                        ->where('nip', '=', $request->input('nip'))
                        ->update($manajemen);

            return redirect('pengguna');


        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapusManajemen($pengguna=null, $manajemen=null){
        try{

             DB::table('pengguna')
                            ->where('id_pengguna',$pengguna)
                            ->delete();

             DB::table('manajemen')
                            ->where('nip',$manajemen)
                            ->delete();

            return redirect('pengguna');

        }catch(\Exception $e){
            $e->getMessage();
        }
    }

    //
    // KAPROG
    //


    private function Kaprog($id)
    {
        return collect(DB::table('kaprog')
        ->join('pengguna', 'kaprog.id_pengguna', '=', 'pengguna.id_pengguna')
        ->select('kaprog.*', 'pengguna.*')
        ->where('nip', $id)
        ->get())->firstOrFail();
    }

    public function editKaprog($id = null )
    {
        $edit = $this->Kaprog($id);
        return view('pengguna.editformKaprog', compact('edit'));
    }

    public function editsimpanKaprog(Request $request)
    {
        try {
            $pengguna = [
                'username'   => $request->input('username'),
                'email' => $request->input('email'),
            ];
            $kaprog = [
                'nama'   => $request->input('nama'),
                'kontak' => $request->input('kontak'),
            ];
            // dd($request->all());

            DB::table('pengguna')
                        ->where('id_pengguna', '=', $request->input('id_pengguna'))
                        ->update($pengguna);
            DB::table('kaprog')
                        ->where('nip', '=', $request->input('nip'))
                        ->update($kaprog);

            return redirect('pengguna');


        } catch (\Exception $e) {
            return $e->getMessage();
            dd("gagal");
        }
    }

    public function hapusKaprog($pengguna=null, $kaprog=null){
        try{

             DB::table('pengguna')
                            ->where('id_pengguna',$pengguna)
                            ->delete();

             DB::table('kaprog')
                            ->where('nip',$kaprog)
                            ->delete();

            return redirect('pengguna');

        }catch(\Exception $e){
            $e->getMessage();
        }
    }
}
