<?php

namespace App\Http\Controllers;

use App\Models\AnggaranModel;
use App\Models\bkusModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RealisasiopdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get data
        public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Laporan Realisasi',
            'active_penerimaan'    => 'active',
            'active_sub'           => 'active',
            'active_siderealisasi' => 'active',
            'breadcumd'            => 'Penatausahaan',
            'breadcumd1'           => 'Laporan',
            'breadcumd2'           => 'Realisasi',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),

        );

        if ($request->ajax()) {

            $datarealisasi = DB::table('tb_bkuopd')
                            ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro' )
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                            ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                            ->orderBy('no_buku', 'asc')
                            ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                            ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                            ->get();

            return Datatables::of($datarealisasi)
                    ->addIndexColumn()
                    ->addColumn('nilai_transaksi', function($row) {
                        return number_format($row->nilai_transaksi);
                    })
                    ->rawColumns(['nilai_transaksi'])
                    ->make(true);
        }

        return view('Penatausahaan.Penerimaan.Realisasi_Opd.Tampilrealisasiopd', $data);
    }
}
