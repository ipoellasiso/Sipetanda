<?php

namespace App\Http\Controllers;

use App\Models\BankModel;
use App\Models\JenispajakModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RealisasiHomeController extends Controller
{
    // ======================
    // 💰 Halaman Laporan Target & Realisasi Pendapatan
    // ======================
    public function laporanPendapatan(Request $request)
    {
        $tahun = $request->tahun ?? date('Y');

        // Hanya rekening yang punya transaksi
        $data = DB::table('tb_transaksi as t')
            ->join('tb_rekening as r', 'r.id_rekening', '=', 't.id_rekening')
            ->leftJoin('tb_anggaran as a', function($join) use ($tahun) {
                $join->on('r.id_rekening', '=', 'a.id_rekening')
                     ->where('a.tahun', '=', $tahun);
            })
            ->where('t.tahun', '=', $tahun)
            ->select(
                'r.ket4', 'r.ket1', 'r.ket2', 'r.rekening2',
                DB::raw('COALESCE(SUM(a.nilai),0) as anggaran'),
                DB::raw('SUM(t.nilai_transaksi) as realisasi')
            )
            ->groupBy('r.ket4', 'r.ket1', 'r.ket2', 'r.rekening2')
            ->orderBy('r.ket4')
            ->orderBy('r.ket1')
            ->orderBy('r.ket2')
            ->orderBy('r.rekening2')
            ->get();

        // Buat struktur bertingkat
        $laporan = [];
        foreach ($data as $row) {
            $laporan[$row->ket4][$row->ket1][$row->ket2][] = $row;
        }

        $data = [
            'title'              => 'Laporan Realisasi Pendapatan',
            'active_master_data' => 'active',
            'active_subopd'      => 'active',
            'active_sidebank'    => 'active',
            'breadcumd'          => 'Penatausahaan',
            'breadcumd1'         => 'Penerimaan',
            'breadcumd2'         => 'Laporan Realisasi Pendapatan',
            'tahun'   => $tahun,
            'laporan' => $laporan,
        ];

        return view('Penatausahaan.Penerimaan.Realisasi_Halaman_Depan.Tampilrealisasi_home', $data);
    }
}
