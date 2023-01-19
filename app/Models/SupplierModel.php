<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    use HasFactory;

    // nama table
    protected $table = 'supplier';
    // nama PK
    protected $primaryKey = 'id_supplier';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';

    protected $fillable = ['id_supplier','nama','kontak','alamat'];

    // public function pengguna(){
    //     return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    // }
}
