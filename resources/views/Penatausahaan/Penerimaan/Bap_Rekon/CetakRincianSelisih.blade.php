<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Rincian Selisih Rekonsiliasi</title>
    <style>
        body {
            font-family: "Bookman Old Style", serif;
            font-size: 13px;
            margin: 40px;
            line-height: 1.6;
        }
        h3, h4 {
            margin: 0;
            padding: 0;
        }
        .center { text-align: center; }
        .judul {
            font-weight: bold;
            margin-top: 15px;
            text-decoration: underline;
        }
        .uraian {
            margin-top: 10px;
            font-weight: bold;
        }
        .rincian { margin-left: 25px; }
        .nominal { float: right; }
        .clear { clear: both; }
        .label {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 6px;
            margin-top: 4px;
            font-size: 12px;
        }
        .blue { background: #e1ecff; color: #003399; }
        .green { background: #dfffe0; color: #005f2f; }
        .orange { background: #fff1da; color: #a25c00; }
        .keterangan {
            margin-top: 4px;
            background: #eef3ff;
            padding: 5px 7px;
            border-left: 3px solid #4c6ef5;
            border-radius: 3px;
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
    <div class="judul">A. Selisih Lebih (Realisasi BPKAD lebih besar dari OPD)</div>

    @forelse ($lebih as $i => $row)
        <div class="uraian">
            {{ $i + 1 }}. {{ $row->uraian }}
        </div>
        <div class="rincian">
            <p>
                Total Realisasi BPKAD:
                <strong>Rp {{ number_format($row->total_bpkad ?? 0, 2, ',', '.') }}</strong><br>
                Total Realisasi OPD:
                <strong>Rp {{ number_format($row->total_opd ?? 0, 2, ',', '.') }}</strong><br>
                Selisih Lebih:
                <strong>Rp {{ number_format($row->selisih ?? 0, 2, ',', '.') }}</strong>
            </p>

            {{-- === KETERANGAN OTOMATIS === --}}
            <div class="keterangan">
                💬 <b>Keterangan:</b>
                Selisih muncul karena <b>perbedaan data transaksi</b> antara OPD dan BPKAD
                (belum direkon, belum posting, atau beda tanggal transaksi).
            </div>

            {{-- === RINCIAN TRANSAKSI OPD === --}}
            @if($row->detail_opd->isNotEmpty())
                <p><b>Rincian Transaksi OPD:</b></p>
                <ul>
                    @foreach($row->detail_opd as $det)
                        <li>
                            {{ \Carbon\Carbon::parse($det->tgl_transaksi)->translatedFormat('d F Y') }}
                            — {{ $det->uraian ?? '-' }} — {{ $det->no_buku ?? '-' }} 
                            <span class="nominal">Rp {{ number_format($det->nilai_transaksi, 2, ',', '.') }}</span>
                            <div class="clear"></div>

                            {{-- 🔎 NOMOR KAS BPKAD (pakai kolom no_buku dari tb_transaksi) --}}
                            @php
                                $noKas = DB::table('tb_bkuopd')
                                    ->where('id_opd', $opd->id)
                                    ->whereDate('tgl_transaksi', $det->tgl_transaksi)
                                    ->where('nilai_transaksi', $det->nilai_transaksi)
                                    ->value('no_kas_bpkad');
                            @endphp

                            @if($noKas)
                                <div style="margin-top:4px;">
                                    <b>No. Kas BPKAD:</b> {{ $noKas }}
                                </div>
                            @else
                                <div style="margin-top:4px;">
                                    ❌ <b>No. Kas BPKAD:</b> <i>Belum ada pasangan</i>
                                </div>
                            @endif

                            {{-- 🎨 LABEL WARNA --}}
                            @if(Str::contains($det->label, 'Belum Direkon'))
                                <span class="label blue">{{ $det->label }}</span>
                            @elseif(Str::contains($det->label, 'Tidak ada pasangan'))
                                <span class="label orange">{{ $det->label }}</span>
                            @else
                                <span class="label green">{{ $det->label }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif

            {{-- === RINCIAN TRANSAKSI BPKAD === --}}
            @if($row->detail_bpkad->isNotEmpty())
                <p><b>Rincian Transaksi BPKAD:</b></p>
                <ul>
                    @foreach($row->detail_bpkad as $det)
                        <li>
                            {{ \Carbon\Carbon::parse($det->tgl_transaksi)->translatedFormat('d F Y') }}
                            — {{ $det->uraian ?? '-' }} — {{ $det->no_buku ?? '-' }}
                            <span class="nominal">Rp {{ number_format($det->nilai_transaksi, 2, ',', '.') }}</span>
                            <div class="clear"></div>
                            <span class="label green">{{ $det->label }}</span>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @empty
        <p><i>Tidak ada data selisih lebih.</i></p>
    @endforelse

    {{-- =======================
         B. SELISIH MINUS
    ======================== --}}
    <div class="judul">B. Selisih Minus (Realisasi OPD lebih besar dari BPKAD)</div>

    @forelse ($minus as $i => $row)
        <div class="uraian">
            {{ $i + 1 }}. {{ $row->uraian }}
        </div>
        <div class="rincian">
            <p>
                Total Realisasi BPKAD:
                <strong>Rp {{ number_format($row->total_bpkad ?? 0, 2, ',', '.') }}</strong><br>
                Total Realisasi OPD:
                <strong>Rp {{ number_format($row->total_opd ?? 0, 2, ',', '.') }}</strong><br>
                Selisih Minus:
                <strong>Rp {{ number_format(abs($row->selisih ?? 0), 2, ',', '.') }}</strong>
            </p>

            <div class="keterangan">
                💬 <b>Keterangan:</b>
                Selisih muncul karena <b>perbedaan data transaksi</b> antara OPD dan BPKAD
                (belum direkon atau belum diposting).
            </div>

            {{-- === RINCIAN TRANSAKSI OPD === --}}
            @if($row->detail_opd->isNotEmpty())
                <p><b>Rincian Transaksi OPD:</b></p>
                <ul>
                    @foreach($row->detail_opd as $det)
                        <li>
                            {{ \Carbon\Carbon::parse($det->tgl_transaksi)->translatedFormat('d F Y') }}
                            — {{ $det->uraian ?? '-' }} — {{ $det->no_buku ?? '-' }}
                            <span class="nominal">Rp {{ number_format($det->nilai_transaksi, 2, ',', '.') }}</span>
                            <div class="clear"></div>

                            {{-- 🔎 NOMOR KAS BPKAD --}}
                            @php
                                $noKas = DB::table('tb_bkuopd')
                                    ->where('id_opd', $opd->id)
                                    ->whereDate('tgl_transaksi', $det->tgl_transaksi)
                                    ->where('nilai_transaksi', $det->nilai_transaksi)
                                    ->value('no_kas_bpkad');
                            @endphp

                            @if($noKas)
                                <div style="margin-top:4px;">
                                    <b>No. Kas BPKAD:</b> {{ $noKas }}
                                </div>
                            @else
                                <div style="margin-top:4px;">
                                    ❌ <b>No. Kas BPKAD:</b> <i>Belum ada pasangan</i>
                                </div>
                            @endif

                            {{-- 🎨 LABEL WARNA --}}
                            @if(Str::contains($det->label, 'Belum Direkon'))
                                <span class="label blue">{{ $det->label }}</span>
                            @elseif(Str::contains($det->label, 'Tidak ada pasangan'))
                                <span class="label orange">{{ $det->label }}</span>
                            @else
                                <span class="label green">{{ $det->label }}</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    @empty
        <p><i>Tidak ada data selisih minus.</i></p>
    @endforelse

</body>
</html>
