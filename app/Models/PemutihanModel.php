<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PemutihanModel extends Model
{
    use HasFactory;

    // nama table
    protected $table = 'pemutihan';
    // nama PK
    protected $primaryKey = 'id_pemutihan';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = true;
    // PK bertipe char/string
    // protected $keyType = 'string';

    protected $fillable = ['id_perbaikan', 'approver','kode_barang','submitter', 'tgl_pemutihan', 'approve_penonaktifan', 'tgl_approve'];

    public function Pengguna_approver(): BelongsTo {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'approver');
    }

    public function Pengguna_submitter(): BelongsTo {
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'submitter');
    }

    public function DetailBarang(): HasMany {
        return $this->hasMany(DetailBarangModel::class, 'kode_barang', 'kode_barang');
    }
}
