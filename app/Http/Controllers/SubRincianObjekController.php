<?php

namespace App\Http\Controllers;

use App\Imports\jenisImport;
use App\Imports\ObjekImport;
use App\Imports\RincianobjekImport;
use App\Imports\SubrincianobjekImport;
use App\Models\AkunModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use App\Models\ObjekModel;
use App\Models\RincianObjekModel;
use App\Models\SubRincianObjekModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;

class SubRincianObjekController extends Controller
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
            'title'                 => 'Data Sub Rincian Objek',
            'active_master_data'    => 'active',
            'active_subopd'         => 'active',
            'active_sidesro'        => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Data Rekening Sub Rincian Objek',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $datarek = DB::table('tb_subrincianobjek')
                    ->select('tb_subrincianobjek.id_sro', 'tb_subrincianobjek.id_akun', 'tb_subrincianobjek.id_kelompok', 'tb_subrincianobjek.id_jenis', 'tb_subrincianobjek.id_objek', 'tb_subrincianobjek.id_rincianobjek', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_jenis.id_jen', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen', 'tb_objek.id_o', 'tb_objek.no_rek_o', 'tb_objek.rek_o', 'tb_rincianobjek.rek_ro', 'tb_rincianobjek.no_rek_ro', 'tb_rincianobjek.id_ro',)
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_subrincianobjek.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_subrincianobjek.id_kelompok')
                    ->join('tb_jenis', 'tb_jenis.id_jen', '=', 'tb_subrincianobjek.id_jenis')
                    ->join('tb_objek', 'tb_objek.id_o', '=', 'tb_subrincianobjek.id_objek')
                    ->join('tb_rincianobjek', 'tb_rincianobjek.id_ro', '=', 'tb_subrincianobjek.id_rincianobjek')
                    ->get();

            return Datatables::of($datarek)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id_sro="'.$row->id_sro.'" class="editReksubrincianobjek btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id_sro="'.$row->id_sro.'" class="deleteReksubrincianobjek btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Rek_Subrincianobjek.Tampilreksubrincianobjek', $data);
    }

     public function store(Request $request)
    {
        $rekId = $request->id_sro;

        $cekrek = SubRincianObjekModel::where('no_rek_sro', $request->no_rek_sro)->where('id_sro', '!=', $request->id_sro)->first();
        if($cekrek)
        {
            return redirect()->back()->with('error', 'Nomor Rekening Sudah Ada');
        } else {

            $details = [
                'id_akun'           => $request->id_akun,
                'id_kelompok'       => $request->id_kelompok,
                'id_jenis'          => $request->id_jenis,
                'id_objek'          => $request->id_objek,
                'id_rincianobjek'   => $request->id_rincianobjek,
                'no_rek_sro'        => $request->no_rek_sro,
                'rek_sro'           => $request->rek_sro,
            ];
        }
        
            SubRincianObjekModel::updateOrCreate(['id_sro' => $rekId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function edit($id_sro)
    {
        $where = array('id_sro' => $id_sro);
        $rekId = DB::table('tb_subrincianobjek')
                    ->select('tb_subrincianobjek.id_sro', 'tb_subrincianobjek.id_akun', 'tb_subrincianobjek.id_kelompok', 'tb_subrincianobjek.id_jenis', 'tb_subrincianobjek.id_objek', 'tb_subrincianobjek.id_rincianobjek', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_jenis.id_jen', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen', 'tb_objek.id_o', 'tb_objek.no_rek_o', 'tb_objek.rek_o', 'tb_rincianobjek.rek_ro', 'tb_rincianobjek.no_rek_ro', 'tb_rincianobjek.id_ro',)
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_subrincianobjek.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_subrincianobjek.id_kelompok')
                    ->join('tb_jenis', 'tb_jenis.id_jen', '=', 'tb_subrincianobjek.id_jenis')
                    ->join('tb_objek', 'tb_objek.id_o', '=', 'tb_subrincianobjek.id_objek')
                    ->join('tb_rincianobjek', 'tb_rincianobjek.id_ro', '=', 'tb_subrincianobjek.id_rincianobjek')
                    ->where($where)->first();

        return response()->json($rekId);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new SubrincianobjekImport();
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilreksubrincianobjek')->with('success', 'Data Berhasil di import');
    }

    public function getDataakun(){
        $data = AkunModel::where('rek', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data);
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

    public function destroy($id_sro)
    {
        SubRincianObjekModel::where('id_sro', $id_sro)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
