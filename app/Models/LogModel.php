<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    use HasFactory;

    // nama table
    protected $table = 'log';
    // nama PK
    protected $primaryKey = 'id_log';
    // agar timestamps tidak otomatis masuk
    public $timestamps = false;
    // PK bukan integer AI
    public $incrementing = false;
    // PK bertipe char/string
    protected $keyType = 'string';


    protected $fillable = ['username','aktifitas','tgl'];

    // public function pengguna(){
    //     return $this->belongsTo(PenggunaModel::class, 'id_pengguna', 'id_pengguna');
    // }
}
