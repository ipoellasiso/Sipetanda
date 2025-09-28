@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row col-md-12">
            <div class="col-2">
                <div class="avatar-image  m-h-10 m-r-25">
                    <img src="/app/assets/images/logo/13.png"  width="40%">
                </div>
            </div>
            <div class="col-8 text-center">
                <b><h5>PEMERINTAHAN KOTA PALU</b><br>
                <b><h5>LAPORAN REALISASI ANGGARAN PENDAPATAN DAERAH</b>
                @if ($datainduk)
                    <b><h5>{{strtoupper($datainduk->nama_opd)}} </h4></b>
                @else
                        <h5>DATA BELUM ADA</h5>
                @endif
                <b><h5>TAHUN ANGGARAN 2025</h6></b>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>

    <br><br><br>
    <div class="card-body">
        <div class="card-body px-0 py-1">
            <div class="card">
                <div class="card-body">
                    <style>
                        table {
                            border-collapse: collapse; /* Menggabungkan garis sel */
                            width: 100%;
                        }
                        table, th, td {
                            border: 1px solid black; /* Menambahkan garis pada tabel, header, dan sel */
                        }
                        th, td {
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #ffffff;
                        }
                    </style>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Rekening</th>
                                <th>URAIAN</th>
                                <th class="text-end">ANGGARAN</th>
                                <th class="text-end">REALISASI</th>
                                <th class="text-end">SISA</th>
                                <th class="text-center">%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // group by akun
                                $grouped = $anggarans->groupBy('id_akun');
                            @endphp

                            @foreach($grouped as $akun => $kelompokAnggaran)
                                @php
                                    $totalAnggaranAkun  = $kelompokAnggaran->sum('nilai_anggaranopd');
                                    $totalRealisasiAkun = $kelompokAnggaran->map->bku->flatten()->sum('nilai_transaksi');
                                    $sisaAkun           = $totalAnggaranAkun - $totalRealisasiAkun;
                                    $persenAkun         = $totalAnggaranAkun > 0
                                                            ? round(($totalRealisasiAkun / $totalAnggaranAkun) * 100, 2)
                                                            : 0;
                                @endphp
                                {{-- AKUN --}}
                                <tr>
                                    <td>{{ $akun }}</td>
                                    <td><strong>PENDAPATAN DAERAH</strong></td>
                                    <td class="text-end">{{ number_format($totalAnggaranAkun, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($totalRealisasiAkun, 0, ',', '.') }}</td>
                                    <td class="text-end">{{ number_format($sisaAkun, 0, ',', '.') }}</td>
                                    <td class="text-center">{{ $persenAkun }}%</td>
                                </tr>

                                {{-- Kelompok --}}
                                @foreach($kelompokAnggaran->groupBy('id_kelompok') as $kelompok => $jenisAnggaran)
                                    @php
                                        $totalAnggaranKel  = $jenisAnggaran->sum('nilai_anggaranopd');
                                        $totalRealisasiKel = $jenisAnggaran->map->bku->flatten()->sum('nilai_transaksi');
                                        $sisaKel           = $totalAnggaranKel - $totalRealisasiKel;
                                        $persenKel         = $totalAnggaranKel > 0
                                                            ? round(($totalRealisasiKel / $totalAnggaranKel) * 100, 2)
                                                            : 0;
                                    @endphp
                                    <tr>
                                        <td>{{ $akun.'.'.$kelompok }}</td>
                                        <td>&nbsp;&nbsp;&nbsp;<strong>PENDAPATAN ASLI DAERAH (PAD)</strong></td>
                                        <td class="text-end">{{ number_format($totalAnggaranKel, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($totalRealisasiKel, 0, ',', '.') }}</td>
                                        <td class="text-end">{{ number_format($sisaKel, 0, ',', '.') }}</td>
                                        <td class="text-center">{{ $persenKel }}%</td>
                                    </tr>

                                    {{-- Jenis → Objek → Rincian → Sub Rincian --}}
                                    @foreach($jenisAnggaran as $row)
                                        @php
                                            $totalRealisasi = $row->bku->sum('nilai_transaksi');
                                            $sisa   = $row->nilai_anggaranopd - $totalRealisasi;
                                            $persen = $row->nilai_anggaranopd > 0
                                                        ? round(($totalRealisasi / $row->nilai_anggaranopd) * 100, 2)
                                                        : 0;

                                            $kodeRekening = implode('.', array_filter([
                                                $row->id_akun,
                                                $row->id_kelompok,
                                                $row->id_jenis,
                                                $row->id_objek,
                                                $row->id_rincianobjek,
                                                $row->id_subrincianobjek
                                            ]));
                                        @endphp
                                        <tr>
                                            <td>{{ $kodeRekening }}</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $row->uraian }}</td>
                                            <td class="text-end">{{ number_format($row->nilai_anggaranopd, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($totalRealisasi, 0, ',', '.') }}</td>
                                            <td class="text-end">{{ number_format($sisa, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $persen }}%</td>
                                        </tr>
                                    @endforeach

                                @endforeach
                            @endforeach
                        </tbody>
                    </table>

                    <br><br>
                    @if ($datainduk)
                        <div class="row">
                            <div class="col-5 align-middle fw-bold text-center" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                                Mengetahui,<br>
                                {{ strtoupper($datainduk->jabatan) }}<br>
                                {{ strtoupper($datainduk->nama_opd) }}<br><br><br><br><br><br>
                                {{ $datainduk->nama_kepala_opd }}<br>
                                NIP. {{ $datainduk->nip_kepala_opd }}
                            </div>
                            <div class="col-2">
                            </div>
                            <div class="col-5 align-middle fw-bold text-center" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;"><br>
                                Palu, {{ now()->format('d M Y') }}<br>
                                BENDAHARA PENERIMAAN<br><br><br><br><br><br>
                                {{ $datainduk->nama_bendahara }}<br>
                                NIP. {{ $datainduk->nip_bendahara }}
                            </div>
                        </div>
                    @else
                            <h5></h5>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>

@include('Penatausahaan.Penerimaan.Realisasi_Opd.Fungsi.Fungsi')
@endsection