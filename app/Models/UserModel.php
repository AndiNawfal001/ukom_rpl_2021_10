<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $table = 'pengguna';
    protected $softDelete = false;
    public $timestamps = false;
    protected $primaryKey = 'id_pengguna';
    public $incrementing = false;
    public $keyType = 'string';
    protected $fillable = ['username','email','password'];
}
