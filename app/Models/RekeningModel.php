<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekeningModel extends Model
{
    use HasFactory;
    protected $table = "tb_rekening";
    protected $primaryKey = "id_rekening";
    protected $fillable = [
        'no_rekening',
        'rekening',
        'rekening2',
        'ket1',
        'ket2',
        'ket3',
        'ket4'
    ];
}
