<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class PostingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(Request $request)
    {
        $userId = Auth::guard('web')->user()->id;
        $data = [
            'title'                 => 'Posting Penerimaan',
            'active_penerimaan'     => 'active',
            'active_sub'            => 'active',
            'active_sideposting'    => 'active',
            'breadcumd'             => 'Penatausahaan',
            'breadcumd1'            => 'Penerimaan',
            'breadcumd2'            => 'Posting',
            'userx'                 => UserModel::where('id',$userId)->first(['fullname','role','gambar','tahun']),
            // untuk filter dropdown
            'listOpd'               => DB::table('tb_opd')->orderBy('nama_opd')->get(),
            'listRekening'          => DB::table('tb_rekening')->orderBy('rekening2')->get(),
        ];

        if ($request->ajax()) {
            $query = DB::table('tb_transaksi')
                ->select(
                    'tb_rekening.id_rekening',
                    'tb_rekening.no_rekening',
                    'tb_rekening.rekening',
                    'tb_rekening.rekening2',
                    'tb_opd.nama_opd',
                    'tb_bank.nama_bank',
                    'tb_transaksi.uraian',
                    'tb_transaksi.ket',
                    'tb_transaksi.no_buku',
                    'tb_transaksi.tgl_transaksi',
                    'tb_transaksi.nilai_transaksi',
                    'tb_transaksi.id_transaksi',
                    'tb_transaksi.status4'
                )
                ->join('tb_opd', 'tb_opd.id', '=', 'tb_transaksi.id_opd')
                ->join('tb_rekening', 'tb_rekening.id_rekening', '=', 'tb_transaksi.id_rekening')
                ->join('tb_bank', 'tb_bank.id_bank', '=', 'tb_transaksi.id_bank')
                ->where('tb_transaksi.tahun', auth()->user()->tahun);

            // 🔎 filter dari request
            if ($request->opd) {
                $query->where('tb_transaksi.id_opd', $request->opd);
            }
            if ($request->rekening) {
                $query->where('tb_transaksi.id_rekening', $request->rekening);
            }
            if ($request->tgl_awal && $request->tgl_akhir) {
                $query->whereBetween('tb_transaksi.tgl_transaksi', [$request->tgl_awal, $request->tgl_akhir]);
            }

            return Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('nilai_transaksi', function($row) {
                    return number_format($row->nilai_transaksi);
                })
                ->rawColumns(['nilai_transaksi'])
                ->make(true);
        }

        return view('Penatausahaan.Penerimaan.Posting.Tampilposting', $data);
    }

    public function updateBku(Request $request)
    {
        $user = auth()->user();
        $data = $request->data ?? [];

        if (empty($data)) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada data terpilih'
            ], 400);
        }

        $notFoundBku = [];
        $notFoundTrx = [];

        foreach ($data as $item) {
            $bku = DB::table('tb_bkuopd')
                ->where('id_opd', $user->id_opd)
                ->where('tahun', $user->tahun)
                ->where('no_kas_bpkad', $item['no_buku'])
                ->first();

            if ($bku) {
                DB::table('tb_bkuopd')
                    ->where('id_opd', $user->id_opd)
                    ->where('tahun', $user->tahun)
                    ->where('no_kas_bpkad', $item['no_buku'])
                    ->update([
                        'id_rekening' => $item['id_rekening'],
                        'updated_at'  => now(),
                    ]);

                $trx = DB::table('tb_transaksi')
                    ->where('id_opd', $user->id_opd)
                    ->where('tahun', $user->tahun)
                    ->where('id_transaksi', $item['id_transaksi'])
                    ->first();

                if ($trx) {
                    DB::table('tb_transaksi')
                        ->where('id_transaksi', $trx->id_transaksi)
                        ->update([
                            'status4' => 'Posting',
                            'updated_at' => now(),
                        ]);
                } else {
                    $notFoundTrx[] = $item['no_buku'];
                }
            } else {
                $notFoundBku[] = $item['no_buku'];
            }
        }

        if (!empty($notFoundBku) || !empty($notFoundTrx)) {
            return response()->json([
                'success' => false,
                'message' =>
                    (!empty($notFoundBku)
                        ? 'Tidak ada di BKU: ' . implode(", ", $notFoundBku) . '. '
                        : '') .
                    (!empty($notFoundTrx)
                        ? 'BKU ada, tapi transaksi tidak ketemu (id_transaksi): ' . implode(", ", $notFoundTrx)
                        : '')
            ], 422);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data BKU dan Transaksi berhasil diupdate'
        ]);
    }

    public function batalkanPosting(Request $request)
    {
        // sekarang pakai id_transaksi, bukan id_rekening
        $trx = DB::table('tb_transaksi')->where('id_transaksi', $request->id_transaksi)->first();

        if ($trx && $trx->status4 == 'Posting') {
            DB::table('tb_transaksi')
                ->where('id_transaksi', $trx->id_transaksi)
                ->update([
                    'status4' => 'Belum Posting',
                    'updated_at' => now(),
                ]);

            return response()->json(['success' => true, 'message' => 'Posting berhasil dibatalkan!']);
        }

        return response()->json(['success' => false, 'message' => 'Data tidak valid atau belum posting!']);
    }
}
