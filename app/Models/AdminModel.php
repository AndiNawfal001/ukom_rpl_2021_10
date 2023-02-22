<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Model
{
    use HasFactory;

    protected $table = 'admin';
    // nama PK
    protected $primaryKey = 'id_admin';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    // public $incrementing = false;
    // PK bertipe char/string
    // protected $keyType = 'string';

    protected $fillable = ['id_pengguna', 'nama', 'kontak'];

    public function Pengguna()
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    }
}
