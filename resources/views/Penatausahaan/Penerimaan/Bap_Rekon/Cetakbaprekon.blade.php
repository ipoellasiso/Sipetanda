<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Berita Acara Rekonsiliasi</title>
    <style>
        body { font-family: "Times New Roman", serif; font-size: 12pt; line-height: 1.5; }
        .center { text-align: center; }
        .justify { text-align: justify; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table, .table th, .table td { border: 1px solid #000; }
        .table th, .table td { padding: 6px; }
        .ttd { margin-top: 50px; width: 100%; }
        .ttd td { text-align: center; vertical-align: top; }
    </style>
</head>
<body>

    <h3 class="center"><u>BERITA ACARA REKONSILIASI</u></h3>
        <p class="center">Nomor : ....../BA-REKON/{{ date('Y') }}</p>
        <br>

        <p class="justify">
            Pada hari ini, {{ \Carbon\Carbon::parse($rekon->tanggal)->translatedFormat('l, d F Y') }},
            bertempat di Kantor {{ $rekon->nama_opd ?? '................................' }},
            telah dilaksanakan rekonsiliasi realisasi anggaran dengan rincian sebagai berikut:
        </p>

        <table class="table table-bordered table-striped text-center">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>No Rekening</th>
                    <th>Nama Rekening</th>
                    <th>Total BKU</th>
                    <th>Total Transaksi</th>
                    <th>Status Rekon</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rekonDetails as $i => $item)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $item->no_rekening }}</td>
                        <td class="text-start">{{ $item->rekening2 }}</td>
                        <td class="text-end">{{ number_format($item->total_bku, 0, ',', '.') }}</td>
                        <td class="text-end">{{ number_format($item->total_transaksi, 0, ',', '.') }}</td>
                        <td>
                            @if($item->status_rekon == 'Sama')
                                <span class="badge bg-success">Sama</span>
                            @else
                                <span class="badge bg-danger">Tidak Sama</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Data tidak ditemukan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p class="justify">
            Catatan :
        </p>

        <p class="justify">
            Demikian Berita Acara Rekonsiliasi ini dibuat untuk digunakan sebagaimana mestinya.
        </p>

        <table class="ttd">
            <tr>
                <td width="50%">
                    Mengetahui,<br>
                    {{ $rekon->jabatan_penandatangan }}
                    <br><br><br><br>
                    <b>{{ $rekon->pejabat_penandatangan }}</b>
                </td>
                <td width="50%">
                    {{ $rekon->nama_opd ?? '................................' }}, 
                    {{ \Carbon\Carbon::parse($rekon->tanggal)->translatedFormat('d F Y') }}<br>
                    Pejabat Penandatangan
                    <br><br><br><br>
                    <b>{{ $rekon->pejabat_penandatangan }}</b>
                </td>
            </tr>
        </table>
</div>

</body>
</html>