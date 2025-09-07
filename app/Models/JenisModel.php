<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisModel extends Model
{
    use HasFactory;
    protected $table = "tb_jenis";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_akun',
        'id_kelompok',
        'no_rek',
        'rek',
    ];
}
