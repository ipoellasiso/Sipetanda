<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggaranModel extends Model
{
    use HasFactory;
    protected $table = "tb_anggaran";
    protected $primaryKey = "id_anggaran";
    protected $fillable = [
        'id_rekening',
        'id_opd',
        'nilai',
        'tahun',
    ];
}
