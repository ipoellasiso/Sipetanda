<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeModel extends Model
{
    use HasFactory;
    protected $table = "tb_periode_realisasi";
    protected $primaryKey = "id";
    protected $fillable = [
        'periode',
        'awal'
    ];
}
