<?php

namespace App\Http\Controllers;

use App\Imports\jenisImport;
use App\Imports\ObjekImport;
use App\Imports\RincianobjekImport;
use App\Models\AkunModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use App\Models\ObjekModel;
use App\Models\RincianObjekModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;

class RincianObjekController extends Controller
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
            'title'                 => 'Data Rincian Objek',
            'active_master_data'    => 'active',
            'active_subopd'         => 'active',
            'active_sidero'         => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Data Rekening Rincian Objek',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $datarek = DB::table('tb_rincianobjek')
                    ->select('tb_rincianobjek.id_ro', 'tb_rincianobjek.id_akun', 'tb_rincianobjek.id_kelompok', 'tb_rincianobjek.id_jenis', 'tb_rincianobjek.id_objek', 'tb_rincianobjek.no_rek_ro', 'tb_rincianobjek.rek_ro', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_jenis.id_jen', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen', 'tb_objek.id_o', 'tb_objek.no_rek_o', 'tb_objek.rek_o',)
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_rincianobjek.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_rincianobjek.id_kelompok')
                    ->join('tb_jenis', 'tb_jenis.id_jen', '=', 'tb_rincianobjek.id_jenis')
                    ->join('tb_objek', 'tb_objek.id_o', '=', 'tb_rincianobjek.id_objek')
                    ->get();

            return Datatables::of($datarek)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id_ro="'.$row->id_ro.'" class="editRekrincianobjek btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id_ro="'.$row->id_ro.'" class="deleteRekrincianobjek btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Rek_Rincianobjek.Tampilrekrincianobjek', $data);
    }

     public function store(Request $request)
    {
        $rekId = $request->id_ro;

        $cekrek = RincianObjekModel::where('no_rek_ro', $request->no_rek_ro)->where('id_ro', '!=', $request->id_ro)->first();
        if($cekrek)
        {
            return redirect()->back()->with('error', 'Nomor Rekening Sudah Ada');
        } else {

            $details = [
                'id_akun'        => $request->id_akun,
                'id_kelompok'    => $request->id_kelompok,
                'id_jenis'       => $request->id_jenis,
                'id_objek'       => $request->id_objek,
                'no_rek_ro'       => $request->no_rek_ro,
                'rek_ro'          => $request->rek_ro,
            ];
        }
        
            RincianObjekModel::updateOrCreate(['id_ro' => $rekId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function edit($id_ro)
    {
        $where = array('id_ro' => $id_ro);
        $rekId = DB::table('tb_rincianobjek')
                    ->select('tb_rincianobjek.id_ro', 'tb_rincianobjek.id_akun', 'tb_rincianobjek.id_kelompok', 'tb_rincianobjek.id_jenis', 'tb_rincianobjek.id_objek', 'tb_rincianobjek.no_rek_ro', 'tb_rincianobjek.rek_ro', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_jenis.id_jen', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen', 'tb_objek.id_o', 'tb_objek.no_rek_o', 'tb_objek.rek_o',)
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_rincianobjek.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_rincianobjek.id_kelompok')
                    ->join('tb_jenis', 'tb_jenis.id_jen', '=', 'tb_rincianobjek.id_jenis')
                    ->join('tb_objek', 'tb_objek.id_o', '=', 'tb_rincianobjek.id_objek')
                    ->where($where)->first();

        return response()->json($rekId);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new RincianobjekImport();
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilrekrincianobjek')->with('success', 'Data Berhasil di import');
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

    public function destroy($id_ro)
    {
        RincianObjekModel::where('id_ro', $id_ro)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
