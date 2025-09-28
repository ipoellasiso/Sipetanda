<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianObjekModel extends Model
{
    use HasFactory;
    protected $table = "tb_rincianobjek";
    protected $primaryKey = "id_ro";
    protected $fillable = [
        'id_akun',
        'id_kelompok',
        'id_jenis',
        'id_objek',
        'no_rek_ro',
        'rek_ro',
    ];

    public function subrincian()
    {
        return $this->hasMany(SubRincianObjekModel::class, 'id_rincianobjek', 'id_ro');
    }

    public function anggaran()
    {
        return $this->hasMany(AnggaranopdModel::class, 'id_rincianobjek', 'id_ro');
    }

}
