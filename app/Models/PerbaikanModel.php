<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerbaikanModel extends Model
{
    use HasFactory;

    protected $table = 'perbaikan';
    // nama PK
    protected $primaryKey = 'id_perbaikan';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';

    protected $fillable = ['id_perbaikan', 'kode_barang', 'approver', 'submitter', 'keluhan', 'tgl_perbaikan', 'nama_teknisi', 'penyebab_keluhan', 'status_perbaikan', 'solusi_barang', 'tgl_selesai_perbaikan', 'approve_perbaikan', 'tgl_approve'];

    public function Pemutihan(): HasMany
    {
        return $this->hasMany(PemutihanModel::class, 'id_perbaikan', 'id_perbaikan');
    }

    public function KodeBarang(): BelongsTo
    {
        return $this->belongsTo(DetailBarangModel::class, 'kode_barang', 'kode_barang');
    }

    public function Pengguna_approver(): BelongsTo
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'approver');
    }

    public function Pengguna_submitter(): BelongsTo
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'submitter');
    }
}
