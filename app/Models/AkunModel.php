<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunModel extends Model
{
    use HasFactory;
    protected $table = "tb_akun";
    protected $primaryKey = "id";
    protected $fillable = [
        'no_rek',
        'rek',
    ];

    public function kelompok()
    {
        return $this->hasMany(KelompokModel::class, 'id_akun', 'id');
    }

    public function anggaran()
    {
        return $this->hasMany(AnggaranopdModel::class, 'id_akun', 'id');
    }

}
