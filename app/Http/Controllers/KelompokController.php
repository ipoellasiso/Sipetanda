<?php

namespace App\Http\Controllers;

use App\Imports\AkunImport;
use App\Imports\KelompokImport;
use App\Models\AkunModel;
use App\Models\KelompokModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\UserModel;

class KelompokController extends Controller
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
            'title'                 => 'Data Kelompok',
            'active_master_data'    => 'active',
            'active_subopd'         => 'active',
            'active_side'           => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Data Rekening Kelompok',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $datarek = DB::table('tb_kelompok')
                    ->select('tb_kelompok.id_kel', 'tb_kelompok.id_akun', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id')
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_kelompok.id_akun')
                    ->get();

            return Datatables::of($datarek)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id_kel="'.$row->id_kel.'" class="editRekkelompok btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id_kel="'.$row->id_kel.'" class="deleteRekkelompok btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Rek_Kelompok.Tampilrekkelompok', $data);
    }

     public function store(Request $request)
    {
        $rekId = $request->id_kel;

        $cekrek = KelompokModel::where('no_rek_kel', $request->no_rek)->where('id_kel', '!=', $request->id_kel)->first();
        if($cekrek)
        {
            return redirect()->back()->with('error', 'Nomor Rekening Sudah Ada');
        } else {

            $details = [
                'id_akun'          => $request->id_akun,
                'no_rek_kel'       => $request->no_rek_kel,
                'rek_kel'          => $request->rek_kel,
            ];
        }
        
            KelompokModel::updateOrCreate(['id_kel' => $rekId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function edit($id_kel)
    {
        $where = array('id_kel' => $id_kel);
        $rekId = DB::table('tb_kelompok')
                    ->select('tb_kelompok.id_kel', 'tb_kelompok.id_akun', 'tb_kelompok.no_rek_kel', 'tb_kelompok.rek_kel', 'tb_akun.no_rek', 'tb_akun.rek', 'tb_akun.id')
                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_kelompok.id_akun')
                    ->where($where)->first();

        return response()->json($rekId);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new KelompokImport();
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilrekkelompok')->with('success', 'Data Berhasil di import');
    }

    public function getDataakun(Request $request)
    {
        $search = $request->searchAkun;
  
        if($search == ''){
            $akun = AkunModel::orderBy('rek','asc')->select('id','rek')->limit(5)->get();
        }else{
            $akun = AkunModel::orderBy('rek','asc')->select('id','rek')->where('rek', 'like', '%' .$search . '%')->limit(5)->get();
        }
  
        $response = array();
        foreach($akun as $row){
            $response[] = array(
                "id"   => $row->id,
                "text" => $row->rek
            );
        }

        return response()->json($response); 
    } 

    public function destroy($id_kel)
    {
        KelompokModel::where('id_kel', $id_kel)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
