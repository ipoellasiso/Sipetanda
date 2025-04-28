<?php

namespace App\Http\Controllers;

use App\Models\PeriodeModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                 => 'Periode',
            'active_master_data'    => 'active',
            'active_subopd'         => 'active',
            'active_sideperiode'    => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Periode',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $dataperiode = DB::table('tb_periode_realisasi')
                        ->select('id', 'periode', 'awal')
                        // ->where('tahun', auth()->user()->tahun)
                        ->get();

            return Datatables::of($dataperiode)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){

                            $btn = '
                                    <a href="javascript:void(0)" title="Edit Data" data-id="'.$row->id.'" class="editPeriode btn btn-primary btn-sm">
                                        <i class="bi bi-pencil-square"></i> 
                                    </a>
                                    ';

                            $btn = $btn.'
                                    <a href="javascript:void(0)" title="Hapus Data" data-id="'.$row->id.'" class="deletePeriode btn btn-danger btn-sm">
                                        <i class="bi bi-trash3"></i> 
                                    </a>
                                    ';

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        return view('Master_Data.Periode.Periode', $data);
    }

    public function store(Request $request)
    {

        $PeriodeId = $request->id;

        // $cekperiode = PeriodeModel::where('id', $request->id)->where('id', '!=', $request->id)->first();
        // if($cekperiode)
        // {
        //     return redirect()->back()->with('error', 'Periode Sudah Ada');
        // } else {
            $details = [
                'periode'       => $request->periode,
                'awal'          => $request->awal,
            ];
        // }
        
        PeriodeModel::updateOrCreate(['id' => $PeriodeId], $details);
            return response()->json(['success' =>'Data Berhasil Disimpan']);
        
    }

    public function edit($id)
    {
        $where = array('id' => $id);
        $opd = PeriodeModel::where($where)->first();

        return response()->json($opd);
    }

    public function destroy($id)
    {

        PeriodeModel::where('id', $id)->delete();

        return response()->json(['success'=>'Data Berhasil Dihapus']);
    }

}
