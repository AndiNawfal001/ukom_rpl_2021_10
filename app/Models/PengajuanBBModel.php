<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PengajuanBBModel extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_bb';
    // nama PK
    protected $primaryKey = 'id_pengajuan_bb';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;

    protected $fillable = ['approver', 'submitter', 'nama_barang', 'spesifikasi', 'harga_satuan', 'total_harga', 'jumlah', 'tgl', 'ruangan', 'status_approval', 'tgl_approve', 'status_pembelian'];

    public function Pengguna_approver(): BelongsTo
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'approver');
    }

    public function Pengguna_submitter(): BelongsTo
    {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'submitter');
    }

    public function BarangMasuk(): HasMany
    {
        return $this->hasMany(BarangMasukModel::class, 'id_pengajuan', 'id_pengajuan_bb');
    }

    public function Ruangan(): BelongsTo
    {
        return $this->belongsTo(RuanganModel::class, 'id_ruangan', 'ruangan');
    }
}
