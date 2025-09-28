<?php

namespace App\Http\Controllers;

use App\Models\BkuopdModel;
use App\Models\User;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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

        $labels = [
        'January','February','March','April','May','June',
        'July','August','September','October','November','December'
        ];

        $realisasiQuery = DB::table('tb_bkuopd')
            ->selectRaw('MONTH(tgl_transaksi) as bulan, SUM(nilai_transaksi) as total')
            ->where('id_opd', auth()->user()->id_opd)
            ->whereYear('tgl_transaksi', date('Y'))
            ->groupBy('bulan')
            ->pluck('total','bulan'); 

        $realisasi = [];
        for ($i=1; $i<=12; $i++) {
            $realisasi[] = $realisasiQuery[$i] ?? 0;
        }

        // ================== Card Realisasi per Subrincian ===================
        $cardRealisasi = DB::table('tb_bkuopd')
                        ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                        ->select('tb_subrincianobjek.rek_sro as nama', DB::raw('SUM(tb_bkuopd.nilai_transaksi) as total'))
                        ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                        ->whereYear('tb_bkuopd.tgl_transaksi', date('Y'))
                        ->groupBy('tb_subrincianobjek.rek_sro')
                        ->get();

        $data = array(
            'title'                 => 'Home',
            'active_home'           => 'active',
            // 'active_subopd'      => 'active',
            // 'active_sideopd'     => 'active',
            'breadcumd'             => 'Home',
            'breadcumd1'            => 'Dashboard',
            'breadcumd2'            => 'Dashboard',
            'userx'                 => $userx,
            'labels'                => $labels,
            'realisasi'             => $realisasi,
            'cardRealisasi'         => $cardRealisasi
        );

        return view('Dashboard.Dashboard_admin', $data);
    }

}
