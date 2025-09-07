<?php

namespace App\Http\Controllers;

use App\Imports\AkunImport;
use App\Imports\RekeningImport;
use App\Models\AkunModel;
use App\Models\RekeningModel;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class AkunController extends Controller
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
            'active_sideakun'       => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Data Akun',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $datarek = DB::table('tb_akun')
                        ->select('id', 'no_rek', 'rek')
                        // ->join('opd', 'users.id_opd', 'opd.id',)
                        ->get();

            return Datatables::of($datarek)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id="'.$row->id.'" class="editRekakun btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id="'.$row->id.'" class="deleteRekakun btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Rek_Akun.Tampilrekakun', $data);
    }

     public function store(Request $request)
    {
        $rekakunId = $request->id;

        $cekrekakun = AkunModel::where('no_rek', $request->no_rek)->where('id', '!=', $request->id)->first();
        if($cekrekakun)
        {
            return redirect()->back()->with('error', 'Nomor Rekening Sudah Ada');
        } else {

            $details = [
                'no_rek'       => $request->no_rek,
                'rek'          => $request->rek,
            ];
        }
        
            AkunModel::updateOrCreate(['id' => $rekakunId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $rekakunId = AkunModel::where($where)->first();

        return response()->json($rekakunId);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new AkunImport();
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilrekakun')->with('success', 'Data Berhasil di import');
    }

    public function destroy($id)
    {
        AkunModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

}
