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

    <br><br><br>
    <div class="card-body">
        {{-- Header --}}
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

        <div class="accordion accordion-flush" id="pd">
            @foreach($akuns as $akun)
                @php $akunTotal = hitungAkun($akun); @endphp
                <div class="accordion-item">
                    <h2 class="accordion-header" id="pd1{{ $akun->id_akun }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cpd1{{ $akun->id_akun }}" aria-expanded="true" aria-controls="cpd1{{ $akun->id_akun }}">
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

                    <div id="cpd1{{ $akun->id_akun }}" class="accordion-collapse collapse" aria-labelledby="headingOne{{ $akun->id_akun }}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            <div class="accordion accordion-flush" id="pad{{ $akun->id_akun }}">
                                @foreach($akun->kelompok as $kel)
                                    @php $kelTotal = hitungKelompok($kel); @endphp
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="pad1{{ $kel->id_kelompok }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cpad1{{ $kel->id_kelompok }}" aria-expanded="true" aria-controls="cpad1{{ $kel->id_kelompok }}">
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

                                        <div id="cpad1{{ $kel->id_kelompok }}" class="accordion-collapse collapse" aria-labelledby="headingOne{{ $kel->id_kelompok }}" data-bs-parent="#accordionExample{{ $akun->id_akun }}">   
                                            <div class="accordion-body">
                                                {{-- Pajak Daerah --}}
                                                <div class="accordion-header" id="pad11{{ $kel->id_kelompok }}">
                                                    @foreach($kel->jenis as $jen)
                                                        @php $jenTotal = hitungJenis($jen); @endphp
                                                        <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad11">
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
                                                        </div>

                                                        <div id="collapsellpad11{{ $jen->id_jenis }}" class="accordion-collapse collapse" data-parent="#pad11{{ $kel->id_kelompok }}">
                                                            <div class="accordion-header" id="pad111{{ $jen->id_jenis }}">
                                                                @foreach($jen->objek as $obj)
                                                                    @php $objTotal = hitungObjek($obj); @endphp
                                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad111">
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
                                                                    </div>

                                                                    {{-- <div id="collapsellpad111" class="collapse" data-parent="#pad111">
                                                                        <div class="row col-md-12 col-md-12">
                                                                            <div class="col-md-5 table-bordered">
                                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pajak Kendaraan Bermotor (PKB)</i>
                                                                            </div>
                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                <span> {{ number_format($tanggaran_pdpkb, 2) }}</span>
                                                                            </div>
                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                <span> {{ number_format($total_pdpkb, 2) }}</span>
                                                                            </div>
                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                <span>{{ number_format($tanggaran_pdpkb - $total_pdpkb, 2) }}</span>
                                                                            </div>
                                                                            <div class="col-md-1 table-bordered" align="right">
                                                                                @if ($total_pdpkb > 0 && $tanggaran_pdpkb > 0)
                                                                                    <span>{{ number_format($total_pdpkb / $tanggaran_pdpkb * 100, 2) }} %</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="row col-md-12 col-md-12">
                                                                            <div class="col-md-5 table-bordered">
                                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Bea Balik Nama Kendaraan Bermotor (BBNKB)</i>
                                                                            </div>
                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                <span> {{ number_format($tanggaran_pdbbnkp, 2) }}</span>
                                                                            </div>
                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                <span> {{ number_format($total_pdbbnkp, 2) }}</span>
                                                                            </div>
                                                                            <div class="col-md-2 table-bordered" align="right">
                                                                                <span>{{ number_format($tanggaran_pdbbnkp - $total_pdbbnkp, 2) }}</span>
                                                                            </div>
                                                                            <div class="col-md-1 table-bordered" align="right">
                                                                                @if ($total_pdbbnkp > 0 && $tanggaran_pdbbnkp > 0)
                                                                                    <span>{{ number_format($total_pdbbnkp / $tanggaran_pdbbnkp * 100, 2) }} %</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div> --}}

                                                                @endforeach
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

@include('Penatausahaan.Penerimaan.Realisasi_Opd.Fungsi.Fungsi')
@endsection