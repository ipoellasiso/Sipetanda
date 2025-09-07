<?php

namespace App\Imports;

use App\Models\AkunModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use App\Models\ObjekModel;
use App\Models\RincianObjekModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class RincianobjekImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new RincianObjekModel([
            'id_akun' => $row['id_akun'],
            'id_kelompok' => $row['id_kelompok'],
            'id_jenis' => $row['id_jenis'],
            'id_objek' => $row['id_objek'],
            'no_rek_ro' => $row['no_rek_ro'],
            'rek_ro' => $row['rek_ro'],
        ]);
    }

    public function rules(): array
    {
        return [
            'no_rek_ro' => 'required|unique:tb_rincianobjek',
            // 'rekening' => 'required|unique:tb_rekening',
            // 'rekening2' => 'required|unique:tb_rekening',
        ];
    }
}
