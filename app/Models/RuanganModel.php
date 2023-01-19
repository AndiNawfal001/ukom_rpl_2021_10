<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RuanganModel extends Model
{
    use HasFactory;

    // nama table
    protected $table = 'ruangan';
    // nama PK
    protected $primaryKey = 'id_ruangan';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';


    protected $fillable = ['id_ruangan','nama_ruangan','penanggung_jawab','ket'];

    // public function pengguna(){
    //     return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    // }
}
