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

                    <div class="row col-md-12 col-md-12 table table-striped">
                        <div class="col-md-5" align="center">
                            <b>Uraian</b>
                        </div>
                        <div class="col-md-2" align="center">
                            <b>Anggaran</b>
                        </div>
                        <div class="col-md-2" align="center">
                            <b>Realisasi</b>
                        </div>
                        <div class="col-md-2" align="center">
                            <b>Sisa</b>
                        </div>
                        <div class="col-md-1" align="center">
                            <b>%</b>
                        </div>
                    </div>

                    <div class="accordion" id="accordionAkun">
                        @foreach($akuns as $akun)
                            @php $akunTotal = hitungAkun($akun); @endphp

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingAkun{{ $akun->id_akun }}">
                                    <button class="accordion-button collapsed" type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapseAkun{{ $akun->id_akun }}" 
                                            aria-expanded="false" aria-controls="collapseAkun{{ $akun->id_akun }}">

                                        <div class="row col-md-12 col-md-12">
                                            <div class="col-md-5">
                                                {{ $akun->no_rek }} - {{ $akun->rek }}
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($akunTotal['anggaran'],0,',','.') }}</span>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                {{ number_format($akunTotal['realisasi'],0,',','.') }}
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                {{ number_format($akunTotal['sisa'], 0, ',', '.') }}
                                            </div>
                                            <div class="col-md-1 table-bordered" align="right">
                                                {{ $akunTotal['persen'] }}%
                                            </div>
                                        </div>

                                    </button>
                                </h2>
                                <div id="collapseAkun{{ $akun->id_akun }}" class="accordion-collapse collapse" 
                                    aria-labelledby="headingAkun{{ $akun->id_akun }}" data-bs-parent="#accordionAkun">
                                    <div class="accordion-body">

                                        {{-- Kelompok --}}
                                        <div class="accordion" id="accordionKelompok{{ $akun->id_akun }}">
                                            @foreach($akun->kelompok as $kel)
                                                @php $kelTotal = hitungKelompok($kel); @endphp

                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="headingKel{{ $kel->id_kelompok }}">
                                                        <button class="accordion-button collapsed" type="button" 
                                                                data-bs-toggle="collapse" 
                                                                data-bs-target="#collapseKel{{ $kel->id_kelompok }}" 
                                                                aria-expanded="false" aria-controls="collapseKel{{ $kel->id_kelompok }}">

                                                                <div class="row col-md-12 col-md-12">
                                                                    <div class="col-md-5">
                                                                        {{ $kel->no_rek_kel }} - {{ $kel->rek_kel }}
                                                                    </div>
                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                        <span> {{ number_format($akunTotal['anggaran'],0,',','.') }}</span>
                                                                    </div>
                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                        {{ number_format($akunTotal['realisasi'],0,',','.') }}
                                                                    </div>
                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                        {{ number_format($akunTotal['sisa'], 0, ',', '.') }}
                                                                    </div>
                                                                    <div class="col-md-1 table-bordered" align="right">
                                                                        {{ $akunTotal['persen'] }}%
                                                                    </div>
                                                                </div>

                                                        </button>
                                                    </h2>
                                                    <div id="collapseKel{{ $kel->id_kelompok }}" class="accordion-collapse collapse" 
                                                        aria-labelledby="headingKel{{ $kel->id_kelompok }}" 
                                                        data-bs-parent="#accordionKelompok{{ $akun->id_akun }}">
                                                        <div class="accordion-body">

                                                            {{-- Jenis --}}
                                                            <div class="accordion" id="accordionJenis{{ $kel->id_kelompok }}">
                                                                @foreach($kel->jenis as $jen)
                                                                    @php $jenTotal = hitungJenis($jen); @endphp

                                                                    <div class="accordion-item">
                                                                        <h2 class="accordion-header" id="headingJen{{ $jen->id_jenis }}">
                                                                            <button class="accordion-button collapsed" type="button" 
                                                                                    data-bs-toggle="collapse" 
                                                                                    data-bs-target="#collapseJen{{ $jen->id_jenis }}" 
                                                                                    aria-expanded="false" aria-controls="collapseJen{{ $jen->id_jenis }}">

                                                                                <div class="row col-md-12 col-md-12">
                                                                                    <div class="col-md-5">
                                                                                        {{ $jen->no_rek_jen }} - {{ $jen->rek_jen }}
                                                                                    </div>
                                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                                        <span> {{ number_format($akunTotal['anggaran'],0,',','.') }}</span>
                                                                                    </div>
                                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                                        {{ number_format($akunTotal['realisasi'],0,',','.') }}
                                                                                    </div>
                                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                                        {{ number_format($akunTotal['sisa'], 0, ',', '.') }}
                                                                                    </div>
                                                                                    <div class="col-md-1 table-bordered" align="right">
                                                                                        {{ $akunTotal['persen'] }}%
                                                                                    </div>
                                                                                </div>

                                                                            </button>
                                                                        </h2>
                                                                        <div id="collapseJen{{ $jen->id_jenis }}" class="accordion-collapse collapse" 
                                                                            aria-labelledby="headingJen{{ $jen->id_jenis }}" 
                                                                            data-bs-parent="#accordionJenis{{ $kel->id_kelompok }}">
                                                                            <div class="accordion-body">

                                                                                {{-- Objek --}}
                                                                                <div class="accordion" id="accordionObjek{{ $jen->id_jenis }}">
                                                                                    @foreach($jen->objek as $obj)
                                                                                        @php $objTotal = hitungObjek($obj); @endphp

                                                                                        <div class="accordion-item">
                                                                                            <h2 class="accordion-header" id="headingObj{{ $obj->id_objek }}">
                                                                                                <button class="accordion-button collapsed" type="button" 
                                                                                                        data-bs-toggle="collapse" 
                                                                                                        data-bs-target="#collapseObj{{ $obj->id_objek }}" 
                                                                                                        aria-expanded="false" aria-controls="collapseObj{{ $obj->id_objek }}">

                                                                                                        <div class="row col-md-12 col-md-12">
                                                                                                            <div class="col-md-5">
                                                                                                                {{ $obj->no_rek_o }} - {{ $obj->rek_o }}
                                                                                                            </div>
                                                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                                                <span> {{ number_format($akunTotal['anggaran'],0,',','.') }}</span>
                                                                                                            </div>
                                                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                                                {{ number_format($akunTotal['realisasi'],0,',','.') }}
                                                                                                            </div>
                                                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                                                {{ number_format($akunTotal['sisa'], 0, ',', '.') }}
                                                                                                            </div>
                                                                                                            <div class="col-md-1 table-bordered" align="right">
                                                                                                                {{ $akunTotal['persen'] }}%
                                                                                                            </div>
                                                                                                        </div>

                                                                                                </button>
                                                                                            </h2>
                                                                                            <div id="collapseObj{{ $obj->id_objek }}" class="accordion-collapse collapse" 
                                                                                                aria-labelledby="headingObj{{ $obj->id_objek }}" 
                                                                                                data-bs-parent="#accordionObjek{{ $jen->id_jenis }}">
                                                                                                <div class="accordion-body">

                                                                                                    {{-- Rincian --}}
                                                                                                    <div class="accordion" id="accordionRin{{ $obj->id_objek }}">
                                                                                                        @foreach($obj->rincian as $rin)
                                                                                                            @php $rinTotal = hitungRincian($rin); @endphp

                                                                                                            <div class="accordion-item">
                                                                                                                <h2 class="accordion-header" id="headingRin{{ $rin->id_rincianobjek }}">
                                                                                                                    <button class="accordion-button collapsed" type="button" 
                                                                                                                            data-bs-toggle="collapse" 
                                                                                                                            data-bs-target="#collapseRin{{ $rin->id_rincianobjek }}" 
                                                                                                                            aria-expanded="false" aria-controls="collapseRin{{ $rin->id_rincianobjek }}">
                                                                                                                        
                                                                                                                            <div class="row col-md-12 col-md-12">
                                                                                                                                <div class="col-md-5">
                                                                                                                                    {{ $rin->no_rek_ro }} - {{ $rin->rek_ro }}
                                                                                                                                </div>
                                                                                                                                <div class="col-md-2 table-bordered" align="right">
                                                                                                                                    <span> {{ number_format($akunTotal['anggaran'],0,',','.') }}</span>
                                                                                                                                </div>
                                                                                                                                <div class="col-md-2 table-bordered" align="right">
                                                                                                                                    {{ number_format($akunTotal['realisasi'],0,',','.') }}
                                                                                                                                </div>
                                                                                                                                <div class="col-md-2 table-bordered" align="right">
                                                                                                                                    {{ number_format($akunTotal['sisa'], 0, ',', '.') }}
                                                                                                                                </div>
                                                                                                                                <div class="col-md-1 table-bordered" align="right">
                                                                                                                                    {{ $akunTotal['persen'] }}%
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                    </button>
                                                                                                                </h2>
                                                                                                                <div id="collapseRin{{ $rin->id_rincianobjek }}" class="accordion-collapse collapse" 
                                                                                                                    aria-labelledby="headingRin{{ $rin->id_rincianobjek }}" 
                                                                                                                    data-bs-parent="#accordionRin{{ $obj->id_objek }}">
                                                                                                                    <div class="accordion-body">

                                                                                                                        {{-- Sub Rincian --}}
                                                                                                                        <ul class="list-group">
                                                                                                                            @foreach($rin->subrincian as $sub)
                                                                                                                                @php $subTotal = hitungSubrincian($sub); @endphp
                                                                                                                                <li class="list-group-item d-flex justify-content-between">
                                                                                                                                    
                                                                                                                                    <div class="row col-md-12 col-md-12">
                                                                                                                                    <div class="col-md-5">
                                                                                                                                        {{ $sub->no_rek_sro }} - {{ $sub->rek_sro }}
                                                                                                                                    </div>
                                                                                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                                                                                        <span> {{ number_format($akunTotal['anggaran'],0,',','.') }}</span>
                                                                                                                                    </div>
                                                                                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                                                                                        {{ number_format($akunTotal['realisasi'],0,',','.') }}
                                                                                                                                    </div>
                                                                                                                                    <div class="col-md-2 table-bordered" align="right">
                                                                                                                                        {{ number_format($akunTotal['sisa'], 0, ',', '.') }}
                                                                                                                                    </div>
                                                                                                                                    <div class="col-md-1 table-bordered" align="right">
                                                                                                                                        {{ $akunTotal['persen'] }}%
                                                                                                                                    </div>
                                                                                                                                </div>

                                                                                                                                </li>
                                                                                                                            @endforeach
                                                                                                                        </ul>

                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        @endforeach
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>


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