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
        'id_opd',
        'id_bank',
        'uraian',
        'ket',
        'status1',
        'status2',
        'status3',
        'no_buku',
        'tgl_transaksi',
        'nilai_transaksi',
        'created_at',
        'updated_at',
        'tahun',
    ];

    public static function getId()
    {
        return $getId = DB::table('tb_bkuopd')->orderBy('id_transaksi')->take(1)->get();
    }
}
