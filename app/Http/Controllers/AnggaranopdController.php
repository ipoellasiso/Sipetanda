<?php

namespace App\Http\Controllers;

use App\Imports\RekeningImport;
use App\Models\AnggaranopdModel;
use App\Models\RekeningModel;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;
use App\Models\AkunModel;
use App\Models\JenisModel;
use App\Models\KelompokModel;
use App\Models\ObjekModel;
use App\Models\OpdModel;
use App\Models\RincianObjekModel;
use App\Models\SubRincianObjekModel;

class AnggaranopdController extends Controller
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
            'title'                 => 'Data Anggaran Opd',
            'active_master_data'    => 'active',
            'active_subopd'         => 'active',
            'active_sideanggopd'    => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Data Anggaran Opd',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $dataanggaran = DB::table('tb_anggaranopd')
                            ->select('tb_opd.nama_opd', 'tb_anggaranopd.uraian', 'tb_anggaranopd.ket','tb_anggaranopd.nilai_anggaranopd', 'tb_anggaranopd.id_anggaranopd', 'tb_anggaranopd.status1', 'tb_anggaranopd.status2', 'tb_subrincianobjek.rek_sro', 'tb_subrincianobjek.no_rek_sro')
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_anggaranopd.id_opd')
                            ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_anggaranopd.id_subrincianobjek')
                            ->where('tb_anggaranopd.tahun', auth()->user()->tahun)
                            ->where('tb_anggaranopd.id_opd', auth()->user()->id_opd)
                            ->get();

            return Datatables::of($dataanggaran)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id_anggaranopd="'.$row->id_anggaranopd.'" class="editAnggaran btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id_anggaranopd="'.$row->id_anggaranopd.'" class="deleteAnggaran btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->addColumn('nilai_anggaranopd', function($row) {
                        return number_format($row->nilai_anggaranopd);
                    })

                    ->rawColumns(['action', 'nilai_anggaranopd'])
                    ->make(true);
        }

        return view('Master_Data.Anggaran_Opd.Tampil_Anggaranopd', $data);
    }


    public function store(Request $request)
    {
        $ambilopd2 = OpdModel::select('id', 'status1')->where('tb_opd.id', auth()->user()->id_opd)->get();
             foreach($ambilopd2 as $d)
             $ambilopd2  = $d->id;

        $anggaranId = $request->id_anggaranopd;
        
        $cekanggaran = AnggaranopdModel::where('id_subrincianobjek', $request->id_subrincianobjek)->where('id_anggaranopd', '!=', $request->id_anggaranopd)->first();

        if($cekanggaran)
        {
            return response()->json(['error'=>'Nomor sudah ada']);
        }
        else
        {
            $details = [
                'id_akun'             => $request->id_akun,
                'id_kelompok'         => $request->id_kelompok,
                'id_jenis'            => $request->id_jenis,
                'id_objek'            => $request->id_objek,
                'id_rincianobjek'     => $request->id_rincianobjek,
                'id_subrincianobjek'  => $request->id_subrincianobjek,
                'id_opd'              => $ambilopd2,          
                'uraian'              => $request->uraian,
                'nilai_anggaranopd'   => str_replace('.','',$request->nilai_anggaranopd),
                'tahun'               => date('Y'),
            ];
        }
        
            AnggaranopdModel::updateOrCreate(['id_anggaranopd' => $anggaranId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function edit($id_anggaranopd)
    {
        $where = array('id_anggaranopd' => $id_anggaranopd);
        // $anggaran = AnggaranopdModel::where($where)->first();

        // return response()->json($anggaran);

        // $where = array('id_anggaranopd' => $id_anggaranopd);
        $anggaran = DB::table('tb_anggaranopd')
                    ->select('tb_anggaranopd.uraian', 'tb_anggaranopd.ket','tb_anggaranopd.nilai_anggaranopd', 'tb_anggaranopd.id_anggaranopd', 'tb_anggaranopd.status1', 'tb_anggaranopd.status2', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_jenis.id_jen', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen', 'tb_objek.id_o', 'tb_objek.no_rek_o', 'tb_objek.rek_o', 'tb_rincianobjek.rek_ro', 'tb_rincianobjek.no_rek_ro', 'tb_rincianobjek.id_ro', 'tb_subrincianobjek.rek_sro', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.id_sro',)
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_anggaranopd.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_anggaranopd.id_kelompok')
                    ->join('tb_jenis', 'tb_jenis.id_jen', '=', 'tb_anggaranopd.id_jenis')
                    ->join('tb_objek', 'tb_objek.id_o', '=', 'tb_anggaranopd.id_objek')
                    ->join('tb_rincianobjek', 'tb_rincianobjek.id_ro', '=', 'tb_anggaranopd.id_rincianobjek')
                    ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_anggaranopd.id_subrincianobjek')
                    ->where($where)->first();

        return response()->json($anggaran);
    }

    public function destroy($id_anggaranopd)
    {

        AnggaranopdModel::where('id_anggaranopd', $id_anggaranopd)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
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
}
