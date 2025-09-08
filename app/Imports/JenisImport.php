<?php

namespace App\Imports;

use App\Models\AkunModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class JenisImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new JenisModel([
            'id_akun' => $row['id_akun'],
            'id_kelompok' => $row['id_kelompok'],
            'no_rek_jen' => $row['no_rek_jen'],
            'rek_jen' => $row['rek_jen'],
        ]);
    }

    public function rules(): array
    {
        return [
            'no_rek_jen' => 'required|unique:tb_jenis',
            // 'rekening' => 'required|unique:tb_rekening',
            // 'rekening2' => 'required|unique:tb_rekening',
        ];
    }
}
