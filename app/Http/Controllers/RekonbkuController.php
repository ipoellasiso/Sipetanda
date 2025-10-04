<?php

namespace App\Http\Controllers;

use App\Models\BkuopdModel;
use App\Models\OpdModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class RekonbkuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                 => 'Data Rekon',
            'active_penerimaan'     => 'active',
            'active_subopd'         => 'active',
            'active_siderekon'      => 'active',
            'breadcumd'             => 'Penatausahaan',
            'breadcumd1'            => 'Penerimaan',
            'breadcumd2'            => 'Rekon Penerimaan',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
            'dataq'                 => DB::table('tb_bkuopd')
                                    ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro')
                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                                    ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                                    ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                                    ->whereIn('tb_bkuopd.status1', ['Input'])
                                    ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                                    ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                                    ->select([ 'tb_subrincianobjek.rek_sro',
                                        DB::raw('sum(tb_bkuopd.nilai_transaksi) as nilai_transaksi'),
                                      ])
                                    ->groupBy('tb_subrincianobjek.rek_sro')
                                    ->get(),

            'dataq1'                => DB::table('tb_transaksi')
                                    ->select('tb_opd.nama_opd', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', 'tb_transaksi.status3', 'tb_transaksi.id_rekening', 'tb_rekening.rekening2')
                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                                    ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                                    ->orderBy('no_buku', 'asc')
                                    ->whereIn('tb_transaksi.status3', ['0'])
                                    ->where('tb_transaksi.tahun', auth()->user()->tahun)
                                    ->where('tb_transaksi.id_opd', auth()->user()->id_opd)
                                    ->select([ 'tb_rekening.rekening2',
                                        DB::raw('sum(tb_transaksi.nilai_transaksi) as nilai_transaksi'),
                                      ])
                                    ->groupBy('tb_rekening.rekening2')
                                    ->get(),
        );

        if ($request->ajax()) {

            $dataq = DB::table('tb_bkuopd')
                        ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro', 'tb_bkuopd.status3' )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                        ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                        ->orderBy('no_buku', 'asc')
                        ->whereIn('tb_bkuopd.status1', ['Input'])
                        ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                        ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                        ->get();

            return Datatables::of($dataq)
                    ->addIndexColumn()
                    ->addColumn('action3', function($row){
                        if($row->status3 == 'Posting')
                        {
                        $btn2 = '
                                ';
                        }else{
                        
                        $btn2 = '
                               <a href="javascript:void(0)" data-toggle="tooltip" data-id_transaksi="'.$row->id_transaksi.'" class="Postingbkuopd btn btn-outline-primary m-b-xs btn-sm">Posting
                                </a>
                            ';
                        }

                        return $btn2;
                    })

                    ->addColumn('nilai_transaksi', function($row) {
                        return number_format($row->nilai_transaksi);
                    })

                    ->rawColumns(['nilai_transaksi'])
                    ->make(true);
        }

        return view('Penatausahaan.Penerimaan.Rekon.Rekon', $data);
    }

    public function index2(Request $request)
    {
        if ($request->ajax()) {
            $dataq = DB::table('tb_transaksi')
                        ->select('tb_opd.nama_opd', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', 'tb_transaksi.status3')
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                        ->orderBy('no_buku', 'asc')
                        ->whereIn('tb_transaksi.status3', ['0'])
                        ->where('tb_transaksi.tahun', auth()->user()->tahun)
                        ->where('tb_transaksi.id_opd', auth()->user()->id_opd)
                        ->get();

            return Datatables::of($dataq)
                    ->addIndexColumn()
                    ->addColumn('nilai_transaksi', function($row) {
                        return number_format($row->nilai_transaksi);
                    })

                    ->rawColumns(['nilai_transaksi'])
                    ->make(true);
        }

        return view('Penatausahaan.Penerimaan.Rekon.Rekon');
    }

}
