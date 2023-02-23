<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManajemenModel extends Model
{
    use HasFactory;

    protected $table = 'manajemen';
    // nama PK
    protected $primaryKey = 'nip';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';

    protected $fillable = ['nip', 'id_pengguna', 'nama', 'kontak'];

    public function Pengguna()
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    }
}
