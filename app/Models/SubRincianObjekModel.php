<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRincianObjekModel extends Model
{
    use HasFactory;
    protected $table = "tb_subrincianobjek";
    protected $primaryKey = "id_sro";
    protected $fillable = [
        'id_akun',
        'id_kelompok',
        'id_jenis',
        'id_objek',
        'id_rincianobjek',
        'no_rek_sro',
        'rek_sro',
    ];
}
