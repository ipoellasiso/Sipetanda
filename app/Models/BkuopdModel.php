<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkuopdModel extends Model
{
    use HasFactory;
    protected $table = "tb_bkuopd";
    protected $primaryKey = "id_transaksi";
    protected $fillable = [
        'id_rekening',
        'id_akun',
        'id_kelompok',
        'id_jenis',
        'id_objek',
        'id_rincianobjek',
        'id_subrincianobjek',
        'id_opd',
        'id_bank',
        'uraian',
        'ket',
        'status1',
        'status2',
        'status3',
        'no_kas_bpkad',
        'no_buku',
        'tgl_transaksi',
        'nilai_transaksi',
        'created_at',
        'updated_at',
        'tahun',
    ];

    public function anggaran()
    {
        return $this->belongsTo(AnggaranopdModel::class, 'id_subrincianobjek', 'id_sro');
    }


}
