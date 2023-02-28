<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Laravolt\Avatar\Facade as Avatar;

use App\Models\LevelUserModel;
use App\Models\PenggunaModel;
use App\Models\AdminModel;
use App\Models\ManajemenModel;
use App\Models\KaprogModel;



class PenggunaController extends Controller
{

    public function index(Request $request)
    {
        $data = null;
        if ($request->has('search')) {
            $search = $request->input('search');
            $data = DB::table('pengguna_admin_manajemen_kaprog')
                ->where('username', 'like', "%" . $search . "%")
                ->orWhere('email', 'like', "%" . $search . "%")
                ->orWhere('nama_level', 'like', "%" . $search . "%")
                ->orderBy('id_level')
                ->paginate(10);
        } else {
            $data = DB::table('pengguna_admin_manajemen_kaprog')
                ->paginate(10);
            // dd($data);
        }
        // dd($data);

        return view('pengguna.index', compact('data'));
    }

    private function getlevelUser(): Collection
    {
        return collect(LevelUserModel::get());
    }

    public function formTambah()
    {
        $levelUser = $this->getlevelUser();

        return view('pengguna.formtambah', compact('levelUser'));
    }

    public function store(Request $request)
    {
        if ($request->input('levelUser') !== 'admin') {
            $request->validate(
                [
                    'nip' => 'required|min:18|max:18',
                ],
                [
                    'nip.max' => 'NIP tidak boleh lebih dari 18 karakter!',
                    'nip.min' => 'NIP tidak boleh kurang dari 18 karakter!',
                    'nip.required' => 'NIP harus diisi'
                ]
            );
        } else {
            $request->validate(
                [
                    'username' => 'unique:pengguna,username',
                    'email' => ['email:dns', 'unique:pengguna,email'],
                ],
                [
                    'username.unique' => 'Username tersebut sudah digunakan!',
                    'email.unique' => 'Email tersebut sudah digunakan!',
                ]
            );
        }

        try {
            if ($request->file('image') == null) {
                $image = 'pengguna/' . $request->input('username') . '.png';
                Avatar::create($request->input('username'))->save('storage/pengguna/' . $request->input('username') . '.png');
            } else {
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

            if ($tambahUser) {
                flash()->addSuccess('Data berhasil disimpan.');
                return redirect('pengguna');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    private function getPenggunaAdmin($id)
    {
        return collect(AdminModel::join('pengguna', 'admin.id_pengguna', '=', 'pengguna.id_pengguna')
            ->select('admin.*', 'pengguna.*')
            ->where('pengguna.id_pengguna', $id)
            ->get())->firstOrFail();
    }

    private function getPenggunaManajemen($id)
    {
        return collect(ManajemenModel::join('pengguna', 'manajemen.id_pengguna', '=', 'pengguna.id_pengguna')
            ->select('manajemen.*', 'pengguna.*')
            ->where('pengguna.id_pengguna', $id)
            ->get())->firstOrFail();
    }

    private function getPenggunaKaprog($id)
    {
        return collect(KaprogModel::join('pengguna', 'kaprog.id_pengguna', '=', 'pengguna.id_pengguna')
            ->select('kaprog.*', 'pengguna.*')
            ->where('pengguna.id_pengguna', $id)
            ->get())->firstOrFail();
    }

    public function edit($id = null)
    {
        // dd($id);
        $admin = AdminModel::select('id_pengguna')->where('id_pengguna', $id)->count();
        $manajemen = ManajemenModel::select('id_pengguna')->where('id_pengguna', $id)->count();
        $kaprog = KaprogModel::select('id_pengguna')->where('id_pengguna', $id)->count();
        // dd($manajemen);
        if ($manajemen == 1) {
            $edit = $this->getPenggunaManajemen($id);
        } elseif ($admin == 1) {
            $edit = $this->getPenggunaAdmin($id);
        } elseif ($kaprog == 1) {
            $edit = $this->getPenggunaKaprog($id);
        }
        // $edit = $this->getPenggunaAdmin(1);

        return view('pengguna.editform', compact('edit'));
    }

    public function editsimpan(Request $request)
    {
        try {
            // dd($request->all());
            if ($request->file('image') == null) {
                $updateUser = DB::update("CALL update_user(:kode, :username, :email, :nama, :kontak, :foto)", [
                    'kode' => $request->input('kode'),
                    'username' => $request->input('username'),
                    'email' => $request->input('email'),
                    'nama' => $request->input('nama'),
                    'kontak' => $request->input('kontak'),
                    'foto' => $request->oldImage,
                ]);
            } else {
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
            if ($updateUser) {
                flash()->addSuccess('Data berhasil diubah.');
                return redirect('pengguna');
            } else
                return "input data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function hapus($id = null)
    {
        try {
            $foto = PenggunaModel::where('id_pengguna', $id)->first()->foto;
            Storage::delete($foto); //HAPUS FILE DI STORAGE
            $deleteUser = DB::delete("CALL delete_user(:kode)", [
                'kode' => $id
            ]);
            if ($deleteUser) {
                flash()->addSuccess('Data berhasil dihapus.');
                return redirect('pengguna');
            } else
                return "delete data gagal";
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }
}
