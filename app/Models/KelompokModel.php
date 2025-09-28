<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokModel extends Model
{
    use HasFactory;
    protected $table = "tb_kelompok";
    protected $primaryKey = "id_kel";
    protected $fillable = [
        'id_akun',
        'no_rek_kel',
        'rek_kel',
    ];

    public function jenis()
    {
        return $this->hasMany(JenisModel::class, 'id_kelompok', 'id_kel');
    }

    public function anggaran()
    {
        return $this->hasMany(AnggaranopdModel::class, 'id_kelompok', 'id_kel');
    }

}
