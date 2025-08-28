<?php

namespace App\Http\Controllers;

use App\Models\bkusModel;
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
        );

        if ($request->ajax()) {

            $databku = DB::table('tb_bkuopd')
                        ->select('tb_rekening.id_rekening', 'tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                        ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_bkuopd.id_rekening')
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
                                                <li><a class="lihatBkuopd dropdown-item" data-id_transaksi="'.$row->id_transaksi.'" href="/bkuopd/lihat/'.$row->id_transaksi.'">Lihat</a></li>
                                            </ul>
                                        </div>
                                ';

                        return $btn;
                    })

                    ->addColumn('nilai_transaksi', function($row) {
                        return number_format($row->nilai_transaksi);
                    })

                    ->rawColumns(['nilai_transaksi', 'action'])
                    ->make(true);
        }

        return view('Penatausahaan.Penerimaan.Bku_Opd.Tampilbkuopd', $data);
    }

    public function store(Request $request)
    {
        $now = Carbon::now();
        $Thn = $now->year;
        $Bulan =  $now->month;
        $ambilopd1 = OpdModel::select('id', 'status1')->where('tb_opd.id', auth()->user()->id_opd)->get();
             foreach($ambilopd1 as $d)
             $ambilopd  = $d->status1;
        $ambilopd2 = OpdModel::select('id', 'status1')->where('tb_opd.id', auth()->user()->id_opd)->get();
             foreach($ambilopd2 as $d)
             $ambilopd2  = $d->id;
        // $cek = BkuopdModel::count();
        // // dd($cek);
        // if ($cek == 0) {
        //     $ambilopd1 = OpdModel::select('id', 'status1')->where('tb_opd.id', auth()->user()->id_opd)->get();
        //     foreach($ambilopd1 as $d)
        //     $ambilopd  = $d->status1;
        //     // $urut = 100001;
        //     $urut = $request->no_buku;
        //     $nomor = $ambilopd . '-' . $thnBulan . '-' . $urut;
        //     // dd($nomor);
        // } else {
        //     // echo 'sdas';
        //     $ambil     = BkuopdModel::all()->last();
        //     $ambilopd1 = OpdModel::select('id', 'status1')->where('tb_opd.id', auth()->user()->id_opd)->get();
        //     foreach($ambilopd1 as $d)
        //     $ambilopd  = $d->status1;
        //     $urut      = (int)substr($ambil->no_buku, -7) + 1;
        //     $nomor     = $ambilopd . '-' . $thnBulan . '-' . $urut;
        //     // dd($nomor);
        // }

        $cek = DB::table("tb_bkuopd")->select(DB::raw("COUNT(no_buku) as jumlah"))->where('id_opd', auth()->user()->id_opd)->groupBy('id_opd');
        if ($cek ->count() >0){
            foreach($cek->get() as $k){
                $nourut = sprintf("%04s", abs( ((int)$k->jumlah) +1 )). '/' . $ambilopd . '/' . $Thn;
            }
        } else {
            $num = 1;
            $nourut = sprintf("%04s", $num) . '/' . $ambilopd . '/' . $Thn;
        }


        $bkuId = $request->id_transaksi;

        $cekbku = BkuopdModel::where('no_buku', $request->no_buku)->where('id_transaksi', '!=', $request->id_transaksi)->first();
        if($cekbku)
        {
            return redirect()->back()->with('error', 'Nomor Buku/Bukti Sudah Ada');
        } else {
            $details = [
                'id_rekening'       => $request->id_rekening,
                'id_opd'            => $ambilopd2,
                'id_bank'           => $request->id_bank,
                'uraian'            => $request->uraian,
                'ket'               => $request->ket,
                'no_buku'           => $nourut,
                'tgl_transaksi'     => $request->tgl_transaksi,
                'nilai_transaksi'   => str_replace('.','',$request->nilai_transaksi),
                'tahun'             => date('Y'),
            ];
        }
        
            BkuopdModel::updateOrCreate(['id_transaksi' => $bkuId], $details);
            // BkuopdModel::updateOrCreate(['id_transaksi' => $bkuId], $no_buku);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
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

}
