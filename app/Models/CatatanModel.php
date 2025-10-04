<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanModel extends Model
{
    use HasFactory;
    protected $table = "tb_catatan";
    protected $primaryKey = "id";
    protected $fillable = [
        'id_opd',
        'tahun',
        'bulan',
        'status1',
        'status2',
        'status3',
    ];
}