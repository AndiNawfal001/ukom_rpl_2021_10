<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerawatanModel extends Model
{
    use HasFactory;

    // nama table
    protected $table = 'perawatan';
    // nama PK
    protected $primaryKey = 'id_perawatan';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';

    protected $fillable = ['id_perawatan','kode_barang','nama_pelaksana','ket_perawatan', 'foto_perawatan', 'tgl_perawatan'];

    public function kode_barang(){
        return $this->belongsTo(DetailBarangModel::class, 'kode_barang', 'kode_barang');
    }
}
