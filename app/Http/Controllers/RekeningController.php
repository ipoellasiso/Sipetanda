<?php

namespace App\Http\Controllers;

use App\Imports\RekeningImport;
use App\Models\RekeningModel;
use Illuminate\Hashing\HashServiceProvider;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\UserModel;

class RekeningController extends Controller
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
            'title'                 => 'Data Rekening',
            'active_master_data'    => 'active',
            'active_subopd'         => 'active',
            'active_siderek'        => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Data Rekening',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $datarek = DB::table('tb_rekening')
                        ->select('tb_rekening.id_rekening', 'tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_rekening.ket1', 'tb_rekening.ket2', 'tb_rekening.ket3', 'tb_rekening.ket4',)
                        // ->join('opd', 'users.id_opd', 'opd.id',)
                        ->get();

            return Datatables::of($datarek)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id_rekening="'.$row->id_rekening.'" class="editRekening btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id_rekening="'.$row->id_rekening.'" class="deleteRek btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Rekening.Rekening', $data);
    }


    public function store(Request $request)
    {
        $rekId = $request->id_rekening;
        
        $cekrek = RekeningModel::where('no_rekening', $request->no_rekening)->where('id_rekening', '!=', $request->id_rekening)->first();

        if($cekrek)
        {
            return response()->json(['error'=>'Nomor sudah ada']);
        }
        else
        {
            $details = [
                'ket4'              => $request->ket4,
                'ket1'              => $request->ket1,
                'ket2'              => $request->ket2,
                'ket3'              => $request->ket3,
                'no_rekening'       => $request->no_rekening,
                'rekening'          => $request->rekening,
                'rekening2'         => $request->rekening2,
            ];
        }
        
            RekeningModel::updateOrCreate(['id_rekening' => $rekId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function edit($id_rekening)
    {
        $where = array('id_rekening' => $id_rekening);
        $rek = RekeningModel::where($where)->first();

        return response()->json($rek);
    }

    public function destroy($id_rekening)
    {

        RekeningModel::where('id_rekening', $id_rekening)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new RekeningImport;
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilrekening')->with('success', 'Data Berhasil di import');
    }

}
