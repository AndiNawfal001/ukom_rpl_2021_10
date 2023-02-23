<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelUserModel extends Model
{
    use HasFactory;
    protected $table = 'level_user';
    // nama PK
    protected $primaryKey = 'id_level';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';

    protected $fillable = ['id_level', 'nama_level', 'ket'];

    public function pengguna(): HasMany
    {
        return $this->hasMany(PenggunaModel::class, 'id_level', 'id_level');
    }
}
