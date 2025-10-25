<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class LaporanPendapatanExport implements FromView
{
    protected $data;
    protected $tgl_awal;
    protected $tgl_akhir;

    public function __construct($data, $tgl_awal, $tgl_akhir)
    {
        $this->data = $data;
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
    }

    public function view(): View
    {
        $userx = \App\Models\UserModel::where('id', \Illuminate\Support\Facades\Auth::id())
        ->first(['fullname', 'role', 'gambar', 'tahun']);

        return view('Penatausahaan.Penerimaan.Realisasi.export_excel', [
            'data' => $this->data,
            'tgl_awal' => $this->tgl_awal,
            'tgl_akhir' => $this->tgl_akhir,
            'title' => 'Laporan Pendapatan Daerah',
            'userx' => $userx,
        ]);
    }
}
