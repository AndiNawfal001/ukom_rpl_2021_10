<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Laravolt\Avatar\Facade as Avatar;

class PenggunaController extends Controller
{

    public function index(){
        $data = DB::table('pengguna')
        ->select('pengguna.*', 'level_user.nama_level', 'admin.nama as admin', 'manajemen.nama as manajemen', 'kaprog.nama as kaprog' )
        ->leftJoin('level_user', 'pengguna.id_level', '=', 'level_user.id_level')
        ->leftJoin('admin','pengguna.id_pengguna', '=', 'admin.id_pengguna')
        ->leftJoin('manajemen','pengguna.id_pengguna', '=', 'manajemen.id_pengguna')
        ->leftJoin('kaprog','pengguna.id_pengguna', '=', 'kaprog.id_pengguna')
        ->orderBy('id_level')
        ->paginate(5);
        // dd($data);
        $admin = DB::table('admin')->count();
        $manajemen = DB::table('manajemen')->count();
        $kaprog = DB::table('kaprog')->count();

        return view('pengguna.index', compact('data', 'admin', 'manajemen', 'kaprog' ));
    }

    public function search(Request $request){
        $search = $request->input('search');

        // $data = DB::table('banyak_pengguna')
        // ->select('*')
        // ->where('username','like',"%".$search."%")
        // ->orWhere('email','like',"%".$search."%")
        // ->orWhere('nama_level','like',"%".$search."%")
        // ->orderBy('id_level')
        // ->paginate(5);
        $data = DB::table('pengguna')
        ->select('pengguna.*', 'level_user.nama_level', 'admin.nama as admin', 'manajemen.nama as manajemen', 'kaprog.nama as kaprog' )
        ->leftJoin('level_user', 'pengguna.id_level', '=', 'level_user.id_level')
        ->leftJoin('admin','pengguna.id_pengguna', '=', 'admin.id_pengguna')
        ->leftJoin('manajemen','pengguna.id_pengguna', '=', 'manajemen.id_pengguna')
        ->leftJoin('kaprog','pengguna.id_pengguna', '=', 'kaprog.id_pengguna')
        ->where('pengguna.username','like',"%".$search."%")
        ->orWhere('pengguna.email','like',"%".$search."%")
        ->orWhere('level_user.nama_level','like',"%".$search."%")
        ->orderBy('level_user.id_level')
        ->paginate(5);

        $admin = DB::table('admin')->count();
        $manajemen = DB::table('manajemen')->count();
        $kaprog = DB::table('kaprog')->count();
        return view('pengguna.index', compact('data', 'admin', 'manajemen', 'kaprog' ));
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
        $request->validate([
            'username' => 'unique:pengguna,username',
            'email' => ['email:dns','unique:pengguna,email'],
            'nip' => 'max:18',
        ],
        [
            'username.unique' => 'Username tersebut sudah digunakan!',
            'email.unique' => 'Email tersebut sudah digunakan!',
            'nip.max' => 'Tidak boleh lebih dari 18 karakter!',
        ]) ;
        try {
            if($request->file('image') == null){
                $image = 'pengguna/'.$request->input('username').'.png';
                Avatar::create($request->input('username'))->save('storage/pengguna/'.$request->input('username').'.png');
            }else{
                $image = $request->file('image')->store('pengguna');
            }

            // dd($request->all());
            $tambahUser = DB::insert("CALL tambah_user(:username, :levelUser, :email, :password, :nip, :nama, :kontak, :foto)", [
                'username' => $request->input('username'),
                'levelUser' => $request->input('levelUser'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'nip' => $request->input('nip'),
                'nama' => $request->input('nama'),
                'kontak' => $request->input('kontak'),
                'foto' => $image,
            ]);

        if ($tambahUser){
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Data berhasil disimpan.');
            return redirect('pengguna');
        }else
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
            if($request->file('image') == null){
                $updateUser = DB::update("CALL update_user(:kode, :username, :email, :nama, :kontak, :foto)", [
                    'kode' => $request->input('kode'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'nama' => $request->input('nama'),
                    'kontak' => $request->input('kontak'),
                    'foto' => $request->oldImage,
                ]);
            }else{
                $image = $request->file('image')->store('pengguna');
                $updateUser = DB::update("CALL update_user(:kode, :username, :email, :nama, :kontak, :foto)", [
                    'kode' => $request->input('kode'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'nama' => $request->input('nama'),
                    'kontak' => $request->input('kontak'),
                    'foto' => $image,
                ]);
                Storage::delete($request->oldImage);

            }
        if ($updateUser){
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Data berhasil diubah.');
            return redirect('pengguna');
        }else
            return "input data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

    public function hapus($id=null){
        try {
            // dd($id);
            $x = DB::table('pengguna')->where('id_pengguna', $id)->get();
            $flattened = Arr::pluck($x, 'foto');
            $price = Arr::get($flattened, '0');
            // dd($price);
            Storage::delete($price); //HAPUS FILE DI STORAGE
            $deleteUser = DB::delete("CALL delete_user(:kode)", [
                'kode' => $id
            ]);
        if ($deleteUser){
            flash()->options([
                'timeout' => 3000, // 3 seconds
                'position' => 'top-center',
            ])->addSuccess('Data berhasil dihapus.');
            return redirect('pengguna');
        }else
            return "delete data gagal";
        } catch (\Exception $e) {
        return  $e->getMessage();
        }
    }

}
