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
        .center {
            text-align: center;
        }
        .uraian {
            margin-top: 10px;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .rincian {
            margin-left: 25px;
            font-size: 11.5px;
        }
        .nominal {
            float: right;
        }
        .clear {
            clear: both;
        }
    </style>
</head>
<body>

    <h3 class="center">RINCIAN SELISIH REKONSILIASI</h3>
    <h4 class="center">{{ strtoupper($opd->nama_opd ?? '-') }}</h4>
    <p class="center">Bulan {{ $bulan }} {{ $tahun }}</p>
    <hr>

    @foreach ($rekonDetails as $i => $row)
        <div class="uraian">
            {{ $i + 1 }}. {{ $row->uraian }}
        </div>
        <div class="rincian">
            Total Realisasi OPD (Tanpa Rekening): 
            <strong>Rp {{ number_format($row->total_opd ?? 0, 2, ',', '.') }}</strong>
            <br>
            @if(!empty($row->detail_opd))
                Rincian Transaksi:
                <ul>
                    @foreach($row->detail_opd as $det)
                        <li>
                            {{ \Carbon\Carbon::parse($det->tgl_transaksi)->translatedFormat('d F Y') }} —
                            {{ $det->uraian }} 
                            <span class="nominal">Rp {{ number_format($det->nilai_transaksi, 2, ',', '.') }}</span>
                            <div class="clear"></div>
                        </li>
                    @endforeach
                </ul>
            @else
                <em>Tidak ada rincian transaksi.</em>
            @endif
        </div>
        <br>
    @endforeach

</body>
</html>