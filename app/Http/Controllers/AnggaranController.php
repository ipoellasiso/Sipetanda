<?php

namespace App\Http\Controllers;

use App\Imports\AnggaranImport;
use App\Imports\BkusImport;
use App\Models\bkusModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AnggaranController extends Controller
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
            'title'                     => 'Target Anggaran Pendapatan',
            'active_master_data'        => 'active',
            'active_subopd'             => 'active',
            'active_sideanggaran'       => 'active',
            'breadcumd'                 => 'Pengaturan',
            'breadcumd1'                => 'Master Data',
            'breadcumd2'                => 'Target Anggaran Pendapatan',
            'userx'                     => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        if ($request->ajax()) {

            $dataanggaran = DB::table('tb_anggaran')
                        ->select('tb_rekening.no_rekening', 'tb_rekening.rekening', 'tb_rekening.rekening2', 'tb_opd.nama_opd', 'tb_anggaran.nilai')
                        ->join('tb_opd', 'tb_opd.id', '=', 'tb_anggaran.id_opd')
                        ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_anggaran.id_rekening')
                        ->where('tb_anggaran.tahun', auth()->user()->tahun)
                        ->get();

            return Datatables::of($dataanggaran)
                    ->addIndexColumn()
                    ->addColumn('nilai', function($row) {
                        return number_format($row->nilai);
                    })
                    ->rawColumns(['nilai'])
                    ->make(true);
        }

        return view('Master_Data.Anggaran.Tampilanggaran', $data);
    }

    public function import(Request $request)
    {
        $file = $request->file('file')->store('public/import');
        $import = new AnggaranImport();
        $import->import($file);

        // dd($import->failures());
        if ($import->failures()->isNotEmpty())
        {
            return back()->withFailures($import->failures())->with('error', 'beberapa data sudah ada dan data belum ada akan disimpan ');
        }

        return redirect('/tampilanggaran')->with('success', 'Data Berhasil di import');
    }

}
