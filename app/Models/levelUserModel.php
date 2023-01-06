<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelUserModel extends Model
{
    use HasFactory;
    protected $table = 'level_user';
    public $timestamps = false;
    protected $primaryKey = 'id_level';
    protected $fillable = ['id_level','nama_level','ket'];

    public function pengguna(){

        // kalo relasi hasmany itu satu table memiliki one to many
        return $this->hasMany(User::class, 'id_level', 'id_level');
    }

}

//         return $this->hasMany(PenggunaModel::class, 'id_level', 'id_level');
//     }

// }

