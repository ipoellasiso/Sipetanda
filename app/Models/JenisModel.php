<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisModel extends Model
{
    use HasFactory;
    protected $table = "tb_jenis";
    protected $primaryKey = "id_jen";
    protected $fillable = [
        'id_akun',
        'id_kelompok',
        'no_rek_jen',
        'rek_jen',
    ];

    public function objek()
    {
        return $this->hasMany(ObjekModel::class, 'id_jenis', 'id_jen');
    }

    public function subrincian()
    {
        return $this->hasMany(SubRincianObjekModel::class, 'id_jenis', 'id_jen');
    }

    // public function anggaran()
    // {
    //     return $this->hasManyThrough(
    //         AnggaranModel::class,
    //         SubRincianObjekModel::class,
    //         'id_jenis',      // FK di subrincian
    //         'id_subrincianobjek', // FK di anggaran
    //         'id_jen',        // PK di jenis
    //         'id_sro'         // PK di subrincian
    //     );
    // }

    public function anggaran()
    {
        return $this->hasMany(AnggaranopdModel::class, 'id_jenis', 'id_jen');
    }

}
