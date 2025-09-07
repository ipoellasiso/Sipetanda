<?php

namespace App\Imports;

use App\Models\AkunModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use App\Models\ObjekModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ObjekImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new ObjekModel([
            'id_akun' => $row['id_akun'],
            'id_kelompok' => $row['id_kelompok'],
            'id_jenis' => $row['id_jenis'],
            'no_rek_o' => $row['no_rek_o'],
            'rek_o' => $row['rek_o'],
        ]);
    }

    public function rules(): array
    {
        return [
            'no_rek_o' => 'required|unique:tb_objek',
            // 'rekening' => 'required|unique:tb_rekening',
            // 'rekening2' => 'required|unique:tb_rekening',
        ];
    }
}
