<?php

namespace App\Imports;

use App\Models\AkunModel;
use App\Models\KelompokModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class KelompokImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new KelompokModel([
            'id_akun' => $row['id_akun'],
            'no_rek_kel' => $row['no_rek_kel'],
            'rek_kel' => $row['rek_kel'],
        ]);
    }

    public function rules(): array
    {
        return [
            'no_rek_kel' => 'required|unique:tb_kelompok',
            // 'rekening' => 'required|unique:tb_rekening',
            // 'rekening2' => 'required|unique:tb_rekening',
        ];
    }
}
