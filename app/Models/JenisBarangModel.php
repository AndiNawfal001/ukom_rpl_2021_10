<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class JenisBarangModel extends Model
{
    use HasFactory;

    protected $table = 'jenis_barang';
    // nama PK
    protected $primaryKey = 'id_jenis_brg';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';

    protected $fillable = ['id_jenis_brg', 'nama_jenis'];

    public function Barang(): HasMany
    {
        return $this->hasMany(BarangModel::class, 'id_barang', 'id_jenis_brg');
    }
}
