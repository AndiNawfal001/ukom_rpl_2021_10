<?php

namespace App\Http\Controllers;

use App\Models\{LevelUserModel, KaprogModel};
use Error;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KaprogController extends Controller
{
    //
    protected $KaprogModel;
    public function __construct()
    {
        $this->KaprogModel = new KaprogModel;
    }

    public function innerJoin(){
        $result = DB::table('pengguna')
        ->join('kaprog', 'pengguna.id_pengguna', '=', 'kaprog.id_pengguna')
        ->select('pengguna.username', 'kaprog.nama')
        ->get();
        return $this->KaprogModel->first()->pengguna;
    }

    private function getPengguna(): Collection
    {
        return DB::table('kaprog')
                ->select()
                ->join('pengguna', 'pengguna.id_pengguna', '=', 'kaprog.nip')
                // ->orderBy('pengguna.id_pengguna')
                ->get();
    }

    private function view_kaprog_username()
    {
        return DB::select('SELECT * FROM kaprog_username');
    }

    public function index()
    {
        //menampilkan seluruh data
        $kaprog = $this->view_kaprog_username();

        $data = [
            'title' => 'Daftar Kaprog',
            'Kaprog' => $kaprog
        ];

        return view('kaprog.index', $data);
        return view('pengguna.index', $data);
    }
    public function formTambah()
    {
        $pengguna = DB::table('pengguna')->select()->get();
        // compact('level') => ['level' => 'level']
        // ['level_user' => 'level']
        return view('kaprog.tambahform', compact('pengguna'));
    }
    public function simpan(Request $request)
    {
        try {
            $data = [
                'nip'  => $request->input('nip'),
                'nama'     => $request->input('nama'),
                'kontak'     => $request->input('kontak')
                // 'password'  => Hash::make($request->input('password')),
                // 'id_level'  => $request->input('id_level')
            ];
            //substr(hexdec(random_int(0,9999908)),4,-4);

            // $newIdPengguna = collect(DB::select('SELECT newIdPengguna() AS newIdPengguna'))->first()->newIdPengguna;
            // $data['id_pengguna'] = $newIdPengguna;



            //insert data ke database
            $insert = $this->KaprogModel->create($data);
            //Promise
            if ($insert) {
                //redirect('gudang','refresh');
                return redirect('User');
            } else {
                return "input data gagal";
            }
        } catch (Exception $e) {
            return $e->getMessage();
            //return "yaaah error nih, sorry ya";
        }
    }
}
