<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenggunaModel extends Model
{
    use HasFactory;
    protected $table = 'pengguna';
    public $timestamps = false;
    protected $primaryKey = 'id_pengguna';
     protected $fillable = ['username','email','password', 'id_pengguna', 'id_level'];

    public function level_user(){
        //bikin relasi antar table ambil function untuk dipanggil kembali ke halaman yang membutuhkan 

        //relasi belongsto itu dari one to manay
        return $this->belongsTo(levelUserModel::class, 'id_level', 'id_level');
    }

   

    public function kaprog(){
        return $this->hasMany(KaprogModel::class, 'nip', 'id_level');
    }

}
