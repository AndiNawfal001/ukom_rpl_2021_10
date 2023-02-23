<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailBarangModel extends Model
{
    use HasFactory;

    protected $table = 'detail_barang';
    // nama PK
    protected $primaryKey = 'kode_barang';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';

    protected $fillable = ['kode_barang', 'id_barang', 'spesifikasi', 'kondisi_barang', 'status', 'foto_barang', 'ruangan'];

    public function Barang(): BelongsTo
    {
        return $this->belongsTo(BarangModel::class, 'id_barang', 'id_barang');
    }

    public function Pemutihan(): HasMany
    {
        return $this->hasMany(PemutihanModel::class, 'kode_barang', 'kode_barang');
    }

    public function Perawatan(): HasMany
    {
        return $this->hasMany(PerawatanModel::class, 'kode_barang', 'kode_barang');
    }

    public function Perbaikan(): HasMany
    {
        return $this->hasMany(PerbaikanModel::class, 'kode_barang', 'kode_barang');
    }

    public function Ruangan(): BelongsTo
    {
        return $this->BelongsTo(RuanganModel::class, 'id_ruangan', 'ruangan');
    }
}
