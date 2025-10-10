<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rincian Selisih Rekonsiliasi</title>
    <style>
        body {
            font-family: "Bookman Old Style", serif;
            font-size: 12px;
            margin: 40px;
            line-height: 1.6;
        }
        .center { text-align: center; }
        .uraian {
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .rincian { margin-left: 25px; font-size: 11.5px; }
        .nominal { float: right; }
        .clear { clear: both; }
        .section-title {
            font-weight: bold;
            text-decoration: underline;
            margin-top: 20px;
            font-size: 13px;
        }
    </style>
</head>
<body>

    <h3 class="center">RINCIAN SELISIH REKONSILIASI</h3>
    <h4 class="center">{{ strtoupper($opd->nama_opd ?? '-') }}</h4>
    <p class="center">Bulan {{ $bulan }} {{ $tahun }}</p>
    <hr>

    {{-- =======================
         A. SELISIH LEBIH
    ======================== --}}
    <div class="section-title">A. Selisih Lebih (Realisasi BPKAD lebih besar dari OPD)</div>

    @if(count($lebih) > 0)
        @foreach ($lebih as $i => $row)
            <div class="uraian">
                {{ $i + 1 }}. {{ $row->uraian }}
            </div>
            <div class="rincian">
                Total Realisasi BPKAD: 
                <strong>Rp {{ number_format($row->total_bpkad ?? 0, 2, ',', '.') }}</strong><br>
                Total Realisasi OPD: 
                <strong>Rp {{ number_format($row->total_opd ?? 0, 2, ',', '.') }}</strong><br>
                Selisih Lebih: 
                <strong>Rp {{ number_format($row->selisih ?? 0, 2, ',', '.') }}</strong><br>

                @if(!empty($row->detail_bpkad))
                    Rincian Transaksi BPKAD:
                    <ul>
                        @foreach($row->detail_bpkad as $det)
                            <li>
                                {{ \Carbon\Carbon::parse($det->tgl_transaksi)->translatedFormat('d F Y') }} —
                                {{ $det->uraian }} — {{ $det->no_buku }}
                                <span class="nominal">Rp {{ number_format($det->nilai_transaksi, 2, ',', '.') }}</span>
                                <div class="clear"></div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if(!empty($row->detail_opd))
                    Rincian Transaksi OPD:
                    <ul>
                        @foreach($row->detail_opd as $det)
                            <li>
                                {{ \Carbon\Carbon::parse($det->tgl_transaksi)->translatedFormat('d F Y') }} —
                                {{ $det->uraian }} — {{ $det->no_kas_bpkad }} — {{ $det->no_buku }}
                                <span class="nominal">Rp {{ number_format($det->nilai_transaksi, 2, ',', '.') }}</span>
                                <div class="clear"></div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    @else
        <p><em>Tidak ada data selisih lebih.</em></p>
    @endif


    {{-- =======================
         B. SELISIH MINUS
    ======================== --}}
    <div class="section-title">B. Selisih Minus (Realisasi OPD lebih besar dari BPKAD)</div>

    @if(count($minus) > 0)
        @foreach ($minus as $i => $row)
            <div class="uraian">
                {{ $i + 1 }}. {{ $row->uraian }}
            </div>
            <div class="rincian">
                Total Realisasi BPKAD: 
                <strong>Rp {{ number_format($row->total_bpkad ?? 0, 2, ',', '.') }}</strong><br>
                Total Realisasi OPD: 
                <strong>Rp {{ number_format($row->total_opd ?? 0, 2, ',', '.') }}</strong><br>
                Selisih Minus: 
                <strong>Rp {{ number_format(abs($row->selisih ?? 0), 2, ',', '.') }}</strong><br>

                @if(!empty($row->detail_bpkad))
                    Rincian Transaksi BPKAD:
                    <ul>
                        @foreach($row->detail_bpkad as $det)
                            <li>
                                {{ \Carbon\Carbon::parse($det->tgl_transaksi)->translatedFormat('d F Y') }} —
                                {{ $det->uraian }} — {{ $det->no_buku }}
                                <span class="nominal">Rp {{ number_format($det->nilai_transaksi, 2, ',', '.') }}</span>
                                <div class="clear"></div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if(!empty($row->detail_opd))
                    Rincian Transaksi OPD:
                    <ul>
                        @foreach($row->detail_opd as $det)
                            <li>
                                {{ \Carbon\Carbon::parse($det->tgl_transaksi)->translatedFormat('d F Y') }} —
                                {{ $det->uraian }} — {{ $det->no_kas_bpkad }} — {{ $det->no_buku }}
                                <span class="nominal">Rp {{ number_format($det->nilai_transaksi, 2, ',', '.') }}</span>
                                <div class="clear"></div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    @else
        <p><em>Tidak ada data selisih minus.</em></p>
    @endif

</body>
</html>