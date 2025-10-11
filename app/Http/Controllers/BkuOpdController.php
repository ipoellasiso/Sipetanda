<?php

namespace App\Http\Controllers;

use App\Models\bkusModel;
use App\Models\AkunModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use App\Models\ObjekModel;
use App\Models\RincianObjekModel;
use App\Models\SubRincianObjekModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\BankModel;
use App\Models\BkuopdModel;
use App\Models\OpdModel;
use App\Models\RekeningModel;
use Illuminate\Support\Carbon;

class BkuOpdController extends Controller
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
            'title'                => 'BKU Penerimaan',
            'active_penerimaan'    => 'active',
            'active_sub'           => 'active',
            'active_sidebku'       => 'active',
            'breadcumd'            => 'Penatausahaan',
            'breadcumd1'           => 'Penerimaan',
            'breadcumd2'           => 'BKU',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
            'total_jan_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-01-01', '2025-01-31'])->sum('nilai_transaksi'),
            'total_jan_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-01-01', '2025-01-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_jan_btn'        => BkuopdModel::where('id_bank', '3')->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-01-01', '2025-01-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_jan'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-01-01', '2025-01-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->sum('nilai_transaksi'),

            'total_mar_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-03-01', '2025-03-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_mar_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-03-01', '2025-03-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_mar_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-03-01', '2025-03-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_mar'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-03-01', '2025-03-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_feb_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-02-01', '2025-02-28'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_feb_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-02-01', '2025-02-28'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_feb_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-02-01', '2025-02-28'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_feb'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-02-01', '2025-02-28'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_apr_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-04-01', '2025-04-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_apr_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-04-01', '2025-04-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_apr_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-04-01', '2025-04-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_apr'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-04-01', '2025-04-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_mei_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-05-01', '2025-05-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_mei_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-05-01', '2025-05-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_mei_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-05-01', '2025-05-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_mei'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-05-01', '2025-05-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_jun_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-06-01', '2025-06-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_jun_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-06-01', '2025-06-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_jun_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-06-01', '2025-06-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_jun'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-06-01', '2025-06-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_jul_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-07-01', '2025-07-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_jul_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-07-01', '2025-07-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_jul_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-07-01', '2025-07-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_jul'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-07-01', '2025-07-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_ags_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-08-01', '2025-08-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_ags_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-08-01', '2025-08-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_ags_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-08-01', '2025-08-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_ags'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-08-01', '2025-08-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_sep_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-09-01', '2025-09-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_sep_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-09-01', '2025-09-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_sep_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-09-01', '2025-09-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_sep'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-09-01', '2025-09-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_okt_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-10-01', '2025-10-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_okt_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-10-01', '2025-10-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_okt_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-10-01', '2025-10-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_okt'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-10-01', '2025-10-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_nov_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-11-01', '2025-11-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_nov_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-11-01', '2025-11-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_nov_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-11-01', '2025-11-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_nov'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-11-01', '2025-11-30'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_des_mandiri'    => BkuopdModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-12-01', '2025-12-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_des_bpd'        => BkuopdModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-12-01', '2025-12-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_des_btn'        => BkuopdModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->whereBetween('tb_bkuopd.tgl_transaksi', ['2025-12-01', '2025-12-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
            'total_des'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-12-01', '2025-12-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),

            'total_all'            => BkuopdModel::whereBetween('tb_bkuopd.tgl_transaksi', ['2025-01-01', '2025-12-31'])->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->where('tahun', auth()->user()->tahun)->where('tb_bkuopd.id_opd', auth()->user()->id_opd)->sum('nilai_transaksi'),
        );

        if ($request->ajax()) {

            $databku = DB::table('tb_bkuopd')
                        ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro' )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                        ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                        ->orderBy('no_buku', 'asc')
                        ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                        ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                        ->get();

            return Datatables::of($databku)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="editBkuopd dropdown-item" data-id_transaksi="'.$row->id_transaksi.'" href="javascript:void(0)">Ubah</a></li>
                                                <li><a class="deleteBkuopd dropdown-item" data-id_transaksi="'.$row->id_transaksi.'" href="javascript:void(0)">Delete</a></li>
                                            </ul>
                                        </div>
                                ';

                        return $btn;
                    })

                    ->addColumn('action2', function($row){
                        if($row->status1 == 'Input')
                        {
                        $btn1 = '
                                    
                                ';
                        }else if($row->status2 == 'Batal'){
                        
                            $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id_transaksi="'.$row->id_transaksi.'" class="ubahbkuopd btn btn-outline-success m-b-xs btn-sm">Ubah
                                    </a>
                                ';
                        }else{
                        
                            $btn1 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id_transaksi="'.$row->id_transaksi.'" class="tambahbkuopd btn btn-outline-danger m-b-xs btn-sm">Input No Kas Bpkad
                                    </a>
                                ';
                        }

                        return $btn1;
                    })

                    ->addColumn('action3', function($row){
                        if($row->status2 == 'Input' | $row->status1 == 'Input')
                        {
                        $btn2 = '
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-id_transaksi="'.$row->id_transaksi.'" class="batalbkuopd btn btn-outline-primary m-b-xs btn-sm">Batalkan
                                    </a>
                                ';
                        }else{
                        
                        $btn2 = '
                               
                            ';
                        }

                        return $btn2;
                    })

                    ->addColumn('nilai_transaksi', function($row) {
                        return number_format($row->nilai_transaksi);
                    })

                    ->rawColumns(['nilai_transaksi', 'action', 'action2', 'action3'])
                    ->make(true);
        }

        return view('Penatausahaan.Penerimaan.Bku_Opd.Tampilbkuopd', $data);
    }

    public function store(Request $request)
    {
        $now = Carbon::now();
        $Thn = $now->year;

        // ambil status1 & id opd
        $opd = OpdModel::select('id', 'status1')->where('id', auth()->user()->id_opd)->first();
        $status1 = $opd->status1;
        $idOpd   = $opd->id;

        $bkuId = $request->id_transaksi;

        // cek apakah data sudah ada (edit mode)
        $existing = BkuopdModel::find($bkuId);

        if ($existing) {
            // edit → pakai nomor lama
            $nourut = $existing->no_buku;
        } else {
            // tambah baru → generate nomor
            $cek = DB::table("tb_bkuopd")
                ->select(DB::raw("COUNT(no_buku) as jumlah"))
                ->where('id_opd', auth()->user()->id_opd)
                ->groupBy('id_opd');

            if ($cek->count() > 0) {
                foreach ($cek->get() as $k) {
                    $nourut = sprintf("%04s", abs(((int)$k->jumlah) + 1)) . '/' . $status1 . '/' . $Thn;
                }
            } else {
                $num = 1;
                $nourut = sprintf("%04s", $num) . '/' . $status1 . '/' . $Thn;
            }
        }

        // validasi no_buku duplikat
        $cekbku = BkuopdModel::where('no_buku', $nourut);

        if (!empty($bkuId)) {
            $cekbku->where('id_transaksi', '!=', $bkuId);
        }

        if ($cekbku->exists()) {
            return redirect()->back()->with('error', 'Nomor Buku/Bukti Sudah Ada');
        }

        $details = [
            'id_akun'            => $request->id_akun,
            'id_kelompok'        => $request->id_kelompok,
            'id_jenis'           => $request->id_jenis,
            'id_objek'           => $request->id_objek,
            'id_rincianobjek'    => $request->id_rincianobjek,
            'id_subrincianobjek' => $request->id_subrincianobjek,
            'id_rekening'        => $request->id_rekening,
            'id_opd'             => $idOpd,
            'id_bank'            => $request->id_bank,
            'uraian'             => $request->uraian,
            'ket'                => $request->ket,
            'no_buku'            => $nourut,
            'tgl_transaksi'      => $request->tgl_transaksi,
            'nilai_transaksi'    => str_replace('.', '', $request->nilai_transaksi),
            'tahun'              => $Thn,
        ];

        BkuopdModel::updateOrCreate(['id_transaksi' => $bkuId], $details);

        return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function editbkuopd($id)
    {
        $where = array('tb_bkuopd.id_transaksi' => $id);
        $data = DB::table('tb_bkuopd')
                        ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro' )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                        ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                        ->orderBy('no_buku', 'asc')
                        ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                        ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                        ->where($where)
                        ->first();

        return response()->json($data);
    }

    public function getDatarek(Request $request)
    {
        $search = $request->searchRek;
  
        if($search == ''){
            $rek = RekeningModel::orderBy('rekening2','asc')->select('id_rekening','rekening2')->get();
        }else{
            $rek = RekeningModel::orderBy('rekening2','asc')->select('id_rekening','rekening2')->where('rekening2', 'like', '%' .$search . '%')->get();
        }
  
        $response = array();
        foreach($rek as $row){
            $response[] = array(
                "id"   => $row->id_rekening,
                "text" => $row->rekening2
            );
        }

        return response()->json($response); 
    } 

    public function getDataopd(Request $request)
    {
        $search = $request->searchOpd;
  
        if($search == ''){
            $opd = OpdModel::orderBy('nama_opd','asc')->select('id','nama_opd')->limit(5)->get();
        }else{
            $opd = OpdModel::orderBy('nama_opd','asc')->select('id','nama_opd')->where('nama_opd', 'like', '%' .$search . '%')->limit(5)->get();
        }
  
        $response = array();
        foreach($opd as $row){
            $response[] = array(
                "id"   => $row->id,
                "text" => $row->nama_opd
            );
        }

        return response()->json($response); 
    } 

    public function getDatabank(Request $request)
    {
        $search = $request->searchBank;
  
        if($search == ''){
            $bank = BankModel::orderBy('nama_bank','asc')->select('id_bank','nama_bank')->limit(5)->get();
        }else{
            $bank = BankModel::orderBy('nama_bank','asc')->select('id_bank','nama_bank')->where('nama_bank', 'like', '%' .$search . '%')->limit(5)->get();
        }
  
        $response = array();
        foreach($bank as $row){
            $response[] = array(
                "id"   => $row->id_bank,
                "text" => $row->nama_bank
            );
        }

        return response()->json($response); 
    } 

    public function getDataakun1(){
        $data1 = AkunModel::where('rek', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data1);
    }

    public function getDatakelompok($id){
        $data = KelompokModel::where('id_akun', $id)->where('rek_kel', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data);
    }

    public function getDatajenis($id){
        $data = JenisModel::where('id_kelompok', $id)->where('rek_jen', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data);
    }

    public function getDataobjek($id){
        $data = ObjekModel::where('id_jenis', $id)->where('rek_o', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data);
    }

    public function getDatarincianobjek($id){
        $data = RincianObjekModel::where('id_objek', $id)->where('rek_ro', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data);
    }

    public function getDatasubrincianobjek($id){
        $data = SubRincianObjekModel::where('id_rincianobjek', $id)->where('rek_sro', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data);
    }

    public function tambahkasbpkad($id)
    {
        $where = array('tb_bkuopd.id_transaksi' => $id);
        $data = DB::table('tb_bkuopd')
                        ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro' )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                        ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                        ->orderBy('no_buku', 'asc')
                        ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                        ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                        ->where($where)
                        ->first();

        return response()->json($data);
    }

    public function simpankasbpkad(Request $request, string $idhalaman)
    {
        $request->validate([
            'no_kas_bpkad' => 'required|string',
            'id_transaksi' => 'required',
        ]);

        // Cek apakah nomor kas sudah ada
        $cekDuplikat = BkuopdModel::where('no_kas_bpkad', $request->no_kas_bpkad)->exists();
        if ($cekDuplikat) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor Kas BPKAD sudah digunakan!'
            ], 400);
        }

        // Update tabel bkusModel
        bkusModel::where('no_buku', $request->no_kas_bpkad)->update([
            'status3' => 1,
        ]);

        // Update tabel BkuopdModel
        $update = BkuopdModel::where('id_transaksi', $request->id_transaksi)->update([
            'no_kas_bpkad' => $request->no_kas_bpkad,
            'status1' => 'Input',
            'status2' => 'Input',
        ]);

        if ($cekDuplikat) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor Kas BPKAD sudah digunakan!'
            ], 400); // ⬅️ tambahkan 400 di sini
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan!'
        ]);
    }

    public function batalkasbpkad($id)
    {
        $where = array('tb_bkuopd.id_transaksi' => $id);
        $data = DB::table('tb_bkuopd')
                        ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro' )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                        ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                        ->orderBy('no_buku', 'asc')
                        ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                        ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                        ->where($where)
                        ->first();

        return response()->json($data);
    }

    public function simpanbatalkasbpkad(Request $request, string $idhalaman)
    {

        bkusModel::where('no_buku',$request->get('no_kas_bpkad'))
        ->update([
            'status3' => 0,
        ]);

        BkuopdModel::where('id_transaksi',$request->get('id_transaksi'))
        ->update([
            'status1'       => 'Batal',
            'status2'       => 'Batal',
        ]);

            return redirect('/tampilbkuopd')->with('success','Data Berhasil DiUpdate');
    }

    public function ubahkasbpkad($id)
    {
        $where = array('tb_bkuopd.id_transaksi' => $id);
        $data = DB::table('tb_bkuopd')
                        ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro' )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                        ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                        ->orderBy('no_buku', 'asc')
                        ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                        ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                        ->where($where)
                        ->first();

        return response()->json($data);
    }

    public function simpanubahkasbpkad(Request $request, string $idhalaman)
    {

        $request->validate([
        'no_kas_bpkad' => 'required|string',
        'id_transaksi' => 'required',
        ]);

        // Cek apakah nomor kas sudah digunakan oleh transaksi lain
        $cekDuplikat = BkuopdModel::where('no_kas_bpkad', $request->no_kas_bpkad)
            ->where('id_transaksi', '!=', $request->id_transaksi) // abaikan dirinya sendiri
            ->exists();

        if ($cekDuplikat) {
            return response()->json([
                'success' => false,
                'message' => 'Nomor Kas BPKAD sudah digunakan!'
            ], 400);
        }

        // Update ke tabel
        $update = BkuopdModel::where('id_transaksi', $request->id_transaksi)
            ->update([
                'no_kas_bpkad' => $request->no_kas_bpkad,
                'status1' => 'Input',
                'status2' => 'Input',
            ]);

        if (!$update) {
            return response()->json([
                'success' => false,
                'message' => 'Data gagal diperbarui!'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diupdate!'
        ]);
    }

}
