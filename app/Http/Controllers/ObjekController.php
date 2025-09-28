<?php

namespace App\Http\Controllers;

use App\Imports\jenisImport;
use App\Imports\ObjekImport;
use App\Models\AkunModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use App\Models\ObjekModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;

class ObjekController extends Controller
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
            'title'                 => 'Data Objek',
            'active_master_data'    => 'active',
            'active_subopd'         => 'active',
            'active_sideo'          => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Data Rekening Objek',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $datarek = DB::table('tb_objek')
                    ->select('tb_objek.id_o', 'tb_objek.id_akun', 'tb_objek.id_kelompok', 'tb_objek.id_jenis', 'tb_objek.no_rek_o', 'tb_objek.rek_o', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_jenis.id_jen', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen',)
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_objek.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_objek.id_kelompok')
                    ->join('tb_jenis', 'tb_jenis.id_jen', '=', 'tb_objek.id_jenis')
                    ->get();

            return Datatables::of($datarek)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id_o="'.$row->id_o.'" class="editRekobjek btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id_o="'.$row->id_o.'" class="deleteRekobjek btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Rek_Objek.Tampilrekobjek', $data);
    }

     public function store(Request $request)
    {
        $rekId = $request->id_o;

        $cekrek = ObjekModel::where('no_rek_o', $request->no_rek_o)->where('id_o', '!=', $request->id_o)->first();
        if($cekrek)
        {
            return redirect()->back()->with('error', 'Nomor Rekening Sudah Ada');
        } else {

            $details = [
                'id_akun'        => $request->id_akun,
                'id_kelompok'    => $request->id_kelompok,
                'id_jenis'       => $request->id_jenis,
                'no_rek_o'       => $request->no_rek_o,
                'rek_o'          => $request->rek_o,
            ];
        }
        
            ObjekModel::updateOrCreate(['id_o' => $rekId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function edit($id_o)
    {
        $where = array('id_o' => $id_o);
        $rekId = DB::table('tb_objek')
                    ->select('tb_objek.id_o', 'tb_objek.id_akun', 'tb_objek.id_kelompok', 'tb_objek.id_jenis', 'tb_objek.no_rek_o', 'tb_objek.rek_o', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_jenis.id_jen', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen',)
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_objek.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_objek.id_kelompok')
                    ->join('tb_jenis', 'tb_jenis.id_jen', '=', 'tb_objek.id_jenis')
                    ->where($where)->first();

        return response()->json($rekId);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new ObjekImport();
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilrekobjek')->with('success', 'Data Berhasil di import');
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

    public function destroy($id_o)
    {
        ObjekModel::where('id_o', $id_o)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
