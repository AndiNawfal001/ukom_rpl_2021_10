<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaprogModel extends Model
{
    use HasFactory;

    protected $table = 'kaprog';
    public $timestamps = false;
    protected $primaryKey = 'nip';
    protected $fillable = ['nip','nama','kontak'];

    public function pengguna(){
        return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    }
}
