<?php

namespace App\Http\Controllers;

use App\Models\BkuopdModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaprekonOpdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index ()
    {
        $userId = Auth::guard('web')->user()->id;

        // ambil user login
        $userx = UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']);

        // ambil total nilai transaksi dari tb_bkuopd (status1 = Input)
        $bkuData = DB::table('tb_bkuopd')
            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_bkuopd.id_rekening')
            ->select(
                'tb_rekening.no_rekening',
                'tb_rekening.rekening',
                DB::raw('SUM(tb_bkuopd.nilai_transaksi) as total_bku')
            )
            ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
            ->where('tb_bkuopd.status1', 'Input')
            ->whereYear('tb_bkuopd.tgl_transaksi', date('Y'))
            ->groupBy('tb_rekening.no_rekening', 'tb_rekening.rekening')
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
                'rekening'        => $bku->rekening,
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

        $data = array(
            'title'                 => 'Home',
            'active_home'           => 'active',
            'active_subopd'         => 'active',
            'active_sidebap'        => 'active',
            'breadcumd'             => 'Home',
            'breadcumd1'            => 'Dashboard',
            'breadcumd2'            => 'Dashboard',
            'userx'                 => $userx,
            'rekon'                 => $rekon,
            'rekonDetails'          => $rekonDetails,
        );

        return view('Penatausahaan.Penerimaan.Bap_Rekon.Tampilbaprekon', $data);
    }
}
