<?php

namespace App\Http\Controllers;

use App\Exports\DataExport2;
use App\Models\AnggaranModel;
use App\Models\bkusModel;
use App\Models\OpdModel;
use App\Models\RekeningModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class KamarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Buku Pembantu Penerimaan',
            'active_penerimaan'    => 'active',
            'active_sub'           => 'active',
            'active_sidebukupp'    => 'active',
            'breadcumd'            => 'Penatausahaan',
            'breadcumd1'           => 'Penerimaan',
            'breadcumd2'           => 'Buku Pembantu Penerimaan',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );
        
        // if ($request->ajax()) {

        //     $datarealisasi = DB::table('tb_transaksi')
        //                 ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', )
        //                 ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
        //                 ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
        //                 ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
        //                 ->get();

        //     return Datatables::of($datarealisasi)
        //             ->addIndexColumn()
        //             ->addColumn('nilai_transaksi', function($row) {
        //                 return number_format($row->nilai_transaksi);
        //             })
        //             ->rawColumns(['nilai_transaksi'])
        //             ->make(true);
        // }

        return view('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek.Tampilrekapanrek', $data);
    }

    public function viewdataindex(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                => 'Buku Pembantu Penerimaan',
            'active_penerimaan'    => 'active',
            'active_sub'           => 'active',
            'active_sidebukupp'    => 'active',
            'breadcumd'            => 'Penatausahaan',
            'breadcumd1'           => 'Penerimaan',
            'breadcumd2'           => 'Buku Pembantu Penerimaan',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->tampilawal) {
            $datarealisasi = DB::table('tb_transaksi')
                            ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', 'tb_transaksi.id_rekening', 'tb_transaksi.id_opd' )
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                            ->where('tb_opd.nama_opd','like', "%".$request->nama_opd."%")
                            ->where('tb_transaksi.id_rekening','like', "%".$request->id_rekening."%")
                            ->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal, $request->tgl_akhir])
                            // ->limit(10)
                            ->get();

            return view('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek.Viewdatacari',['datarealisasi' => $datarealisasi,]);
        } else {
            $datarealisasi = DB::table('tb_transaksi')
                            ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', 'tb_transaksi.id_rekening', 'tb_transaksi.id_opd' )
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                            ->where('tb_opd.nama_opd','like', "%".$request->nama_opd."%")
                            ->where('tb_transaksi.id_rekening','like', "%".$request->id_rekening."%")
                            ->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal, $request->tgl_akhir])
                            // ->limit(10)
                            ->get();
            
            $data1 = DB::table('tb_transaksi')
                            ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi',  'tb_transaksi.id_rekening')
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                            ->where('tb_opd.nama_opd','like', "%".$request->nama_opd."%")
                            ->where('tb_transaksi.id_rekening','like', "%".$request->id_rekening."%")
                            ->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal, $request->tgl_akhir])
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->first();
            
            return view('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek.Viewdataindex',[
                'data' => $data,
                'datarealisasi' => $datarealisasi,
                'data1' => $data1,
            ]);
        }
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

    public function getDataopd1(Request $request)
    {
        $search = $request->searchOpd;
  
        if($search == ''){
            $opd = OpdModel::orderBy('id','asc')->select('id','nama_opd')->get();
        }else{
            $opd = OpdModel::orderBy('id','asc')->select('id','nama_opd')->where('nama_opd', 'like', '%' .$search . '%')->get();
        }
  
        $response = array();
        foreach($opd as $row){
            $response[] = array(
                "id"   => $row->nama_opd,
                "text" => $row->nama_opd
            );
        }

        return response()->json($response); 
    } 

    public function Exportexcells(Request $request)
    {
        $datarealisasi = DB::table('tb_transaksi')
                            ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', 'tb_transaksi.id_rekening', 'tb_transaksi.id_opd' )
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                            ->where('tb_transaksi.id_opd','like', "%".$request->id_opd."%")
                            ->where('tb_transaksi.id_rekening','like', "%".$request->id_rekening."%")
                            ->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal, $request->tgl_akhir])
                            // ->limit(10)
                            ->get();
            
            $data1 = DB::table('tb_transaksi')
                            ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi',  'tb_transaksi.id_rekening')
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                            ->where('tb_transaksi.id_opd','like', "%".$request->id_opd."%")
                            ->where('tb_transaksi.id_rekening','like', "%".$request->id_rekening."%")
                            ->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal, $request->tgl_akhir])
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->first();

        if ($request->page == 'downloadexcel'){
            return Excel::download(new DataExport2($datarealisasi, $data1), 'Buku_Pembantu_Penerimaan.xlsx');
            // return view('Laporan_LS.cetakisilaporanls', $data, compact('cetakpajakls', 'cetakbulan'));
        }
    }

}
