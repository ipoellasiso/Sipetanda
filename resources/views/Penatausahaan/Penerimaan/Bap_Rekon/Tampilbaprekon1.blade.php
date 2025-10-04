@extends('Template.Layout')
@section('content')

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

    </style>

    <div class="card">
        <div class="card-body">

            {{-- 🔎 Filter bulan & tahun --}}
            <form method="GET" action="{{ route('baprekon.index') }}" class="mb-3">
                <div class="row">
                    <div class="col 4">
                        <h3> Filter Laporan </h3>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <label>Pilih Bulan:</label>
                        <select name="bulan" class="form-control">
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Pilih Tahun:</label>
                        <select name="tahun" class="form-control">
                            @for($t=date('Y')-2; $t<=date('Y')+1; $t++)
                                <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>
                                    {{ $t }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="tgl_rekon">Pilih Tanggal Rekon:</label>
                        <input type="date" name="tgl_rekon" id="tgl_rekon" class="form-control"
                            value="{{ $tgl_rekon ?? date('Y-m-d') }}">
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Terapkan</button>
                        <button type="submit" class="btn btn-danger">Reset</button>
                    </div>
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>

                <div class="row">
                    <div class="col 4">
                    </div>
                    <div class="col 8">
                    </div>
                    <div class="col 2 text-end">
                        {{-- <button type="submit" class="btn btn-success">Cetak</button> --}}
                        {{-- Button Cetak PDF --}}
                        <a href="{{ route('baprekon.cetak', ['bulan' => $bulan, 'tahun' => $tahun, 'tgl_rekon' => $tgl_rekon]) }}"
                        target="_blank" class="btn btn-danger">
                        Cetak PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-2">
                    <div style="padding-left:20px;" class="avatar-image  m-h-10 m-r-25">
                    <img src="/app/assets/images/logo/13.png"  width="40%">
                </div>
                </div>
                <div class="col-8">
                    <div class="center">
                        <h2>PEMERINTAH KOTA PALU</h2>
                        <h2>BADAN PENGELOLA KEUANGAN DAN ASET DAERAH (BPKAD)</h2>
                        <p>Jl. Balai Kota Selatan No. 2, Telp. (0451) 485880 - 485089</p>
                    </div>
                </div>
                <div class="col-2">
                </div>
            </div>
            <div class="kop-surat"></div>   
            <div class="center">
                <h8><b><b><u>BERITA ACARA</u></b></h8><br>
                <h8><b>REKONSILIASI PENERIMAAN / REALISASI PENDAPATAN</b></h8><br>
                <h8><b>BULAN {{ strtoupper($rekon->bulan) }}</b></h8>
            </div>
            
            <br>

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
            <br>

            <p> Bertindak untuk dan atas nama Badan Pendapatan Daerah Kota Palu, selanjutnya disebut <b>PIHAK KEDUA</b>.</p>

            <div class="row">
                    &nbsp;&nbsp;2. Nama
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;{{ $rekon->nama_bendahara }}<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jabatan
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;Bendahara Penerimaan {{ $rekon->nama_opd }}<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Alamat
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: &nbsp;{{ $rekon->alamat }}
            </div>
            <br>

            <p> Bertindak untuk dan atas nama BPKAD Kota Palu, selanjutnya disebut <b>PIHAK PERTAMA</b>.</p>

            <p> Kedua belah pihak telah melakukan rekonsiliasi penerimaan pendapatan bulan
                {{ $rekon->bulan }}</b> dengan hasil sebagai berikut:</p>

            <table>
                <thead>
                    <tr>
                        <th style="text-align:center; background-color: #dddddd;" width="10px">No</th>
                        <th style="text-align:center; background-color: #dddddd;" width="500px">Uraian</th>
                        <th style="text-align:center; background-color: #dddddd;" width="20px">Anggaran</th>
                        <th style="text-align:center; background-color: #dddddd;" width="20px">Realisasi s/d bulan ini (BPKAD)</th>
                        <th style="text-align:center; background-color: #dddddd;" width="20px">Realisasi s/d bulan ini (OPD)</th>
                        <th style="text-align:center; background-color: #dddddd;" width="20px">Selisih</th>
                        <th style="text-align:center; background-color: #dddddd;" width="10px">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tot_anggaran = $tot_bpkad = $tot_opd = $tot_selisih = 0;
                    @endphp
                    @foreach($rekonDetails as $i => $row)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $row->uraian }}</td>
                        <td style="text-align:right">{{ number_format($row->total_anggaran,2,',','.') }}</td>
                        <td style="text-align:right">{{ number_format($row->total_transaksi,2,',','.') }}</td>
                        <td style="text-align:right">{{ number_format($row->total_bku,2,',','.') }}</td>
                        <td style="text-align:right">{{ number_format($row->selisih,2,',','.') }}</td>
                        <td>{{ $row->status_rekon }}</td>
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
                        <a href="#" class="badge bg-primary">
                            Cetak Rincian Selisih
                        </a>
                    </p>
                    
                </div>
            </div>

            <br><br>
            <div class="row" style="display:flex;justify-content:space-between;">
                <div class="left" style="width:45%; text-align:center;">
                    PIHAK KEDUA<br>
                    Bendahara Penerimaan<br>
                    {{ $rekon->nama_opd }}<br><br><br><br><br>
                    ( {{ $rekon->nama_bendahara }} )<br>
                    Nip. {{ $rekon->pangkat }}
                </div>

                <div class="right" style="width:45%; text-align:center;">
                    PIHAK PERTAMA<br>
                    Kepala Seksi Penatausahaan Penerimaan<br><br><br><br><br><br>
                    ( FADHILA YUNUS, SE )<br>
                    Nip. 
                </div>
            </div>

        </div>
    </div>

@endsection