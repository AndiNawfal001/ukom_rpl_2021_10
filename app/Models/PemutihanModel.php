<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PemutihanModel extends Model
{
    use HasFactory;

    protected $table = 'pemutihan';
    // nama PK
    protected $primaryKey = 'id_pemutihan';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = ['id_perbaikan', 'approver', 'kode_barang', 'submitter', 'tgl_pemutihan', 'ket_pemutihan', 'foto_kondisi_terakhir', 'approve_penonaktifan', 'tgl_approve'];

    public function Perbaikan(): BelongsTo
    {
        return $this->belongsTo(PerbaikanModel::class, 'id_perbaikan', 'id_perbaikan');
    }

    public function Pengguna_approver(): BelongsTo
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'approver');
    }

    public function Pengguna_submitter(): BelongsTo
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'submitter');
    }

    public function KodeBarang(): BelongsTo
    {
        return $this->belongsTo(DetailBarangModel::class, 'kode_barang', 'kode_barang');
    }
}
