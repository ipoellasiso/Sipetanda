<?php

namespace App\Http\Controllers;

use App\Models\BkuopdModel;
use App\Models\CatatanModel;
use App\Models\OpdModel;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\Facade\Pdf;

class BaprekonOpdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index (Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $userx  = UserModel::where('id',$userId)
                    ->first(['fullname','role','gambar','tahun','id_opd']);
        
        // ambil status1 & id opd
        $opd = OpdModel::select('id', 'nama_opd', 'nama_bendahara', 'alamat', 'pangkat')->where('id', auth()->user()->id_opd)->first();
        $namaopd = $opd->nama_opd;
        $nama_bendahara = $opd->nama_bendahara;
        $alamat = $opd->alamat;
        $pangkat = $opd->pangkat;

        $tahun = date('Y');
        $bulan = $request->bulan ?? date('m'); // default bulan sekarang
        $tglRekon = $request->input('tgl_rekon', date('Y-m-d')); // default hari ini

        // --- 6. Ambil catatan berdasarkan bulan & tahun ---
        $catatan = CatatanModel::where('id_opd', $userx->id_opd)
            ->where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->first(); // ambil satu baris

        // format tanggal untuk redaksi
        $tanggalRekon = \Carbon\Carbon::parse($tglRekon)->translatedFormat('l, d F Y');

        // --- 1. Ambil semua Anggaran (loop utama)
        $anggaranData = DB::table('tb_anggaranopd')
        ->select(
            'id_subrincianobjek',
            'uraian',
            DB::raw('SUM(nilai_anggaranopd) as total_anggaran')
        )
        ->where('id_opd',$userx->id_opd)
        ->where('tahun',$tahun)
        ->groupBy('id_subrincianobjek','uraian')
        ->get();

        // --- 2. Ambil BKU per subrincian
        // $bkuData = DB::table('tb_bkuopd')
        //     ->select('id_subrincianobjek','id_rekening',DB::raw('SUM(nilai_transaksi) as total_bku'))
        //     ->where('id_opd',$userx->id_opd)
        //     ->whereYear('tgl_transaksi',$tahun)
        //     ->whereMonth('tgl_transaksi',$bulan)
        //     ->groupBy('id_subrincianobjek','id_rekening')
        //     ->get();

        $bkuData = DB::table('tb_bkuopd')
            ->select('id_subrincianobjek','id_rekening',DB::raw('SUM(nilai_transaksi) as total_bku'))
            ->where('id_opd',$userx->id_opd)
            ->whereYear('tgl_transaksi',$tahun)
            ->whereRaw('MONTH(tgl_transaksi) <= ?', [$bulan]) // akumulasi sampai bulan filter
            ->groupBy('id_subrincianobjek','id_rekening')
            ->get();
        
        $rekeningMap = DB::table('tb_anggaranopd')
            ->select('id_subrincianobjek','id_akun as id_rekening')
            ->where('id_opd',$userx->id_opd)
            ->groupBy('id_subrincianobjek','id_akun')
            ->get();

        $rekeningMap1 = DB::table('tb_anggaranopd')
            ->select('id_subrincianobjek','id_akun as id_rekening')
            ->where('id_opd',$userx->id_opd);

        $rekeningMap2 = DB::table('tb_bkuopd')
            ->select('id_subrincianobjek','id_rekening')
            ->where('id_opd',$userx->id_opd);

        $rekeningMap = $rekeningMap1->union($rekeningMap2)->get();

        // --- 3. Ambil Transaksi BPKAD per rekening
        // $trxData = DB::table('tb_transaksi')
        //     ->select('id_rekening',DB::raw('SUM(nilai_transaksi) as total_transaksi'))
        //     ->where('id_opd',$userx->id_opd)
        //     ->whereYear('tgl_transaksi',$tahun)
        //     ->whereMonth('tgl_transaksi',$bulan)
        //     ->groupBy('id_rekening')
        //     ->get();
    
        $trxData = DB::table('tb_transaksi')
            ->select('id_rekening',DB::raw('SUM(nilai_transaksi) as total_transaksi'))
            ->where('id_opd',$userx->id_opd)
            ->whereYear('tgl_transaksi',$tahun)
            ->whereRaw('MONTH(tgl_transaksi) <= ?', [$bulan]) // akumulasi sampai bulan filter
            ->groupBy('id_rekening')
            ->get();

        // mapping rekening → subrincian
        foreach ($trxData as $trx) {
            $map = $rekeningMap->firstWhere('id_rekening',$trx->id_rekening);
            $trx->id_subrincianobjek = $map->id_subrincianobjek ?? null;
        }

        // --- 4. Gabungkan (loop utama = Anggaran)
        $rekonDetails = [];
        foreach ($anggaranData as $anggaran) {
            // jumlahkan total_bku untuk semua rekening di subrincian ini
            $total_bku = $bkuData->where('id_subrincianobjek', $anggaran->id_subrincianobjek)
                                ->sum('total_bku');

            // jumlahkan total_transaksi untuk semua rekening di subrincian ini
            $total_trx = $trxData->where('id_subrincianobjek', $anggaran->id_subrincianobjek)
                                ->sum('total_transaksi');

            $rekonDetails[] = (object)[
                'uraian'          => $anggaran->uraian,
                'total_anggaran'  => $anggaran->total_anggaran,
                'total_transaksi' => $total_trx,
                'total_bku'       => $total_bku,
                'selisih'         => $total_trx - $total_bku,
                'status_rekon'    => ($total_trx == $total_bku) ? 'Sama' : 'Tidak Sama',
            ];
        }

        function toNumber($value) {
            if (is_null($value)) return 0;
            // buang titik pemisah ribuan, ganti koma jadi titik
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
            return (float) $value;
        }

        $tot_anggaran = $tot_bpkad = $tot_opd = $tot_selisih = 0;

        foreach ($rekonDetails as $row) {
            $tot_anggaran += toNumber($row->total_anggaran);
            $tot_bpkad    += toNumber($row->total_transaksi);
            $tot_opd      += toNumber($row->total_bku);
            $tot_selisih  += toNumber($row->selisih);
        }

        // dd($tot_anggaran, $tot_bpkad, $tot_opd, $tot_selisih);

        // --- 5. Data header berita acara ---
        $rekon = (object)[
            'tanggal' => now()->translatedFormat('l, d F Y'),
            'nama_opd' => $namaopd,
            'pangkat' => $pangkat,
            // 'status1' => $status1,
            'nama_bendahara' => $nama_bendahara,
            'alamat' => $alamat,
            'jabatan_penandatangan' => 'Kepala OPD',
            'pejabat_penandatangan' => $userx->fullname,
            'bulan' => \Carbon\Carbon::create()->month($bulan)->year($tahun)->translatedFormat('F Y'),
        ];

        $data = [
            'title'        => 'Berita Acara Rekon',
            'active_laporan'  => 'active',
            'active_subopd'=> 'active',
            'active_sidebap'=> 'active',
            'breadcumd'    => 'Berita Acara',
            'breadcumd1'   => 'Rekonsilisasi',
            'breadcumd2'   => 'Dashboard',
            'userx'        => $userx,
            'rekon'        => $rekon,
            'rekonDetails' => $rekonDetails,
            'bulan'        => $bulan,
            'tahun'        => $tahun,
            'tgl_rekon'    => $tglRekon,
            'tanggalRekon' => $tanggalRekon,
            'tot_anggaran' => $tot_anggaran,
            'tot_bpkad'    => $tot_bpkad,
            'tot_opd'      => $tot_opd,
            'tot_selisih'  => $tot_selisih,
            'catatan'      => $catatan,
        ];

        return view('Penatausahaan.Penerimaan.Bap_Rekon.Tampilbaprekon1', $data);
    }

    public function cetakPdf(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $userx  = UserModel::where('id',$userId)
                    ->first(['fullname','role','gambar','tahun','id_opd']);
        
        // ambil status1 & id opd
        $opd = OpdModel::select('id', 'nama_opd', 'nama_bendahara', 'alamat', 'pangkat')->where('id', auth()->user()->id_opd)->first();
        $namaopd = $opd->nama_opd;
        $nama_bendahara = $opd->nama_bendahara;
        $alamat = $opd->alamat;
        $pangkat = $opd->pangkat;

        $tahun = date('Y');
        $bulan = $request->bulan ?? date('m'); // default bulan sekarang
        $tglRekon = $request->input('tgl_rekon', date('Y-m-d')); // default hari ini

        // --- 6. Ambil catatan berdasarkan bulan & tahun ---
        $catatan = CatatanModel::where('id_opd', $userx->id_opd)
            ->where('tahun', $tahun)
            ->where('bulan', $bulan)
            ->first(); // ambil satu baris

        // format tanggal untuk redaksi
        $tanggalRekon = \Carbon\Carbon::parse($tglRekon)->translatedFormat('l, d F Y');

        // --- 1. Ambil semua Anggaran (loop utama)
        $anggaranData = DB::table('tb_anggaranopd')
        ->select(
            'id_subrincianobjek',
            'uraian',
            DB::raw('SUM(nilai_anggaranopd) as total_anggaran')
        )
        ->where('id_opd',$userx->id_opd)
        ->where('tahun',$tahun)
        ->groupBy('id_subrincianobjek','uraian')
        ->get();

        // --- 2. Ambil BKU per subrincian
        // $bkuData = DB::table('tb_bkuopd')
        //     ->select('id_subrincianobjek','id_rekening',DB::raw('SUM(nilai_transaksi) as total_bku'))
        //     ->where('id_opd',$userx->id_opd)
        //     ->whereYear('tgl_transaksi',$tahun)
        //     ->whereMonth('tgl_transaksi',$bulan)
        //     ->groupBy('id_subrincianobjek','id_rekening')
        //     ->get();

        $bkuData = DB::table('tb_bkuopd')
            ->select('id_subrincianobjek','id_rekening',DB::raw('SUM(nilai_transaksi) as total_bku'))
            ->where('id_opd',$userx->id_opd)
            ->whereYear('tgl_transaksi',$tahun)
            ->whereRaw('MONTH(tgl_transaksi) <= ?', [$bulan]) // akumulasi sampai bulan filter
            ->groupBy('id_subrincianobjek','id_rekening')
            ->get();
        
        $rekeningMap = DB::table('tb_anggaranopd')
            ->select('id_subrincianobjek','id_akun as id_rekening')
            ->where('id_opd',$userx->id_opd)
            ->groupBy('id_subrincianobjek','id_akun')
            ->get();

        $rekeningMap1 = DB::table('tb_anggaranopd')
            ->select('id_subrincianobjek','id_akun as id_rekening')
            ->where('id_opd',$userx->id_opd);

        $rekeningMap2 = DB::table('tb_bkuopd')
            ->select('id_subrincianobjek','id_rekening')
            ->where('id_opd',$userx->id_opd);

        $rekeningMap = $rekeningMap1->union($rekeningMap2)->get();

        // --- 3. Ambil Transaksi BPKAD per rekening
        // $trxData = DB::table('tb_transaksi')
        //     ->select('id_rekening',DB::raw('SUM(nilai_transaksi) as total_transaksi'))
        //     ->where('id_opd',$userx->id_opd)
        //     ->whereYear('tgl_transaksi',$tahun)
        //     ->whereMonth('tgl_transaksi',$bulan)
        //     ->groupBy('id_rekening')
        //     ->get();
    
        $trxData = DB::table('tb_transaksi')
            ->select('id_rekening',DB::raw('SUM(nilai_transaksi) as total_transaksi'))
            ->where('id_opd',$userx->id_opd)
            ->whereYear('tgl_transaksi',$tahun)
            ->whereRaw('MONTH(tgl_transaksi) <= ?', [$bulan]) // akumulasi sampai bulan filter
            ->groupBy('id_rekening')
            ->get();

        // mapping rekening → subrincian
        foreach ($trxData as $trx) {
            $map = $rekeningMap->firstWhere('id_rekening',$trx->id_rekening);
            $trx->id_subrincianobjek = $map->id_subrincianobjek ?? null;
        }

        // --- 4. Gabungkan (loop utama = Anggaran)
        $rekonDetails = [];
        foreach ($anggaranData as $anggaran) {
            // jumlahkan total_bku untuk semua rekening di subrincian ini
            $total_bku = $bkuData->where('id_subrincianobjek', $anggaran->id_subrincianobjek)
                                ->sum('total_bku');

            // jumlahkan total_transaksi untuk semua rekening di subrincian ini
            $total_trx = $trxData->where('id_subrincianobjek', $anggaran->id_subrincianobjek)
                                ->sum('total_transaksi');

            $rekonDetails[] = (object)[
                'uraian'          => $anggaran->uraian,
                'total_anggaran'  => $anggaran->total_anggaran,
                'total_transaksi' => $total_trx,
                'total_bku'       => $total_bku,
                'selisih'         => $total_trx - $total_bku,
                'status_rekon'    => ($total_trx == $total_bku) ? 'Sama' : 'Tidak Sama',
            ];
        }

        function toNumber1($value) {
            if (is_null($value)) return 0;
            // buang titik pemisah ribuan, ganti koma jadi titik
            $value = str_replace('.', '', $value);
            $value = str_replace(',', '.', $value);
            return (float) $value;
        }

        $tot_anggaran = $tot_bpkad = $tot_opd = $tot_selisih = 0;

        foreach ($rekonDetails as $row) {
            $tot_anggaran += toNumber1($row->total_anggaran);
            $tot_bpkad    += toNumber1($row->total_transaksi);
            $tot_opd      += toNumber1($row->total_bku);
            $tot_selisih  += toNumber1($row->selisih);
        }

        // dd($tot_anggaran, $tot_bpkad, $tot_opd, $tot_selisih);

        // --- 5. Data header berita acara ---
        $rekon = (object)[
            'tanggal' => now()->translatedFormat('l, d F Y'),
            'nama_opd' => $namaopd,
            'pangkat' => $pangkat,
            'nama_bendahara' => $nama_bendahara,
            'alamat' => $alamat,
            'jabatan_penandatangan' => 'Kepala OPD',
            'pejabat_penandatangan' => $userx->fullname,
            'bulan' => \Carbon\Carbon::create()->month($bulan)->year($tahun)->translatedFormat('F Y'),
        ];

        // --- 6. Cetak PDF ---
        $pdf = Pdf::loadView(
            'Penatausahaan.Penerimaan.Bap_Rekon.Cetakbaprekon',
            [
                'rekon'        => $rekon,
                'rekonDetails' => $rekonDetails,
                'title'        => 'Berita Acara Rekonsiliasi',
                'userx'        => $userx,
                'tanggalRekon' => $tanggalRekon,
                'tot_anggaran' => $tot_anggaran,
                'tot_bpkad'    => $tot_bpkad,
                'tot_opd'      => $tot_opd,
                'tot_selisih'  => $tot_selisih,
                'catatan'      => $catatan,
            ]
        )->setPaper('legal', 'portrait'); // <-- Legal & landscape

        return $pdf->stream('BAP_Rekon.pdf');
    }

    public function cetakRincianSelisih(Request $request)
    {
        $user = auth()->user();
        $tahun = $user->tahun ?? date('Y');
        $bulan = $request->input('bulan', date('m'));

        // 🔹 Ambil data OPD
        $opd = DB::table('tb_opd')
            ->select('id', 'nama_opd', 'alamat', 'nama_bendahara', 'pangkat')
            ->where('id', $user->id_opd)
            ->first();

        if (!$opd) {
            return back()->with('error', 'Data OPD tidak ditemukan.');
        }

        // 🔹 Ambil hanya BKU yang BELUM ADA id_rekening (id_rekening = null)
        $bkuSelisih = DB::table('tb_bkuopd')
            ->select('id_subrincianobjek', 'uraian', 'tgl_transaksi', 'nilai_transaksi')
            ->where('id_opd', $user->id_opd)
            ->where('tahun', $tahun)
            ->whereYear('tgl_transaksi', $tahun)
            ->whereRaw('MONTH(tgl_transaksi) <= ?', [$bulan])
            ->whereNull('id_rekening') // ✅ hanya ambil yang belum ada id_rekening
            ->orderBy('id_subrincianobjek')
            ->get();

        // 🔹 Kelompokkan per subrincian
        $rekonDetails = $bkuSelisih->groupBy('id_subrincianobjek')->map(function($items, $id_sro){
            $uraian = DB::table('tb_subrincianobjek')
                        ->where('id_sro', $id_sro)
                        ->value('rek_sro') ?? 'Tidak ditemukan';

            return (object)[
                'id_subrincianobjek' => $id_sro,
                'uraian' => $uraian,
                'total_opd' => $items->sum('nilai_transaksi'),
                'detail_opd' => $items
            ];
        })->values()->all();

        if (empty($rekonDetails)) {
            return back()->with('warning', 'Tidak ada data selisih — semua BKU sudah punya id_rekening.');
        }

        // 🔹 Buat PDF
        $pdf = PDF::loadView('Penatausahaan.Penerimaan.Bap_Rekon.CetakRincianSelisih', [
            'rekonDetails' => $rekonDetails,
            'opd' => $opd,
            'bulan' => \Carbon\Carbon::create()->month($bulan)->translatedFormat('F'),
            'tahun' => $tahun,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('Rincian_Selisih_'.$opd->nama_opd.'.pdf');
    }

}
