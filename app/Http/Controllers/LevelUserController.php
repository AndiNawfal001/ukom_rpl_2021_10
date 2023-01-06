<?php

namespace App\Http\Controllers;

use App\Models\LevelUserModel;
use Error;
use Exception;
use Illuminate\Http\Request;


class LevelUserController extends Controller
{
    //
    protected $LevelUserModel;
    public function __construct()
    {
        $this->LevelUserModel = new LevelUserModel;
    }
    public function index()
    {
        //menampilkan seluruh lokasi
        $data = [
            'title' => 'Daftar Level User',
            'levelUser' => $this->LevelUserModel->all()
        ];
        return view('levelUser.index', $data);
    }
    public function formTambah()
    {
        return view('levelUser.tambahform');
    }
    public function simpan(Request $request)
    {
        try {
            $data = [
                'nama_level' => $request->input('nama_level'),
                'ket'        => $request->input('ket')
            ];
            //substr(hexdec(random_int(0,9999908)),4,-4);

            $id_level = substr(md5(rand(0, 99999)), -4);
            $data['id_level'] = $id_level;
            // echo json_encode($data);
            //insert data ke database
            $insert = $this->LevelUserModel->create($data);
            //Promise
            if ($insert) {
                //redirect('gudang','refresh');
                return redirect('levelUser');
            } else {
                return "input data gagal";
            }
        } catch (Exception $e) {
            return $e->getMessage();
            //return "yaaah error nih, sorry ya";
        }
    }
}
