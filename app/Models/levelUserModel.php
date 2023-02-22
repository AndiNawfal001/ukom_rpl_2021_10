<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LevelUserModel extends Model
{
    use HasFactory;
    protected $table = 'level_user';
    public $timestamps = false;
    protected $primaryKey = 'id_level';
    protected $fillable = ['id_level', 'nama_level', 'ket'];

    public function pengguna(): HasMany
    {
        return $this->hasMany(User::class, 'id_level', 'id_level');
    }
}
