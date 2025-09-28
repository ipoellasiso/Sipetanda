<?php

namespace App\Http\Controllers;

use App\Imports\jenisImport;
use App\Models\AkunModel;
use App\Models\jenisModel;
use App\Models\KelompokModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;

class JenisController extends Controller
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
            'title'                 => 'Data Jenis',
            'active_master_data'    => 'active',
            'active_subopd'         => 'active',
            'active_sidejenis'      => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Data Rekening Jenis',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $datarek = DB::table('tb_jenis')
                    ->select('tb_jenis.id_jen', 'tb_jenis.id_akun', 'tb_jenis.id_kelompok', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel')
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_jenis.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_jenis.id_kelompok')
                    ->get();

            return Datatables::of($datarek)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id_jen="'.$row->id_jen.'" class="editRekjenis btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id_jen="'.$row->id_jen.'" class="deleteRekjenis btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Rek_Jenis.Tampilrekjenis', $data);
    }

     public function store(Request $request)
    {
        $rekId = $request->id_jen;

        $cekrek = jenisModel::where('no_rek_jen', $request->no_rek_jen)->where('id_jen', '!=', $request->id_jen)->first();
        if($cekrek)
        {
            return redirect()->back()->with('error', 'Nomor Rekening Sudah Ada');
        } else {

            $details = [
                'id_akun'      => $request->id_akun,
                'id_kelompok'  => $request->id_kelompok,
                'no_rek_jen'       => $request->no_rek_jen,
                'rek_jen'          => $request->rek_jen,
            ];
        }
        
            jenisModel::updateOrCreate(['id_jen' => $rekId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function edit($id_jen)
    {
        // $where = array('id_jen' => $id_jen);
        // $rekId = jenisModel::where($where)->first();

        // return response()->json($rekId);

        $where = array('id_jen' => $id_jen);
        $rekId = DB::table('tb_jenis')
                    ->select('tb_jenis.id_jen', 'tb_jenis.id_akun', 'tb_jenis.id_kelompok', 'tb_jenis.no_rek_jen', 'tb_jenis.rek_jen', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id', 'tb_kelompok.id_kel', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel')
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_jenis.id_akun')
                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_jenis.id_kelompok')
                    ->where($where)->first();

        return response()->json($rekId);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new jenisImport();
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilrekjenis')->with('success', 'Data Berhasil di import');
    }

    public function getDataakun(){
        $data = AkunModel::where('rek', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data);
    }

    public function getDatakelompok($id){
        $data = KelompokModel::where('id_akun', $id)->where('rek_kel', 'LIKE', '%'.request('q').'%')->paginate(10);

        return response()->json($data);
    }

    // public function getDataakun(Request $request)
    // {
    //     $search = $request->searchAkun;
  
    //     if($search == ''){
    //         $akun = AkunModel::orderBy('rek','asc')->select('id','rek')->limit(5)->get();
    //     }else{
    //         $akun = AkunModel::orderBy('rek','asc')->select('id','rek')->where('rek', 'like', '%' .$search . '%')->limit(5)->get();
    //     }
  
    //     $response = array();
    //     foreach($akun as $row){
    //         $response[] = array(
    //             "id"   => $row->id,
    //             "text" => $row->rek
    //         );
    //     }

    //     return response()->json($response); 
    // } 

    // public function getDatakelompok(Request $request)
    // {
    //     $search = $request->searchKel;
  
    //     if($search == ''){
    //         $akun = KelompokModel::orderBy('rek_kel','asc')->select('id_kel','rek_kel')->limit(5)->get();
    //     }else{
    //         $akun = KelompokModel::orderBy('rek_kel','asc')->select('id_kel','rek_kel')->where('rek_kel', 'like', '%' .$search . '%')->limit(5)->get();
    //     }
  
    //     $response = array();
    //     foreach($akun as $row){
    //         $response[] = array(
    //             "id"   => $row->id_kel,
    //             "text" => $row->rek_kel
    //         );
    //     }

    //     return response()->json($response); 
    // } 

    public function destroy($id_jen)
    {
        jenisModel::where('id_jen', $id_jen)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
