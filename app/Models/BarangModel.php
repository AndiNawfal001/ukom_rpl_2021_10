<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'barang';
    // nama PK
    protected $primaryKey = 'id_barang';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = ['id_jenis_brg', 'nama_barang', 'jml_barang'];

    public function jenis_barang(): BelongsTo
    {
        return $this->belongsTo(JenisBarangModel::class, 'id_jenis_brg', 'id_jenis_brg');
    }

    public function KodeBarang(): HasMany
    {
        return $this->hasMany(DetailBarangModel::class, 'kode_barang', 'id_barang');
    }
}
