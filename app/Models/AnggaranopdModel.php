<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranopdModel extends Model
{
    use HasFactory;
    protected $table = "tb_anggaranopd";
    protected $primaryKey = "id_anggaranopd";
    protected $fillable = [
        'id_akun',
        'id_kelompok',
        'id_jenis',
        'id_objek',
        'id_rincianobjek',
        'id_subrincianobjek',
        'id_opd',
        'uraian',
        'ket',
        'status1',
        'status2',
        'status3',
        'nilai_anggaranopd',
        'created_at',
        'updated_at',
        'tahun',
    ];

    public function bku()
    {
        return $this->hasMany(BkuopdModel::class, 'id_subrincianobjek', 'id_subrincianobjek')
                    ->where('id_opd', auth()->user()->id_opd)   // filter OPD login
                    ->where('tahun', auth()->user()->tahun);    // filter tahun login
    }

}
