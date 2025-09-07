<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjekModel extends Model
{
    use HasFactory;
    protected $table = "tb_objek";
    protected $primaryKey = "id_o";
    protected $fillable = [
        'id_akun',
        'id_kelompok',
        'id_jenis',
        'no_rek_o',
        'rek_o',
    ];
}
