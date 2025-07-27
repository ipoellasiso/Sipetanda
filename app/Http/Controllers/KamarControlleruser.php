<?php

namespace App\Http\Controllers;

use App\Models\AnggaranModel;
use App\Models\bkusModel;
use App\Models\RekeningModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KamarControlleruser extends Controller
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
            'active_sidebukuppuser'=> 'active',
            'breadcumd'            => 'Penatausahaan',
            'breadcumd1'           => 'Penerimaan',
            'breadcumd2'           => 'Buku Pembantu Penerimaan',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );
        
        if ($request->ajax()) {

            $datarealisasi = DB::table('tb_transaksi')
                        ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                        ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                        ->where('tb_transaksi.id_opd', auth()->user()->id_opd)
                        ->get();

            return Datatables::of($datarealisasi)
                    ->addIndexColumn()
                    ->addColumn('nilai_transaksi', function($row) {
                        return number_format($row->nilai_transaksi);
                    })
                    ->rawColumns(['nilai_transaksi'])
                    ->make(true);
        }

        return view('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek_User.Tampilrekapanrekuser' ,$data);
    }

    public function viewdataindexuser(Request $request)
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
            $datarealisasiuser = DB::table('tb_transaksi')
                            ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', 'tb_transaksi.id_rekening', 'tb_transaksi.id_opd' )
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                            // ->where('tb_transaksi.id_opd','like', "%".$request->id_opd."%")
                            ->where('tb_transaksi.id_rekening','like', "%".$request->id_rekening22."%")
                            ->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal1, $request->tgl_akhir1])
                            // ->limit(10)
                            ->where('tb_transaksi.id_opd', auth()->user()->id_opd)
                            ->get();

            return view('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek_User.Viewdatacariuser',['datarealisasiuser' => $datarealisasiuser,]);
        } else {
            $datarealisasiuser1 = DB::table('tb_transaksi')
                            ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', 'tb_transaksi.id_rekening', 'tb_transaksi.id_opd' )
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                            // ->where('tb_transaksi.id_opd','like', "%".$request->id_opd."%")
                            ->where('tb_transaksi.id_rekening','like', "%".$request->id_rekening22."%")
                            ->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal1, $request->tgl_akhir1])
                            // ->limit(10)
                            ->where('tb_transaksi.id_opd', auth()->user()->id_opd)
                            ->get();
            
            $data1user1 = DB::table('tb_transaksi')
                            ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi',  'tb_transaksi.id_rekening')
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                            ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                            // ->where('tb_transaksi.id_opd','like', "%".$request->id_opd."%")
                            ->where('tb_transaksi.id_rekening','like', "%".$request->id_rekening22."%")
                            ->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal1, $request->tgl_akhir1])
                            // ->where('sp2d.nama_skpd','like', "%".$request->nama_skpd."%")
                            ->where('tb_transaksi.id_opd', auth()->user()->id_opd)
                            ->first();
            
            return view('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek_User.Viewdataindexuser',[
                'data' => $data,
                'datarealisasiuser1' => $datarealisasiuser1,
                'data1user1' => $data1user1,
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

}
