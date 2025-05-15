<?php

namespace App\Http\Controllers;

use App\Models\OpdModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class TarikSp2dController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = array(
            'title'                 => 'Tarik SP2D di SIPD',
            'active_master_data'    => 'active',
            'active_subtariksp2d'   => 'active',
            'active_sidetariksp2d'  => 'active',
            'breadcumd'             => 'Pengaturan',
            'breadcumd1'            => 'Master Data',
            'breadcumd2'            => 'Tarik SP2D',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
        );

        

        return view('Master_Data.Sp2d_Sipd.Sp2d_Sipd', $data);
    }

}
