@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row col-md-12">
            <div class="col-2">
                <div style="padding-left:30px;" class="avatar-image  m-h-10 m-r-25">
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

                    @php
                    // === HITUNG SUBTOTAL ===

                    // level paling bawah: subrincian
                    function hitungSubrincian($sub) {
                        $anggaran = optional($sub->anggaran);
                        $nilaiAnggaran = $anggaran->nilai_anggaranopd ?? 0;
                        $realisasi = $anggaran ? $anggaran->bku?->sum('nilai_transaksi') ?? 0 : 0;

                        return [
                            'anggaran' => $nilaiAnggaran,
                            'realisasi' => $realisasi,
                            'sisa' => $nilaiAnggaran - $realisasi,
                            'persen' => $nilaiAnggaran > 0 ? round(($realisasi / $nilaiAnggaran) * 100, 2) : 0,
                        ];
                    }

                    // level rincian objek → kumpulkan subrincian
                    function hitungRincian($rin) {
                        $totalAnggaran = 0;
                        $totalRealisasi = 0;

                        foreach ($rin->subrincian as $sub) {
                            $subtot = hitungSubrincian($sub);
                            $totalAnggaran += $subtot['anggaran'];
                            $totalRealisasi += $subtot['realisasi'];
                        }

                        $sisa = $totalAnggaran - $totalRealisasi;
                        $persen = $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 2) : 0;

                        return [
                            'anggaran' => $totalAnggaran,
                            'realisasi' => $totalRealisasi,
                            'sisa' => $sisa,
                            'persen' => $persen,
                        ];
                    }

                    // level objek → kumpulkan rincian
                    function hitungObjek($obj) {
                        $totalAnggaran = 0;
                        $totalRealisasi = 0;

                        foreach ($obj->rincian as $rin) {
                            $rinSubtotal = hitungRincian($rin);
                            $totalAnggaran += $rinSubtotal['anggaran'];
                            $totalRealisasi += $rinSubtotal['realisasi'];
                        }

                        $sisa = $totalAnggaran - $totalRealisasi;
                        $persen = $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 2) : 0;

                        return [
                            'anggaran' => $totalAnggaran,
                            'realisasi' => $totalRealisasi,
                            'sisa' => $sisa,
                            'persen' => $persen,
                        ];
                    }

                    // level jenis → kumpulkan objek
                    function hitungJenis($jen) {
                        $totalAnggaran = 0;
                        $totalRealisasi = 0;

                        foreach ($jen->objek as $obj) {
                            $objSubtotal = hitungObjek($obj);
                            $totalAnggaran += $objSubtotal['anggaran'];
                            $totalRealisasi += $objSubtotal['realisasi'];
                        }

                        $sisa = $totalAnggaran - $totalRealisasi;
                        $persen = $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 2) : 0;

                        return [
                            'anggaran' => $totalAnggaran,
                            'realisasi' => $totalRealisasi,
                            'sisa' => $sisa,
                            'persen' => $persen,
                        ];
                    }

                    // level kelompok → kumpulkan jenis
                    function hitungKelompok($kelompok) {
                        $totalAnggaran = 0;
                        $totalRealisasi = 0;

                        foreach ($kelompok->jenis as $jen) {
                            $jenSubtotal = hitungJenis($jen);
                            $totalAnggaran += $jenSubtotal['anggaran'];
                            $totalRealisasi += $jenSubtotal['realisasi'];
                        }

                        $sisa = $totalAnggaran - $totalRealisasi;
                        $persen = $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 2) : 0;

                        return [
                            'anggaran' => $totalAnggaran,
                            'realisasi' => $totalRealisasi,
                            'sisa' => $sisa,
                            'persen' => $persen,
                        ];
                    }

                    // level akun → kumpulkan kelompok
                    function hitungAkun($akun) {
                        $totalAnggaran = 0;
                        $totalRealisasi = 0;

                        foreach ($akun->kelompok as $kel) {
                            $kelSubtotal = hitungKelompok($kel);
                            $totalAnggaran += $kelSubtotal['anggaran'];
                            $totalRealisasi += $kelSubtotal['realisasi'];
                        }

                        $sisa = $totalAnggaran - $totalRealisasi;
                        $persen = $totalAnggaran > 0 ? round(($totalRealisasi / $totalAnggaran) * 100, 2) : 0;

                        return [
                            'anggaran' => $totalAnggaran,
                            'realisasi' => $totalRealisasi,
                            'sisa' => $sisa,
                            'persen' => $persen,
                        ];
                    }
                    @endphp


                    <table class="table table-hover">
                        <tr>
                            <th style="text-align:center; word-wrap: break-word; overflow-wrap: break-word; background-color: #dddddd;">Kode Rekening</th>
                            <th style="text-align:center; word-wrap: break-word; overflow-wrap: break-word; background-color: #dddddd;">URAIAN</th>
                            <th style="text-align:center; background-color: #dddddd;" width="200px">ANGGARAN</th>
                            <th style="text-align:center; background-color: #dddddd;" width="200px">REALISASI</th>
                            <th style="text-align:center; background-color: #dddddd;" width="200px">SISA</th>
                            <th style="text-align:center; background-color: #dddddd;" width="60px">%</th>
                        </tr>

                        @php
                            $grandAnggaran = 0;
                            $grandRealisasi = 0;
                            $grandSisa = 0;
                        @endphp

                        {{-- looping akun --}}
                        @foreach($akuns as $akun)
                            @php 
                                $akunTotal = hitungAkun($akun);
                                $grandAnggaran += $akunTotal['anggaran'];
                                $grandRealisasi += $akunTotal['realisasi'];
                                $grandSisa += $akunTotal['sisa'];
                            @endphp
                            <tr style="background:#f7dfb2;">
                                <td>{{ $akun->no_rek }}</td>
                                <td><b>{{ $akun->rek }}</b></td>
                                <td class="text-end"><b>{{ number_format($akunTotal['anggaran'], 0, ',', '.') }}</b></td>
                                <td class="text-end"><b>{{ number_format($akunTotal['realisasi'], 0, ',', '.') }}</b></td>
                                <td class="text-end"><b>{{ number_format($akunTotal['sisa'], 0, ',', '.') }}</b></td>
                                <td class="text-end"><b>{{ $akunTotal['persen'] }}%</b></td>
                            </tr>

                            {{-- looping kelompok --}}
                            @foreach($akun->kelompok as $kel)
                                @php $kelTotal = hitungKelompok($kel); @endphp
                                <tr style="background:#f9efd5;">
                                    <td>{{ $kel->no_rek_kel }}</td>
                                    <td style="padding-left:20px;"><b>{{ $kel->rek_kel }}</b></td>
                                    <td class="text-end"><b>{{ number_format($kelTotal['anggaran'], 0, ',', '.') }}</b></td>
                                    <td class="text-end"><b>{{ number_format($kelTotal['realisasi'], 0, ',', '.') }}</b></td>
                                    <td class="text-end"><b>{{ number_format($kelTotal['sisa'], 0, ',', '.') }}</b></td>
                                    <td class="text-end"><b>{{ $kelTotal['persen'] }}%</b></td>
                                </tr>

                                {{-- looping jenis --}}
                                @foreach($kel->jenis as $jen)
                                    @php $jenTotal = hitungJenis($jen); @endphp
                                    <tr style="background:#fff7e6;">
                                        <td>{{ $jen->no_rek_jen }}</td>
                                        <td style="padding-left:40px;"><b>{{ $jen->rek_jen }}</b></td>
                                        <td class="text-end"><b>{{ number_format($jenTotal['anggaran'], 0, ',', '.') }}</b></td>
                                        <td class="text-end"><b>{{ number_format($jenTotal['realisasi'], 0, ',', '.') }}</b></td>
                                        <td class="text-end"><b>{{ number_format($jenTotal['sisa'], 0, ',', '.') }}</b></td>
                                        <td class="text-end"><b>{{ $jenTotal['persen'] }}%</b></td>
                                    </tr>

                                    {{-- looping objek --}}
                                    @foreach($jen->objek as $obj)
                                        @php $objTotal = hitungObjek($obj); @endphp
                                        <tr style="background:#f4faff;">
                                            <td>{{ $obj->no_rek_o }}</td>
                                            <td style="padding-left:60px;"><b>{{ $obj->rek_o }}</b></td>
                                            <td class="text-end"><b>{{ number_format($objTotal['anggaran'], 0, ',', '.') }}</b></td>
                                            <td class="text-end"><b>{{ number_format($objTotal['realisasi'], 0, ',', '.') }}</b></td>
                                            <td class="text-end"><b>{{ number_format($objTotal['sisa'], 0, ',', '.') }}</b></td>
                                            <td class="text-end"><b>{{ $objTotal['persen'] }}%</b></td>
                                        </tr>

                                        {{-- looping rincian objek --}}
                                        @foreach($obj->rincian as $rin)
                                            @php $rinTotal = hitungRincian($rin); @endphp
                                            <tr style="background:#fcfcfc;">
                                                <td>{{ $rin->no_rek_ro }}</td>
                                                <td style="padding-left:80px;">{{ $rin->rek_ro }}</td>
                                                <td class="text-end"><b>{{ number_format($rinTotal['anggaran'], 0, ',', '.') }}</b></td>
                                                <td class="text-end"><b>{{ number_format($rinTotal['realisasi'], 0, ',', '.') }}</b></td>
                                                <td class="text-end"><b>{{ number_format($rinTotal['sisa'], 0, ',', '.') }}</b></td>
                                                <td class="text-end"><b>{{ $rinTotal['persen'] }}%</b></td>
                                            </tr>

                                            {{-- looping sub rincian objek --}}
                                            @foreach($rin->subrincian as $sub)
                                                @php $subTotal = hitungSubrincian($sub); @endphp
                                                <tr>
                                                    <td>{{ $sub->no_rek_sro }}</td>
                                                    <td style="padding-left:100px;">{{ $sub->rek_sro }}</td>
                                                    <td class="text-end">{{ number_format($subTotal['anggaran'], 0, ',', '.') }}</td>
                                                    <td class="text-end">{{ number_format($subTotal['realisasi'], 0, ',', '.') }}</td>
                                                    <td class="text-end">{{ number_format($subTotal['sisa'], 0, ',', '.') }}</td>
                                                    <td class="text-end">{{ $subTotal['persen'] }}%</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                        @endforeach
                        
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