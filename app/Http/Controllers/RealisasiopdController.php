<?php

namespace App\Http\Controllers;

use App\Models\AkunModel;
use App\Models\AnggaranModel;
use App\Models\bkusModel;
use App\Models\Anggaran;
use App\Models\AnggaranopdModel;
use App\Models\Transaksi;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RealisasiopdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Get data
        public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $tahun  = Auth::user()->tahun;
        $id_opd = Auth::user()->id_opd;

        $data = array(
            'title'                => 'Laporan Realisasi',
            'active_penerimaan'    => 'active',
            'active_sub'           => 'active',
            'active_siderealisasi' => 'active',
            'breadcumd'            => 'Penatausahaan',
            'breadcumd1'           => 'Laporan',
            'breadcumd2'           => 'Realisasi',
            'userx'                => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),

            'dataq'                => DB::table('tb_bkuopd')
                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_bkuopd.id_akun')
                                    ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                                    ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                                    ->select([ 'tb_akun.rek', 'tb_akun.no_rek',
                                        DB::raw('sum(tb_bkuopd.nilai_transaksi) as nilai_transaksi'),
                                      ])
                                    ->groupBy(['tb_akun.rek', 'tb_akun.no_rek'])
                                    ->get(),

            'dataq2'               => DB::table('tb_bkuopd')
                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                                    ->join('tb_kelompok', 'tb_kelompok.id_kel', '=', 'tb_bkuopd.id_kelompok')
                                    ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                                    ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                                    ->select([ 'tb_kelompok.rek_kel', 'tb_kelompok.no_rek_kel', 'tb_bkuopd.id_kelompok',
                                        DB::raw('sum(tb_bkuopd.nilai_transaksi) as nilai_transaksi_kel'),
                                      ])
                                    ->groupBy(['tb_kelompok.rek_kel', 'tb_kelompok.no_rek_kel', 'tb_bkuopd.id_kelompok'])
                                    ->get(),
            
            'dataq3'               => DB::table('tb_bkuopd')
                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                                    ->join('tb_jenis', 'tb_jenis.id_jen', '=', 'tb_bkuopd.id_jenis')
                                    ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                                    ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                                    ->select([ 'tb_jenis.rek_jen', 'tb_jenis.no_rek_jen', 'tb_bkuopd.id_jenis',
                                        DB::raw('sum(tb_bkuopd.nilai_transaksi) as nilai_transaksi_jen'),
                                      ])
                                    ->groupBy(['tb_jenis.rek_jen', 'tb_jenis.no_rek_jen', 'tb_bkuopd.id_jenis'])
                                    ->get(),

            'dataq4'               => DB::table('tb_bkuopd')
                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                                    ->join('tb_objek', 'tb_objek.id_o', '=', 'tb_bkuopd.id_objek')
                                    ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                                    ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                                    ->select([ 'tb_objek.rek_o',
                                               'tb_objek.no_rek_o',
                                               'tb_bkuopd.id_objek',
                                               'tb_bkuopd.id_jenis',
                                        DB::raw('sum(tb_bkuopd.nilai_transaksi) as nilai_transaksi_o'),
                                      ])
                                    ->groupBy(['tb_objek.rek_o', 'tb_objek.no_rek_o', 'tb_bkuopd.id_objek', 'tb_bkuopd.id_jenis'])
                                    ->get(),

            'dataq5'               => DB::table('tb_bkuopd')
                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                                    ->join('tb_rincianobjek', 'tb_rincianobjek.id_ro', '=', 'tb_bkuopd.id_rincianobjek')
                                    ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                                    ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                                    ->select([ 'tb_rincianobjek.rek_ro',
                                               'tb_rincianobjek.no_rek_ro',
                                               'tb_bkuopd.id_objek',
                                               'tb_bkuopd.id_rincianobjek',
                                        DB::raw('sum(tb_bkuopd.nilai_transaksi) as nilai_transaksi_ro'),
                                      ])
                                    ->groupBy(['tb_rincianobjek.rek_ro', 'tb_rincianobjek.no_rek_ro', 'tb_bkuopd.id_objek', 'tb_bkuopd.id_rincianobjek'])
                                    ->get(),

            'dataq6'               => DB::table('tb_bkuopd')
                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                                    ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_bkuopd.id_akun')
                                    ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                                    ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                                    ->select([ 'tb_subrincianobjek.rek_sro',
                                               'tb_subrincianobjek.no_rek_sro',
                                               'tb_bkuopd.id_rincianobjek',
                                                DB::raw('sum(tb_bkuopd.nilai_transaksi) as nilai_transaksi_sro'),
                                      ])
                                    ->groupBy(['tb_subrincianobjek.rek_sro', 'tb_subrincianobjek.no_rek_sro', 'tb_bkuopd.id_rincianobjek'])
                                    ->get(),
                            
            'datainduk'            => DB::table('tb_bkuopd')
                                    ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro', 'tb_akun.rek', 'tb_opd.nama_bendahara', 'tb_opd.nip_bendahara', 'tb_opd.nama_kepala_opd', 'tb_opd.nip_kepala_opd', 'tb_opd.jabatan',)

                                    ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                                    ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                                    ->join('tb_akun', 'tb_akun.id', '=', 'tb_bkuopd.id_akun')
                                    ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                                    // ->whereIn('tb_bkuopd.status1', ['Input'])
                                    ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                                    ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                                    ->first(),

            
            'akuns'                => AkunModel::whereHas('kelompok.jenis.objek.rincian.subrincian.anggaran.bku', function($q) use ($tahun, $id_opd) {
                                          $q->where('tahun', $tahun)
                                            ->where('id_opd', $id_opd);
                                      })
                                      ->with([
                                          'kelompok' => function($q) use ($tahun, $id_opd) {
                                              $q->whereHas('jenis.anggaran', function($q) use ($tahun, $id_opd) {
                                                  $q->where('tahun', $tahun)
                                                    ->where('id_opd', $id_opd);
                                              });
                                          },
                                          'kelompok.jenis' => function($q) use ($tahun, $id_opd) {
                                              $q->whereHas('anggaran', function($q) use ($tahun, $id_opd) {
                                                  $q->where('tahun', $tahun)
                                                    ->where('id_opd', $id_opd);
                                              });
                                          },
                                          'kelompok.jenis.objek' => function($q) use ($tahun, $id_opd) {
                                              $q->whereHas('anggaran', function($q) use ($tahun, $id_opd) {
                                                  $q->where('tahun', $tahun)
                                                    ->where('id_opd', $id_opd);
                                              });
                                          },
                                          'kelompok.jenis.objek.rincian' => function($q) use ($tahun, $id_opd) {
                                              $q->whereHas('anggaran', function($q) use ($tahun, $id_opd) {
                                                  $q->where('tahun', $tahun)
                                                    ->where('id_opd', $id_opd);
                                              });
                                          },
                                          'kelompok.jenis.objek.rincian.subrincian' => function($q) use ($tahun, $id_opd) {
                                              $q->whereHas('anggaran', function($q) use ($tahun, $id_opd) {
                                                  $q->where('tahun', $tahun)
                                                    ->where('id_opd', $id_opd);
                                              });
                                          },
                                          'kelompok.jenis.objek.rincian.subrincian.anggaran' => function($q) use ($tahun, $id_opd) {
                                              $q->where('tahun', $tahun)
                                                ->where('id_opd', $id_opd);
                                          }
                                      ])
                                      ->get(),

        );

        // dd($data['akuns']->toArray());

        if ($request->ajax()) {

            $datarealisasi = DB::table('tb_bkuopd')
                            ->select('tb_opd.nama_opd', 'tb_bank.nama_bank', 'tb_bkuopd.uraian', 'tb_bkuopd.ket', 'tb_bkuopd.uraian', 'tb_bkuopd.no_buku', 'tb_bkuopd.no_kas_bpkad', 'tb_bkuopd.tgl_transaksi', 'tb_bkuopd.nilai_transaksi', 'tb_bkuopd.id_transaksi', 'tb_bkuopd.status1', 'tb_bkuopd.status2', 'tb_subrincianobjek.no_rek_sro', 'tb_subrincianobjek.rek_sro' )
                            ->join('tb_opd', 'tb_opd.id', '=', 'tb_bkuopd.id_opd')
                            ->join('tb_subrincianobjek', 'tb_subrincianobjek.id_sro', '=', 'tb_bkuopd.id_subrincianobjek')
                            ->join('tb_bank', 'tb_bank.id_bank', 'tb_bkuopd.id_bank')
                            ->orderBy('no_buku', 'asc')
                            ->where('tb_bkuopd.tahun', auth()->user()->tahun)
                            ->where('tb_bkuopd.id_opd', auth()->user()->id_opd)
                            ->get();

            return Datatables::of($datarealisasi)
                    ->addIndexColumn()
                    ->addColumn('nilai_transaksi', function($row) {
                        return number_format($row->nilai_transaksi);
                    })
                    ->rawColumns(['nilai_transaksi'])
                    ->make(true);
        }

        return view('Penatausahaan.Penerimaan.Realisasi_Opd.Tampilrealisasiopd2', $data);
    }
}
