<?php

namespace App\Http\Controllers;

use App\Imports\BkuImport;
use App\Imports\BkusImport;
use App\Models\AkunpajakModel;
use App\Models\BankModel;
use App\Models\BkuModel;
use App\Models\bkusModel;
use App\Models\OpdModel;
use App\Models\Potongan2Model;
use App\Models\PotonganModel;
use App\Models\RekeningModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Psy\Command\WhereamiCommand;


class BkuController extends Controller
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
            'total_jan_mandiri'    => bkusModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-01-01', '2025-01-31'])->sum('nilai_transaksi'),
            'total_jan_bpd'        => bkusModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-01-01', '2025-01-31'])->sum('nilai_transaksi'),
            'total_jan_btn'        => bkusModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-01-01', '2025-01-31'])->sum('nilai_transaksi'),
            'total_jan'            => bkusModel::whereBetween('tb_transaksi.tgl_transaksi', ['2025-01-01', '2025-01-31'])->where('tahun', auth()->user()->tahun)->sum('nilai_transaksi'),
            'total_mar_mandiri'    => bkusModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-03-01', '2025-03-31'])->sum('nilai_transaksi'),
            'total_mar_bpd'        => bkusModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-03-01', '2025-03-31'])->sum('nilai_transaksi'),
            'total_mar_btn'        => bkusModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-03-01', '2025-03-31'])->sum('nilai_transaksi'),
            'total_mar'            => bkusModel::whereBetween('tb_transaksi.tgl_transaksi', ['2025-03-01', '2025-03-31'])->where('tahun', auth()->user()->tahun)->sum('nilai_transaksi'),
            'total_feb_mandiri'    => bkusModel::where('id_bank', '1')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-02-01', '2025-02-28'])->sum('nilai_transaksi'),
            'total_feb_bpd'        => bkusModel::where('id_bank', '2')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-02-01', '2025-02-28'])->sum('nilai_transaksi'),
            'total_feb_btn'        => bkusModel::where('id_bank', '3')->where('tahun', auth()->user()->tahun)->whereBetween('tb_transaksi.tgl_transaksi', ['2025-02-01', '2025-02-28'])->sum('nilai_transaksi'),
            'total_feb'            => bkusModel::whereBetween('tb_transaksi.tgl_transaksi', ['2025-02-01', '2025-02-28'])->where('tahun', auth()->user()->tahun)->sum('nilai_transaksi'),
        );

        if ($request->ajax()) {

            $databku = DB::table('tb_transaksi')
                        ->select('tb_rekening.id_rekening', 'tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                        ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                        ->orderBy('no_buku', 'asc')
                        ->where('tb_transaksi.tahun', auth()->user()->tahun)
                        ->get();

            return Datatables::of($databku)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '    <div class="dropdown">
                                            <button class="btn btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <li><a class="editBku dropdown-item" data-id_transaksi="'.$row->id_transaksi.'" href="javascript:void(0)">Ubah</a></li>
                                                <li><a class="deleteBku dropdown-item" data-id_transaksi="'.$row->id_transaksi.'" href="javascript:void(0)">Delete</a></li>
                                                <li><a class="lihatBku dropdown-item" data-id_transaksi="'.$row->id_transaksi.'" href="/bku/lihat/'.$row->id_transaksi.'">Lihat</a></li>
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

        return view('Penatausahaan.Penerimaan.Bku.Tampilbku', $data);
    }

    public function store(Request $request)
    {
        $bkuId = $request->id_transaksi;

        $cekbku = bkusModel::where('no_buku', $request->no_buku)->where('id_transaksi', '!=', $request->id_transaksi)->first();
        if($cekbku)
        {
            return redirect()->back()->with('error', 'Nomor Buku/Bukti Sudah Ada');
        } else {

        // $opdId = $request->id;

        // $cekopd = OpdModel::where('nama_opd', $request->nama_opd)->where('id', '!=', $request->id)->first();
        // if($cekopd)
        // {
        //     return redirect()->back()->with('error', 'OPD Sudah Ada');
        // } else {
            $details = [
                'id_rekening'       => $request->id_rekening,
                'id_opd'            => $request->id_opd,
                'id_bank'           => $request->id_bank,
                'uraian'            => $request->uraian,
                'ket'               => $request->ket,
                'no_buku'           => $request->no_buku,
                'tgl_transaksi'     => $request->tgl_transaksi,
                'nilai_transaksi'   => str_replace('.','',$request->nilai_transaksi),
                'tahun'             => date('Y'),
            ];
        }
        
            bkusModel::updateOrCreate(['id_transaksi' => $bkuId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function edit($id_transaksi)
    {
        $where = array('id_transaksi' => $id_transaksi);
        // $bku = bkusModel::where($where)->first();
        $bku = DB::table('tb_transaksi')
                        ->select('tb_rekening.id_rekening', 'tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_transaksi.uraian', 'tb_transaksi.ket', 'tb_transaksi.uraian', 'tb_transaksi.no_buku', 'tb_transaksi.tgl_transaksi', 'tb_transaksi.nilai_transaksi', 'tb_transaksi.id_transaksi', 'tb_opd.id', 'tb_bank.id_bank' )
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                        ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                        ->join('tb_bank', 'tb_bank.id_bank', 'tb_transaksi.id_bank')
                        ->where($where)->first();

        return response()->json($bku);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new BkusImport();
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilbku')->with('success', 'Data Berhasil di import');
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

    public function destroy($id_transaksi)
    {
        // $data = bkusModel::where('id',$id_transaksi)->first(['bukti_pemby']);
        // unlink("app/assets/images/bukti_pemby_pajak/".$data->bukti_pemby);

        bkusModel::where('id_transaksi', $id_transaksi)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
