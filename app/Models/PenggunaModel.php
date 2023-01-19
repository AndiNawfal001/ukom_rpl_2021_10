<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PenggunaModel extends Model
{
    use HasFactory;

    // nama table
    protected $table = 'pengguna';
    // nama PK
    protected $primaryKey = 'id_pengguna';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    // public $incrementing = false;
    // PK bertipe char/string
    // protected $keyType = 'string';

    protected $fillable = ['id_level','username', 'email', 'password'];

    public function level_user(): BelongsTo {
        return $this->belongsTo(LevelUser::class, 'id_level', 'id_level');
    }

    public function Kaprog(): HasMany {
        return $this->hasMany(KaprogModel::class, 'id_pengguna', 'id_pengguna');
    }

    public function Admin(): HasMany {
        return $this->hasMany(AdminModel::class, 'id_pengguna', 'id_pengguna');
    }

    public function Manajemen(): HasMany {
        return $this->hasMany(Manajemen::class, 'id_pengguna', 'id_pengguna');
    }

    public function BarangMasuk(): HasMany {
        return $this->hasMany(BarangMasukModel::class, 'adder', 'id_pengguna');
    }

    public function PengajuanBB_approver(): HasMany {
        return $this->hasMany(PengajuanBBModel::class, 'approver', 'id_pengguna');
    }

    public function PengajuanBB_submitter(): HasMany {
        return $this->hasMany(PengajuanBBModel::class, 'submitter', 'id_pengguna');
    }

    public function Pemutihan_approver(): HasMany {
        return $this->hasMany(PemutihanModel::class, 'approver', 'id_pengguna');
    }

    public function Pemutihan_submitter(): HasMany {
        return $this->hasMany(PemutihanModel::class, 'submitter', 'id_pengguna');
    }

    public function Perbaikan_approver(): HasMany {
        return $this->hasMany(PerbaikanModel::class, 'approver', 'id_pengguna');
    }

    public function Perbaikan_submitter(): HasMany {
        return $this->hasMany(PerbaikanModel::class, 'submitter', 'id_pengguna');
    }
}
