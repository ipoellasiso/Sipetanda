<?php

namespace App\Http\Controllers;

use App\Imports\jenisImport;
use App\Models\jenisModel;
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
            'title'                 => 'Data Akun',
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
                        ->select('id', 'id_akun', 'id_kelompok', 'no_rek', 'rek')
                        ->join('opd', 'users.id_opd', 'opd.id',)
                        ->get();

            return Datatables::of($datarek)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id="'.$row->id.'" class="editRekjenis btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id="'.$row->id.'" class="deleteRekjenis btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Rek_jenis.Tampilrekjenis', $data);
    }

     public function store(Request $request)
    {
        $rekId = $request->id;

        $cekrek = jenisModel::where('no_rek', $request->no_rek)->where('id', '!=', $request->id)->first();
        if($cekrek)
        {
            return redirect()->back()->with('error', 'Nomor Rekening Sudah Ada');
        } else {

            $details = [
                'id_akun'      => $request->id_akun,
                'id_kelompok'  => $request->id_kelompok,
                'no_rek'       => $request->no_rek,
                'rek'          => $request->rek,
            ];
        }
        
            jenisModel::updateOrCreate(['id' => $rekId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $rekId = jenisModel::where($where)->first();

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

    public function destroy($id)
    {
        jenisModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }
}
