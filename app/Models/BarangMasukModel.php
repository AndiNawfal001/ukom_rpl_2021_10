<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BarangMasukModel extends Model
{
    use HasFactory;

    // nama table
    protected $table = 'barang_masuk';
    // nama PK
    protected $primaryKey = 'id_barang_masuk';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK integer AI
    public $incrementing = true;
    // PK bertipe char/string
    // protected $keyType = 'string';

    protected $fillable = ['id_pengajuan', 'supplier', 'adder', 'nama_barang', 'jml_masuk', 'tgl_masuk', 'status_pembelian'];

    public function PengajuanBB(): BelongsTo
    {
        return $this->belongsTo(PengajuanBBModel::class, 'id_pengajuan_bb', 'id_pengajuan');
    }

    public function Supplier(): BelongsTo
    {
        return $this->belongsTo(SupplierModel::class, 'id_supplier', 'supplier');
    }

    public function Pengguna(): BelongsTo
    {
        return $this->belongsTo(PenggunaModel::class, 'id_supplier', 'adder');
    }
}
