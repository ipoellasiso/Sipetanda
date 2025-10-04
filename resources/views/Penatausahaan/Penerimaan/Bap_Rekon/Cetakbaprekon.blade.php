<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Berita Acara Rekonsiliasi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bg-green { background: #28a745; color: #fff; padding: 2px 6px; border-radius: 4px; }
        .bg-red { background: #dc3545; color: #fff; padding: 2px 6px; border-radius: 4px; }

        body { font-family: "Times New Roman", serif; font-size: 12pt; line-height: 1.5; }
        .center { text-align: center; }
        .justify { text-align: justify; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table, .table th, .table td { border: 1px solid #000; }
        .table th, .table td { padding: 6px; }
        .ttd { margin-top: 50px; width: 100%; }
        .ttd td { text-align: center; vertical-align: top; }

        .kop-surat {
            text-align: center;
            border-bottom: 3px solid #000; /* Garis bawah tebal */
            padding-bottom: 10px; /* Jarak antara teks dan garis */
            margin-bottom: 20px; /* Jarak antara kop dan konten */
        }
        .kop-surat h1, .kop-surat h2, .kop-surat h3 {
            margin: 0;
            padding: 0;
        }
        .kop-surat p {
            margin: 0;
            padding: 0;
        }

        /* khusus kop surat tanpa border */
        .kop-surat, .kop-surat td, .kop-surat th {
            border: none !important;
        }

        /* tabel data tetap ada border */
        .tabel-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        .tabel-data th, .tabel-data td {
            border: 1px solid black;
            padding: 6px;
        }
        .tabel-data th {
            background-color: #ddd;
            text-align: center;
        }

        table {
            page-break-inside: avoid !important;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }

        tfoot {
            display: table-footer-group;
        }

        .tabel-data {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;        /* perkecil font */
            /* table-layout: fixed;    biar lebar kolom dibagi rata */
            word-wrap: break-word;  /* pecah teks panjang */
        }
        .tabel-data th, .tabel-data td {
            border: 1px solid #000;
            padding: 5px;
        }

        .tabel-data th.no-col, 
        .tabel-data td.no-col {
            width: 40px;        /* kecilin kolom No */
            text-align: center;
        }

        .tabel-data th.ket-col, 
        .tabel-data td.ket-col {
            width: 100px;       /* atur kolom Keterangan */
            text-align: center;
        }

        .judul-bap {
            font-size: 10pt;    /* perkecil font */
            font-weight: bold;
            text-align: center;
            margin: 0;
            line-height: 1.4;
        }
        .judul-bap u {
            text-decoration: underline;
        }

    </style>
</head>
<body>

<div class="card">
        <div class="card-body">

            <table width="100%" style="border-collapse: collapse; border: none; margin-bottom:10px;">
                <tr style="border:none;">
                    <td width="15%" style="text-align:center; border:none;">
                        <img src="{{ public_path('images/logo/13.png') }}" width="60">
                    </td>
                    <td width="85%" style="text-align:center; vertical-align:middle; border:none;">
                        <h4 style="margin:0;">PEMERINTAH KOTA PALU</h4>
                        <h4 style="margin:0;">BADAN PENGELOLA KEUANGAN DAN ASET DAERAH (BPKAD)</h4>
                        <p style="margin:0;">Jl. Balai Kota Selatan No. 2, Telp. (0451) 485880 - 485089</p>
                    </td>
                    <td width="15%" style="text-align:center; border:none;">
                        {{-- <img src="{{ public_path('images/logo/13.png') }}" width="60"> --}}
                    </td>
                </tr>
            </table>
            <hr style="border:2px solid #000; margin:5px 0;">

            <div class="center">
                <div class="judul-bap"><u>BERITA ACARA</u></div>
                <div class="judul-bap">REKONSILIASI PENERIMAAN / REALISASI PENDAPATAN</div>
                <div class="judul-bap">BULAN {{ strtoupper($rekon->bulan) }}</div>
            </div>

            <p> Pada hari ini, {{ $tanggalRekon }}</b>,
                kami yang bertanda tangan di bawah ini :</p>

            <div class="row">
                    &nbsp;&nbsp;1. Nama
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;FADHILA YUNUS, SE<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;Kepala Seksi Penatausahaan Penerimaan<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;Jl. Baruga No. 2
            </div>

            <p> Bertindak untuk dan atas nama Badan Pendapatan Daerah Kota Palu, selanjutnya disebut <b>PIHAK KEDUA</b>.</p>

            <div class="row">
                    &nbsp;&nbsp;2. Nama
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;{{ $rekon->nama_bendahara }}<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;Bendahara Penerimaan {{ $rekon->nama_opd }}<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;{{ $rekon->alamat }}
            </div>

            <p> Bertindak untuk dan atas nama BPKAD Kota Palu, selanjutnya disebut <b>PIHAK PERTAMA</b>.</p>

            <p> Kedua belah pihak telah melakukan rekonsiliasi penerimaan pendapatan bulan
                {{ $rekon->bulan }}</b> dengan hasil sebagai berikut:</p>

            <table class="tabel-data">
                <thead>
                    <tr>
                        <th style="text-align:center; background-color: #dddddd;" width="10px">No</th>
                        <th style="text-align:center; background-color: #dddddd;" width="200px">Uraian</th>
                        <th style="text-align:center; background-color: #dddddd;" width="30px">Anggaran</th>
                        <th style="text-align:center; background-color: #dddddd;" width="30px">Realisasi s/d bulan ini (BPKAD)</th>
                        <th style="text-align:center; background-color: #dddddd;" width="30px">Realisasi s/d bulan ini (OPD)</th>
                        <th style="text-align:center; background-color: #dddddd;" width="30px">Selisih</th>
                        <th class="no-col">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tot_anggaran = $tot_bpkad = $tot_opd = $tot_selisih = 0;
                    @endphp
                    @foreach($rekonDetails as $i => $row)
                    <tr>
                        <td class="no-col">{{ $i+1 }}</td>
                        <td>{{ $row->uraian }}</td>
                        <td style="text-align:right">{{ number_format($row->total_anggaran,2,',','.') }}</td>
                        <td style="text-align:right">{{ number_format($row->total_transaksi,2,',','.') }}</td>
                        <td style="text-align:right">{{ number_format($row->total_bku,2,',','.') }}</td>
                        <td style="text-align:right">{{ number_format($row->selisih,2,',','.') }}</td>
                        <td class="no-col">{{ $row->status_rekon }}</td>
                    </tr>
                    @endforeach
                    <tr style="background:#f0f0f0; font-weight:bold">
                        <td colspan="2" style="text-align:center;">TOTAL</td>
                        <td style="text-align:right">
                            {{ number_format(collect($rekonDetails)->sum(fn($r)=>(float)$r->total_anggaran),2,',','.') }}
                        </td>
                        <td style="text-align:right">
                            {{ number_format(collect($rekonDetails)->sum(fn($r)=>(float)$r->total_transaksi),2,',','.') }}
                        </td>
                        <td style="text-align:right">
                            {{ number_format(collect($rekonDetails)->sum(fn($r)=>(float)$r->total_bku),2,',','.') }}
                        </td>
                        <td style="text-align:right">
                            {{ number_format(collect($rekonDetails)->sum(fn($r)=>(float)$r->selisih),2,',','.') }}
                        </td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <div class="row">
                <div class="col-12">
                    <p><b>Catatan :</b> 
                        {{ $catatan->status1 ?? '-' }}, 
                        {{ $catatan->status2 ?? '-' }}, 
                        {{ $catatan->status3 ?? '-' }}
                    </p>
                    
                </div>
            </div>

            <table width="100%" style="margin-top:20px; border:none;">
                <tr>
                    <td width="50%" style="text-align:center; border:none;">
                        PIHAK KEDUA <br>
                        Bendahara Penerimaan <br><br><br><br><br>
                        ( {{ $rekon->nama_bendahara }} ) <br>
                        Nip. {{ $rekon->pangkat }}
                    </td>
                    <td width="50%" style="text-align:center; border:none;">
                        PIHAK PERTAMA <br>
                        Kepala Seksi Penatausahaan Penerimaan <br><br><br><br><br>
                        ( FADHILA YUNUS, SE ) <br>
                        Nip.
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>