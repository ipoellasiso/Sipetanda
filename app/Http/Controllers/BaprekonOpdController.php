<?php

namespace App\Http\Controllers;

use App\Models\BkuopdModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class BaprekonOpdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index (Request $request)
    {
        $userId = Auth::guard('web')->user()->id;

        // ambil user login
        $userx = UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']);

        // ambil bulan & tahun filter
        $bulan = $request->input('bulan', date('m'));
        $tahun = $request->input('tahun', date('Y'));

        // === BKU DATA ===
        $bkuData = DB::table('tb_bkuopd')
            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_bkuopd.id_rekening')
            ->select(
                'tb_rekening.no_rekening',
                'tb_rekening.rekening2',
                DB::raw("SUM(CASE WHEN MONTH(tb_bkuopd.tgl_transaksi) < $bulan THEN tb_bkuopd.nilai_transaksi ELSE 0 END) as bku_sebelumnya"),
                DB::raw("SUM(CASE WHEN MONTH(tb_bkuopd.tgl_transaksi) = $bulan THEN tb_bkuopd.nilai_transaksi ELSE 0 END) as bku_bulan_ini")
            )
            ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
            ->where('tb_bkuopd.status1', 'Input')
            ->whereYear('tb_bkuopd.tgl_transaksi', $tahun)
            ->groupBy('tb_rekening.no_rekening', 'tb_rekening.rekening2')
            ->get();

        // === TRANSAKSI DATA ===
        $trxData = DB::table('tb_transaksi')
            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
            ->select(
                'tb_rekening.no_rekening',
                DB::raw("SUM(CASE WHEN MONTH(tb_transaksi.tgl_transaksi) < $bulan THEN tb_transaksi.nilai_transaksi ELSE 0 END) as trx_sebelumnya"),
                DB::raw("SUM(CASE WHEN MONTH(tb_transaksi.tgl_transaksi) = $bulan THEN tb_transaksi.nilai_transaksi ELSE 0 END) as trx_bulan_ini")
            )
            ->where('tb_transaksi.id_opd', auth()->user()->id_opd)
            // ->where('tb_transaksi.status3', '0') // kalau perlu aktifkan
            ->whereYear('tb_transaksi.tgl_transaksi', $tahun)
            ->groupBy('tb_rekening.no_rekening')
            ->get();

        // === GABUNG DATA ===
        $rekonDetails = [];
        foreach ($bkuData as $bku) {
            $trx = $trxData->firstWhere('no_rekening', $bku->no_rekening);

            $total_bku = $bku->bku_sebelumnya + $bku->bku_bulan_ini;
            $total_trx = ($trx->trx_sebelumnya ?? 0) + ($trx->trx_bulan_ini ?? 0);
            $selisih   = $total_trx - $total_bku;

            $rekonDetails[] = (object)[
                'no_rekening'      => $bku->no_rekening,
                'rekening2'        => $bku->rekening2,
                'bku_sebelumnya'   => $bku->bku_sebelumnya,
                'bku_bulan_ini'    => $bku->bku_bulan_ini,
                'trx_sebelumnya'   => $trx->trx_sebelumnya ?? 0,
                'trx_bulan_ini'    => $trx->trx_bulan_ini ?? 0,
                'total_bku'        => $total_bku,
                'total_trx'        => $total_trx,
                'selisih'          => $selisih,
                'status_rekon'     => ($selisih == 0) ? 'Sama' : 'Tidak Sama',
            ];
        }

        // header berita acara
        $rekon = (object)[
            'tanggal' => now(),
            'nama_opd' => auth()->user()->opd->nama_opd ?? '',
            'jabatan_penandatangan' => 'Kepala OPD',
            'pejabat_penandatangan' => $userx->fullname,
        ];

        $data = [
            'title'        => 'Home',
            'active_home'  => 'active',
            'active_subopd'=> 'active',
            'active_sidebap'=> 'active',
            'breadcumd'    => 'Home',
            'breadcumd1'   => 'Dashboard',
            'breadcumd2'   => 'Dashboard',
            'userx'        => $userx,
            'rekon'        => $rekon,
            'rekonDetails' => $rekonDetails,
            'bulan'        => $bulan,
            'tahun'        => $tahun,
        ];

        return view('Penatausahaan.Penerimaan.Bap_Rekon.Tampilbaprekon1', $data);
    }

    public function cetakPdf()
    {
        $userId = Auth::guard('web')->user()->id;
        $userx = UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']);

        // ... query bkuData, trxData, rekonDetails sama seperti punyamu ...
        // ambil total nilai transaksi dari tb_bkuopd (status1 = Input)
        $bkuData = DB::table('tb_bkuopd')
            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_bkuopd.id_rekening')
            ->select(
                'tb_rekening.no_rekening',
                'tb_rekening.rekening2',
                DB::raw('SUM(tb_bkuopd.nilai_transaksi) as total_bku')
            )
            ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
            ->where('tb_bkuopd.status1', 'Input')
            ->whereYear('tb_bkuopd.tgl_transaksi', date('Y'))
            ->groupBy('tb_rekening.no_rekening', 'tb_rekening.rekening2')
            ->get();

        // ambil total nilai transaksi dari tb_transaksi (status3 = 0)
        $trxData = DB::table('tb_transaksi')
            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
            ->select(
                'tb_rekening.no_rekening',
                DB::raw('SUM(tb_transaksi.nilai_transaksi) as total_transaksi')
            )
            ->where('tb_transaksi.id_opd', auth()->user()->id_opd)
            // ->where('tb_transaksi.status3', '0')
            ->whereYear('tb_transaksi.tgl_transaksi', date('Y'))
            ->groupBy('tb_rekening.no_rekening')
            ->get();

        // gabungkan hasil bku dan transaksi
        $rekonDetails = [];
        foreach ($bkuData as $bku) {
            $trx = $trxData->firstWhere('no_rekening', $bku->no_rekening);

            $rekonDetails[] = (object)[
                'no_rekening'     => $bku->no_rekening,
                'rekening2'        => $bku->rekening2,
                'total_bku'       => $bku->total_bku,
                'total_transaksi' => $trx->total_transaksi ?? 0,
                'status_rekon'    => ($bku->total_bku == ($trx->total_transaksi ?? 0)) 
                                    ? 'Sama' 
                                    : 'Tidak Sama',
            ];
        }

        // data untuk header berita acara
        $rekon = (object)[
            'tanggal' => now(),
            'nama_opd' => auth()->user()->opd->nama_opd ?? '',
            'jabatan_penandatangan' => 'Kepala OPD',
            'pejabat_penandatangan' => $userx->fullname,
        ];

        $pdf = Pdf::loadView(
        'Penatausahaan.Penerimaan.Bap_Rekon.Cetakbaprekon',
        [
            'rekon'        => $rekon,
            'rekonDetails' => $rekonDetails,
            'title'        => 'Berita Acara Rekonsiliasi',
            'userx'        => $userx,
            'active_home'           => 'active',
            'active_subopd'         => 'active',
            'active_sidebap'        => 'active',
            'breadcumd'             => 'Home',
            'breadcumd1'            => 'Dashboard',
            'breadcumd2'            => 'Dashboard',
        ]
    );

        // langsung stream tanpa simpan ke folder
        return $pdf->stream('BAP_Rekon.pdf');  
    }

}
