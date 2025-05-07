@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-header">
        <h4>Default</h4>
    </div>
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
            <div class="accordion-item">
                <h2 class="accordion-header" id="pd1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cpd1" aria-expanded="true" aria-controls="cpd1">
                        <div class="row col-md-12 col-md-12">
                            <div class="col-md-5">
                                <b>Pendapatan Daerah</b>
                            </div>
                            <div class="col-md-2" align="right">
                                <span> {{ number_format($tanggaran_pendapatandaerah, 2) }}</span>
                            </div>
                            <div class="col-md-2" align="right">
                                <span> {{ number_format($total_pendapatandaerah, 2) }}</span>
                            </div>
                            <div class="col-md-2" align="right">
                                <span> {{ number_format($tanggaran_pendapatandaerah - $total_pendapatandaerah, 2) }}</span>
                            </div>
                            <div class="col-md-1" align="right">
                                @if ($total_pendapatandaerah > 0 && $tanggaran_pendapatandaerah > 0)
                                    <span> {{ number_format($total_pendapatandaerah / $tanggaran_pendapatandaerah * 100, 2) }} %</span>
                                @endif
                            </div>
                        </div>
                    </button>
                </h2>
                <div id="cpd1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">

                        <div class="accordion accordion-flush" id="pad">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="pad1">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#cpad1" aria-expanded="true" aria-controls="cpad1">
                                        <div class="row col-md-12 col-md-12">
                                            <div class="col-md-5 table-bordered">
                                                <b>Pendapatan Asli Daerah (PAD)</b>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($tanggaran_pad, 2) }}</span>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($total_pad, 2) }}</span>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($tanggaran_pad - $total_pad, 2) }}</span>
                                            </div>
                                            <div class="col-md-1 table-bordered" align="right">
                                                @if ($total_pad > 0 && $tanggaran_pad > 0)
                                                    <span> {{ number_format($total_pad / $tanggaran_pad * 100, 2) }} %</span>
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="cpad1" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">   
                                    <div class="accordion-body">
                                        {{-- Pajak Daerah --}}
                                        <div class="" id="pad11">
                                            <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad11">
                                                <div class="row col-md-12 col-md-12">
                                                    <div class="col-md-5 table-bordered">
                                                        <span>&nbsp;&nbsp;&nbsp; Pajak Daerah</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_pd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($total_pd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_pd - $total_pd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
                                                        @if ($total_pd > 0 && $tanggaran_pd > 0)
                                                            <span> {{ number_format($total_pd / $tanggaran_pd * 100, 2) }} %</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapsellpad11" class="collapse" data-parent="#pad11">
                                                <div class="" id="pad111">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad111">
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Badan Pendapatan Daerah</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdbapenda, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdbapenda, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdbapenda - $total_pdbapenda, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdbapenda > 0 && $tanggaran_pdbapenda > 0)
                                                                    <span> {{ number_format($total_pdbapenda / $tanggaran_pdbapenda * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad111" class="collapse" data-parent="#pad111">
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
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pajak Reklame</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdreklame, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdreklame, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdreklame - $total_pdreklame, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdreklame > 0 && $tanggaran_pdreklame > 0)
                                                                    <span>{{ number_format($total_pdreklame / $tanggaran_pdreklame * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pajak Penerangan Jalan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdppj, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdppj, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdppj - $total_pdppj, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdppj > 0 && $tanggaran_pdppj > 0)
                                                                    <span>{{ number_format($total_pdppj / $tanggaran_pdppj * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pajak Air Tanah</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdpat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdpat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdpat - $total_pdpat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdpat > 0 && $tanggaran_pdpat > 0)
                                                                    <span>{{ number_format($total_pdpat / $tanggaran_pdpat * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pajak Sarang Burung Walet</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdwalet, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdwalet, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdwalet - $total_pdwalet, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdwalet > 0 && $tanggaran_pdwalet > 0)
                                                                    <span>{{ number_format($total_pdwalet / $tanggaran_pdwalet * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pajak Mineral Bukan Logam dan Batuan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdlogam, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdlogam, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdlogam - $total_pdlogam, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdlogam > 0 && $tanggaran_pdlogam > 0)
                                                                    <span>{{ number_format($total_pdlogam / $tanggaran_pdlogam * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pajak Bumi dan Bangunan Perdesaan dan Perkotaan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (PBBP2)</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdpbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdpbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdpbb - $total_pdpbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdpbb > 0 && $tanggaran_pdpbb > 0)
                                                                    <span>{{ number_format($total_pdpbb / $tanggaran_pdpbb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Bea Perolehan Hak Atas Tanah dan Bangunan (BPHTB)</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdbphtb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdbphtb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdbphtb - $total_pdbphtb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdbphtb > 0 && $tanggaran_pdbphtb > 0)
                                                                    <span>{{ number_format($total_pdbphtb / $tanggaran_pdbphtb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; PBJT-Restoran</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdrestoran, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdrestoran, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdrestoran - $total_pdrestoran, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdrestoran > 0 && $tanggaran_pdrestoran > 0)
                                                                    <span>{{ number_format($total_pdrestoran / $tanggaran_pdrestoran * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; PBJT-Hotel</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdhotel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdhotel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdhotel - $total_pdhotel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdhotel > 0 && $tanggaran_pdhotel > 0)
                                                                    <span>{{ number_format($total_pdhotel / $tanggaran_pdhotel * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; PBJT-Penyediaan atau Penyelenggaraan Tempat Parkir</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdparkir - $total_pdparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdparkir > 0 && $tanggaran_pdparkir > 0)
                                                                    <span>{{ number_format($total_pdparkir / $tanggaran_pdparkir * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; PBJT-Distkotek, Karaoke, Kelab Malam, Bar,</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dan Mandi Uap/Spa</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_pdkaraoke, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pdkaraoke, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_pdkaraoke - $total_pdkaraoke, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdkaraoke > 0 && $tanggaran_pdkaraoke > 0)
                                                                    <span>{{ number_format($total_pdkaraoke / $tanggaran_pdkaraoke * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- Retribudi Daerah --}}
                                        <div class="" id="pad21">
                                            <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad21">
                                                <div class="row col-md-12">
                                                    <div class="col-md-5 table-bordered">
                                                        <span>&nbsp;&nbsp;&nbsp; Retribusi Daerah</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_rd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($total_rd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_rd - $total_rd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
                                                        @if ($total_rd > 0 && $tanggaran_rd > 0)
                                                            <span> {{ number_format($total_rd / $tanggaran_rd * 100, 2) }} %</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapsellpad21" class="collapse" data-parent="#pad21">
                                                <div class="" id="pad121">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad121">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Kesehatan</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddinkes, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddinkes, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddinkes - $total_rddinkes, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddinkes > 0 && $tanggaran_rddinkes > 0)
                                                                    <span> {{ number_format($total_rddinkes / $tanggaran_rddinkes * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad121" class="collapse" data-parent="#pad121">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pelayanan Kesehatan di Puskesmas</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddinkespkm, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddinkespkm, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rddinkespkm - $total_rddinkespkm, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddinkespkm > 0 && $tanggaran_rddinkespkm > 0)
                                                                    <span>{{ number_format($total_rddinkespkm / $tanggaran_rddinkespkm * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pad122">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad122">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Lingkungan Hidup</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddlh, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddlh, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddlh - $total_rddlh, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddlh > 0 && $tanggaran_rddlh > 0)
                                                                    <span> {{ number_format($total_rddlh / $tanggaran_rddlh * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad122" class="collapse" data-parent="#pad122">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pelayanan Persampahan/ Kebersihan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddlhsampah, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddlhsampah, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rddlhsampah - $total_rddlhsampah, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddlhsampah > 0 && $tanggaran_rddlhsampah > 0)
                                                                    <span>{{ number_format($total_rddlhsampah / $tanggaran_rddlhsampah * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pelayanan Tempat Rekreasi dan Olahraga</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddlholahraga, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddlholahraga, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rddlholahraga - $total_rddlholahraga, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddlholahraga > 0 && $tanggaran_rddlholahraga > 0)
                                                                    <span>{{ number_format($total_rddlholahraga / $tanggaran_rddlholahraga * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pad123">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad123">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Penataan Ruang dan Pertanahan</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdtr, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdtr, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdtr - $total_rdtr, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdtr > 0 && $tanggaran_rdtr > 0)
                                                                    <span> {{ number_format($total_rdtr / $tanggaran_rdtr * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad123" class="collapse" data-parent="#pad123">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Persetujuan Bangunan Gedung</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdtrimb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdtrimb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdtrimb - $total_rdtrimb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdtrimb > 0 && $tanggaran_rdtrimb > 0)
                                                                    <span>{{ number_format($total_rdtrimb / $tanggaran_rdtrimb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pad124">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad124">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Pemuda dan Olahraga</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddispora, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddispora, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddispora - $total_rddispora, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddispora > 0 && $tanggaran_rddispora > 0)
                                                                    <span> {{ number_format($total_rddispora / $tanggaran_rddispora * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad124" class="collapse" data-parent="#pad124">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pelayanan Tempat Rekreasi dan Olahraga</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddisporaolahraga, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddisporaolahraga, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rddisporaolahraga - $total_rddisporaolahraga, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddisporaolahraga > 0 && $tanggaran_rddisporaolahraga > 0)
                                                                    <span>{{ number_format($total_rddisporaolahraga / $tanggaran_rddisporaolahraga * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pad125">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad125">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Perhubungan</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddishub, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddishub, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddishub - $total_rddishub, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddishub > 0 && $tanggaran_rddishub > 0)
                                                                    <span> {{ number_format($total_rddishub / $tanggaran_rddishub * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad125" class="collapse" data-parent="#pad125">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Penyediaan Pelayanan Parkir di Tepi Jalan Umum</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddishubparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddishubparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rddishubparkir - $total_rddishubparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddishubparkir > 0 && $tanggaran_rddishubparkir > 0)
                                                                    <span>{{ number_format($total_rddishubparkir / $tanggaran_rddishubparkir * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pemakaian Kendaraan Bermotor</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddishubpkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddishubpkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rddishubpkb - $total_rddishubpkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddishubpkb > 0 && $tanggaran_rddishubpkb > 0)
                                                                    <span>{{ number_format($total_rddishubpkb / $tanggaran_rddishubpkb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pelayanan Penyediaan Fasilitas</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lainnya di Lingkungan Terminal</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rddishubterminal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rddishubterminal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rddishubterminal - $total_rddishubterminal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rddishubterminal > 0 && $tanggaran_rddishubterminal > 0)
                                                                    <span>{{ number_format($total_rddishubterminal / $tanggaran_rddishubterminal * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pad126">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad126">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Pertanian dan Ketahanan Pangan</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpertanian, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpertanian, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpertanian - $total_rdpertanian, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpertanian > 0 && $tanggaran_rdpertanian > 0)
                                                                    <span> {{ number_format($total_rdpertanian / $tanggaran_rdpertanian * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad126" class="collapse" data-parent="#pad126">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Penyediaan Tempat Pelelangan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpertanianpelelangan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpertanianpelelangan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdpertanianpelelangan - $total_rdpertanianpelelangan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpertanianpelelangan > 0 && $tanggaran_rdpertanianpelelangan > 0)
                                                                    <span>{{ number_format($total_rdpertanianpelelangan / $tanggaran_rdpertanianpelelangan * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pelayanan Rumah Potong Hewan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpertanianrph, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpertanianrph, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdpertanianrph - $total_rdpertanianrph, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpertanianrph > 0 && $tanggaran_rdpertanianrph > 0)
                                                                    <span>{{ number_format($total_rdpertanianrph / $tanggaran_rdpertanianrph * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Penjualan Produksi Hasil Usaha </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Daerah berupa Bibit atau Benih Tanaman</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpertanianbt, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpertanianbt, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdpertanianbt - $total_rdpertanianbt, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpertanianbt > 0 && $tanggaran_rdpertanianbt > 0)
                                                                    <span>{{ number_format($total_rdpertanianbt / $tanggaran_rdpertanianbt * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Penjualan Produksi hasil Usaha </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Daerah berupa Bibit atau Benih Ikan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpertanianbi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpertanianbi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdpertanianbi - $total_rdpertanianbi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpertanianbi > 0 && $tanggaran_rdpertanianbi > 0)
                                                                    <span>{{ number_format($total_rdpertanianbi / $tanggaran_rdpertanianbi * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pad127">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad127">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Koperasi, UMKM dan Tenaga Kerja</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdkoperasi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdkoperasi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdkoperasi - $total_rdkoperasi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdkoperasi > 0 && $tanggaran_rdkoperasi > 0)
                                                                    <span> {{ number_format($total_rdkoperasi / $tanggaran_rdkoperasi * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad127" class="collapse" data-parent="#pad127">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pemakaian Alat</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdkoperasialat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdkoperasialat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdkoperasialat - $total_rdkoperasialat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdkoperasialat > 0 && $tanggaran_rdkoperasialat > 0)
                                                                    <span>{{ number_format($total_rdkoperasialat / $tanggaran_rdkoperasialat * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Penyediaan Tempat Kegiatan Usaha,</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; berupa Pasar, Grosir Pertokoan, dan Tempat </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kegiatan Usaha Lainnya</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdkoperasipasar, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdkoperasipasar, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdkoperasipasar - $total_rdkoperasipasar, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdkoperasipasar > 0 && $tanggaran_rdkoperasipasar > 0)
                                                                    <span>{{ number_format($total_rdkoperasipasar / $tanggaran_rdkoperasipasar * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Penggunaan Tenaga Kerja Asing (TKA)</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdkoperasiimta, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdkoperasiimta, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdkoperasiimta - $total_rdkoperasiimta, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdkoperasiimta > 0 && $tanggaran_rdkoperasiimta > 0)
                                                                    <span>{{ number_format($total_rdkoperasiimta / $tanggaran_rdkoperasiimta * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pad128">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad128">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Perdagangan dan Perindustrian</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdperindag, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdperindag, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdperindag - $total_rdperindag, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdperindag > 0 && $tanggaran_rdperindag > 0)
                                                                    <span> {{ number_format($total_rdperindag / $tanggaran_rdperindag * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad128" class="collapse" data-parent="#pad128">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Penyediaan Fasilitas Pasar Grosir</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Berbagai Jenis Barang yang Dikontrakkan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdperindagpasar, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdperindagpasar, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdperindagpasar - $total_rdperindagpasar, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdperindagpasar > 0 && $tanggaran_rdperindagpasar > 0)
                                                                    <span>{{ number_format($total_rdperindagpasar / $tanggaran_rdperindagpasar * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pad129">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad129">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dinas Pekerjaan Umum</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpu - $total_rdpu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpu > 0 && $tanggaran_rdpu > 0)
                                                                    <span> {{ number_format($total_rdpu / $tanggaran_rdpu * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad129" class="collapse" data-parent="#pad129">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Penyediaan dan/atau Penyedotan Kakus</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpukakus, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpukakus, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdpukakus - $total_rdpukakus, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpukakus > 0 && $tanggaran_rdpukakus > 0)
                                                                    <span>{{ number_format($total_rdpukakus / $tanggaran_rdpukakus * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pemakaian Laboratorium</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpulab, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpulab, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdpulab - $total_rdpulab, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpulab > 0 && $tanggaran_rdpulab > 0)
                                                                    <span>{{ number_format($total_rdpulab / $tanggaran_rdpulab * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Retribusi Pemakaian Alat</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_rdpualat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rdpualat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_rdpualat - $total_rdpualat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_rdpualat > 0 && $tanggaran_rdpualat > 0)
                                                                    <span>{{ number_format($total_rdpualat / $tanggaran_rdpualat * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- Hasil Kekayaan Daerah --}}
                                        <div class="" id="pad31">
                                            <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad31">
                                                <div class="row col-md-12">
                                                    <div class="col-md-5 table-bordered">
                                                        <span>&nbsp;&nbsp;&nbsp; Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_hpkddividen, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($total_hpkddividen, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_hpkddividen - $total_hpkddividen, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
                                                        @if ($total_hpkddividen > 0 && $tanggaran_hpkddividen > 0)
                                                            <span> {{ number_format($total_hpkddividen / $tanggaran_hpkddividen * 100, 2) }} %</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapsellpad31" class="collapse" data-parent="#pad31">
                                                <div class="" id="pad131">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad131">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Badan Pengelolaan Keuangan dan Aset Daerah</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($tanggaran_allbpka, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($total_allbpka, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($tanggaran_allbpka - $total_allbpka, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($total_allbpka / $tanggaran_allbpka * 100, 2) }} %</span> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad131" class="collapse" data-parent="#pad131">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Bagian Laba yang Dibagikan kepada Pemerintah </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Daerah (Dividen) atas Penyertaan Modal pada BUMN</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_hpkddividenbumn, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_hpkddividenbumn, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_hpkddividenbumn - $total_hpkddividenbumn, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_hpkddividenbumn > 0 && $tanggaran_hpkddividenbumn > 0)
                                                                    <span>{{ number_format($total_hpkddividenbumn / $tanggaran_hpkddividenbumn * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- LLP --}}
                                        <div class="" id="pad41">
                                            <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad41">
                                                <div class="row col-md-12">
                                                    <div class="col-md-5 table-bordered">
                                                        <span>&nbsp;&nbsp;&nbsp; Lain-lain PAD yang Sah </span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_llp, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($total_llp, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_llp - $total_llp, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
                                                        @if ($total_llp > 0 && $tanggaran_llp > 0)
                                                            <span> {{ number_format($total_llp / $tanggaran_llp * 100, 2) }} %</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapsellpad41" class="collapse" data-parent="#pad41">
                                                <div class="" id="pad141">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellpad141">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Badan Pengelolaan Keuangan dan Aset Daerah</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($tanggaran_pdbapenda, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($total_pdbapenda, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($tanggaran_pdbapenda - $total_pdbapenda, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($total_pdbapenda / $tanggaran_pdbapenda * 100, 2) }} %</span> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad141" class="collapse" data-parent="#pad141">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Hasil Penjualan Bangunan Gedung-Bangunan Gedung</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tempat Kerja-Bangunan Gedung Kantor</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpgk, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpgk, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpgk - $total_llpgk, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpgk > 0 && $tanggaran_llpgk > 0)
                                                                    <span>{{ number_format($total_llpgk / $tanggaran_llpgk * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Hasil Penjualan Konstruksi Dalam Pengerjaan </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Peralatan dan Mesin-Alat Besar-Alat Besar </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Darat-Alat Besar Darat Lainnya</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpabd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpabd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpabd - $total_llpabd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpabd > 0 && $tanggaran_llpabd > 0)
                                                                    <span>{{ number_format($total_llpabd / $tanggaran_llpabd * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Hasil Sewa BMD</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpbmd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpbmd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpbmd - $total_llpbmd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpbmd > 0 && $tanggaran_llpbmd > 0)
                                                                    <span>{{ number_format($total_llpbmd / $tanggaran_llpbmd * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Jasa Giro pada Kas Daerah</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpjskd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpjskd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpjskd - $total_llpjskd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpjskd > 0 && $tanggaran_llpjskd > 0)
                                                                    <span>{{ number_format($total_llpjskd / $tanggaran_llpjskd * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Jasa Giro pada Kas di Bendahara</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpjgkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpjgkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpjgkb - $total_llpjgkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpjgkb > 0 && $tanggaran_llpjgkb > 0)
                                                                    <span>{{ number_format($total_llpjgkb / $tanggaran_llpjgkb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Bunga atas Penempatan Uang</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pemerintah Daerah</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llppbpd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llppbpd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llppbpd - $total_llppbpd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llppbpd > 0 && $tanggaran_llppbpd > 0)
                                                                    <span>{{ number_format($total_llppbpd / $tanggaran_llppbpd * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda atas Keterlambatan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pelaksanaan Pekerjaan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdendaket, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdendaket, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdendaket - $total_llpdendaket, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdendaket > 0 && $tanggaran_llpdendaket > 0)
                                                                    <span>{{ number_format($total_llpdendaket / $tanggaran_llpdendaket * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda Pajak Hotel</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdphotel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdphotel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdphotel - $total_llpdphotel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdphotel > 0 && $tanggaran_llpdphotel > 0)
                                                                    <span>{{ number_format($total_llpdphotel / $tanggaran_llpdphotel * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda Pajak Restoran dan Sejenisnya</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdpres, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdpres, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdpres - $total_llpdpres, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdpres > 0 && $tanggaran_llpdpres > 0)
                                                                    <span>{{ number_format($total_llpdpres / $tanggaran_llpdpres * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda Pajak Diskotik, Karaoke,</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Klub Malam, dan Sejenisnya</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdpkaraoke, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdpkaraoke, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdpkaraoke - $total_llpdpkaraoke, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdpkaraoke > 0 && $tanggaran_llpdpkaraoke > 0)
                                                                    <span>{{ number_format($total_llpdpkaraoke / $tanggaran_llpdpkaraoke * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda Pajak Reklame Papan/ Billboard/</i><br>
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Videotron/Megatron</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdprek, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdprek, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdprek - $total_llpdprek, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdprek > 0 && $tanggaran_llpdprek > 0)
                                                                    <span>{{ number_format($total_llpdprek / $tanggaran_llpdprek * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda Pajak Parkir</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdpparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdpparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdpparkir - $total_llpdpparkir, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdpparkir > 0 && $tanggaran_llpdpparkir > 0)
                                                                    <span>{{ number_format($total_llpdpparkir / $tanggaran_llpdpparkir * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda Pajak Air Tanah</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdpabt, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdpabt, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdpabt - $total_llpdpabt, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdpabt > 0 && $tanggaran_llpdpabt > 0)
                                                                    <span>{{ number_format($total_llpdpabt / $tanggaran_llpdpabt * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda Pajak Mineral Bukan Logam</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dan Batuan Lainnya</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdplogam, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdplogam, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdplogam - $total_llpdplogam, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdplogam > 0 && $tanggaran_llpdplogam > 0)
                                                                    <span>{{ number_format($total_llpdplogam / $tanggaran_llpdplogam * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda PBBP2</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdpbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdpbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdpbb - $total_llpdpbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdpbb > 0 && $tanggaran_llpdpbb > 0)
                                                                    <span>{{ number_format($total_llpdpbb / $tanggaran_llpdpbb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda BPHTB</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdbphtb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdbphtb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdbphtb - $total_llpdbphtb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdbphtb > 0 && $tanggaran_llpdbphtb > 0)
                                                                    <span>{{ number_format($total_llpdbphtb / $tanggaran_llpdbphtb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan dari Pengembalian Kelebihan Pembayaran </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Perjalanan Dinas Dalam Negeri- Perjalanan Dinas Biasa</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpperjadin, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpperjadin, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpperjadin - $total_llpperjadin, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpperjadin > 0 && $tanggaran_llpperjadin > 0)
                                                                    <span>{{ number_format($total_llpperjadin / $tanggaran_llpperjadin * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan dari Pengembalian Kelebihan Pembayaran </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Belanja Tunjangan PPh/Tunjangan Khusus ASN-Tunjangan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PPh/Tunjangan Khusus PNS</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpgaji, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpgaji, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpgaji - $total_llpgaji, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpgaji > 0 && $tanggaran_llpgaji > 0)
                                                                    <span>{{ number_format($total_llpgaji / $tanggaran_llpgaji * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan dari Pengembalian Kelebihan Pembayaran</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pembayaran Belanja Barang Pakai Habis-Bahan-Bahan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Lainnya</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpbph, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpbph, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpbph - $total_llpbph, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpbph > 0 && $tanggaran_llpbph > 0)
                                                                    <span>{{ number_format($total_llpbph / $tanggaran_llpbph * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan dari Pengembalian Kelebihan Pembayaran </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Belanja Barang Pakai Habis-Barang untuk</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dijual/Diserahkan kepada Pihak Ketiga/Pihak Lain</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llppihakke3, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llppihakke3, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llppihakke3 - $total_llppihakke3, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llppihakke3 > 0 && $tanggaran_llppihakke3 > 0)
                                                                    <span>{{ number_format($total_llppihakke3 / $tanggaran_llppihakke3 * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan BLUD dari Jasa Layanan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpblud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpblud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpblud - $total_llpblud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpblud > 0 && $tanggaran_llpblud > 0)
                                                                    <span>{{ number_format($total_llpblud / $tanggaran_llpblud * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan BLUD dari Hasil Kerja Sama dengan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pihak Lain</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpbludhks, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpbludhks, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpbludhks - $total_llpbludhks, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpbludhks > 0 && $tanggaran_llpbludhks > 0)
                                                                    <span>{{ number_format($total_llpbludhks / $tanggaran_llpbludhks * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan BLUD dari Jasa Giro</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpbludjg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpbludjg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpbludjg - $total_llpbludjg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpbludjg > 0 && $tanggaran_llpbludjg > 0)
                                                                    <span>{{ number_format($total_llpbludjg / $tanggaran_llpbludjg * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Denda atas Pelanggaran Peraturan Daerah</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdperwali, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdperwali, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdperwali - $total_llpdperwali, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdperwali > 0 && $tanggaran_llpdperwali > 0)
                                                                    <span>{{ number_format($total_llpdperwali / $tanggaran_llpdperwali * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Lain - Lain Pendapatan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpllp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpllp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpllp - $total_llpllp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpllp > 0 && $tanggaran_llpllp > 0)
                                                                    <span>{{ number_format($total_llpllp / $tanggaran_llpllp * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan dari Pengembalian dari uang muka (Pihak ke3)</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llppengembalianp3, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llppengembalianp3, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llppengembalianp3 - $total_llppengembalianp3, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llppengembalianp3 > 0 && $tanggaran_llppengembalianp3 > 0)
                                                                    <span>{{ number_format($total_llppengembalianp3 / $tanggaran_llppengembalianp3 * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan dari Pengembalian Temuan hasil</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pemerikasaan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llppengembalianhtp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llppengembalianhtp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llppengembalianhtp - $total_llppengembalianhtp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llppengembalianhtp > 0 && $tanggaran_llppengembalianhtp > 0)
                                                                    <span>{{ number_format($total_llppengembalianhtp / $tanggaran_llppengembalianhtp * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Dana Kapitasi JKN pada FKTP</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpjknfktp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpjknfktp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpjknfktp - $total_llpjknfktp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpjknfktp > 0 && $tanggaran_llpjknfktp > 0)
                                                                    <span>{{ number_format($total_llpjknfktp / $tanggaran_llpjknfktp * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="pt">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cpt" aria-expanded="false" aria-controls="cpt">
                                        <div class="row col-md-12">
                                            <div class="col-md-5 table-bordered">
                                                <b> Pendapatan Transfer</b>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($tanggaran_pt, 2) }}</span>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($total_pt, 2) }}</span>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($tanggaran_pt - $total_pt, 2) }}</span>
                                            </div>
                                            <div class="col-md-1 table-bordered" align="right">
                                                @if ($total_pt > 0 && $tanggaran_pt > 0)
                                                    <span> {{ number_format($total_pt / $tanggaran_pt * 100, 2) }} %</span>
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="cpt" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{-- Transfer dari Pusat --}}
                                        <div class="" id="pt11">
                                            <div class="collapsed" data-bs-toggle="collapse" href="#collapsept11">
                                                <div class="row col-md-12">
                                                    <div class="col-md-5 table-bordered">
                                                        <span>&nbsp;&nbsp;&nbsp; Pendapatan Transfer Pemerintah Pusat</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_ptpd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($total_ptpd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_ptpd - $total_ptpd, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
                                                        @if ($total_ptpd > 0 && $tanggaran_ptpd > 0)
                                                            <span> {{ number_format($total_ptpd / $tanggaran_ptpd * 100, 2) }} %</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapsept11" class="collapse" data-parent="#pt11">
                                                <div class="" id="pt111">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsept111">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dana Transfer Umum-Dana Bagi Hasil (DBH)</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpu - $total_ptdbhpu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdpkb > 0 && $tanggaran_pdpkb > 0)
                                                                    <span> {{ number_format($total_ptdbhpu / $tanggaran_ptdbhpu * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsept111" class="collapse" data-parent="#pt111">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-;&nbsp; DBH PBB</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpupbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpupbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpupbb - $total_ptdbhpupbb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpupbb > 0 && $tanggaran_ptdbhpupbb > 0)
                                                                    <span>{{ number_format($total_ptdbhpupbb / $tanggaran_ptdbhpupbb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH PPh Pasal 21</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpu21, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpu21, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpu21 - $total_ptdbhpu21, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpu21 > 0 && $tanggaran_ptdbhpu21 > 0)
                                                                    <span>{{ number_format($total_ptdbhpu21 / $tanggaran_ptdbhpu21 * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH PPh Pasal 25 dan Pasal 29/WPOPDN</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpu25, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpu25, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpu25 - $total_ptdbhpu25, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpu25 > 0 && $tanggaran_ptdbhpu25 > 0)
                                                                    <span>{{ number_format($total_ptdbhpu25 / $tanggaran_ptdbhpu25 * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH Cukai Hasil Tembakau (CHT)</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpucht, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpucht, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpucht - $total_ptdbhpucht, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpucht > 0 && $tanggaran_ptdbhpucht > 0)
                                                                    <span>{{ number_format($total_ptdbhpucht / $tanggaran_ptdbhpucht * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH SDA Minyak Bumi</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpumb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpumb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpumb - $total_ptdbhpumb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpumb > 0 && $tanggaran_ptdbhpumb > 0)
                                                                    <span>{{ number_format($total_ptdbhpumb / $tanggaran_ptdbhpumb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH SDA Gas Bumi</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpugb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpugb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpugb - $total_ptdbhpugb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpugb > 0 && $tanggaran_ptdbhpugb > 0)
                                                                    <span>{{ number_format($total_ptdbhpugb / $tanggaran_ptdbhpugb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH SDA Mineral dan Batubara- Royalty</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpubb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpubb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpubb - $total_ptdbhpubb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpubb > 0 && $tanggaran_ptdbhpubb > 0)
                                                                    <span>{{ number_format($total_ptdbhpubb / $tanggaran_ptdbhpubb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH SDA Kehutanan-Provisi Sumber Daya Hutan (PSDH)</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpuhutan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpuhutan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpuhutan - $total_ptdbhpuhutan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpuhutan > 0 && $tanggaran_ptdbhpuhutan > 0)
                                                                    <span>{{ number_format($total_ptdbhpuhutan / $tanggaran_ptdbhpuhutan * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH SDA Perikanan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpuperikanan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpuperikanan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpuperikanan - $total_ptdbhpuperikanan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpuperikanan > 0 && $tanggaran_ptdbhpuperikanan > 0)
                                                                    <span>{{ number_format($total_ptdbhpuperikanan / $tanggaran_ptdbhpuperikanan * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DBH Sawit</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdbhpusawit, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdbhpusawit, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdbhpusawit - $total_ptdbhpusawit, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdbhpusawit > 0 && $tanggaran_ptdbhpusawit > 0)
                                                                    <span>{{ number_format($total_ptdbhpusawit / $tanggaran_ptdbhpusawit * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pt121">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsept121">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dana Transfer Umum-Dana Alokasi Umum (DAU)</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdau, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdau, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdau - $total_ptdau, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdau > 0 && $tanggaran_ptdau > 0)
                                                                    <span> {{ number_format($total_ptdau / $tanggaran_ptdau * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsept121" class="collapse" data-parent="#pt121">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAU</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaudau, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaudau, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaudau - $total_ptdaudau, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaudau > 0 && $tanggaran_ptdaudau > 0)
                                                                    <span>{{ number_format($total_ptdaudau / $tanggaran_ptdaudau * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAU Tambahan Dukungan Pendanaan Kelurahan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaukel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaukel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaukel - $total_ptdaukel, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaukel > 0 && $tanggaran_ptdaukel > 0)
                                                                    <span>{{ number_format($total_ptdaukel / $tanggaran_ptdaukel * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAU Tambahan Dukungan Pendanaan atas Kebijakan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Penggajian Pegawai Pemerintah dengan Perjanjian Kerja</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaup3k, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaup3k, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaup3k - $total_ptdaup3k, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaup3k > 0 && $tanggaran_ptdaup3k > 0)
                                                                    <span>{{ number_format($total_ptdaup3k / $tanggaran_ptdaup3k * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAU yang Ditentukan Penggunaannya Bidang Pendidikan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaupend, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaupend, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaupend - $total_ptdaupend, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaupend > 0 && $tanggaran_ptdaupend > 0)
                                                                    <span>{{ number_format($total_ptdaupend / $tanggaran_ptdaupend * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAU yang Ditentukan Penggunaannya Bidang Kesehatan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaukes, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaukes, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaukes - $total_ptdaukes, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaukes > 0 && $tanggaran_ptdaukes > 0)
                                                                    <span>{{ number_format($total_ptdaukes / $tanggaran_ptdaukes * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAU yang Ditentukan Penggunaannya Bidang Pekerjaan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Umum</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaupu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaupu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaupu - $total_ptdaupu, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaupu > 0 && $tanggaran_ptdaupu > 0)
                                                                    <span>{{ number_format($total_ptdaupu / $tanggaran_ptdaupu * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pt131">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsept131">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dana Transfer Khusus-Dana Alokasi Khusus (DAK) Fisik</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakf, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdakf, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakf - $total_ptdakf, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdakf > 0 && $tanggaran_ptdakf > 0)
                                                                    <span> {{ number_format($total_ptdakf / $tanggaran_ptdakf * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsept131" class="collapse" data-parent="#pt131">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Fisik-Bidang Pendidikan-Reguler-PAUD</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakfpaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdakfpaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdakfpaud - $total_ptdakfpaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdakfpaud > 0 && $tanggaran_ptdakfpaud > 0)
                                                                    <span>{{ number_format($total_ptdakfpaud / $tanggaran_ptdakfpaud * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Fisik-Bidang Pendidikan-Reguler-SD</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakfsd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdakfsd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdakfsd - $total_ptdakfsd, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdakfsd > 0 && $tanggaran_ptdakfsd > 0)
                                                                    <span>{{ number_format($total_ptdakfsd / $tanggaran_ptdakfsd * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Fisik-Bidang Pendidikan-Reguler-SMP</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakfsmp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdakfsmp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdakfsmp - $total_ptdakfsmp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdakfsmp > 0 && $tanggaran_ptdakfsmp > 0)
                                                                    <span>{{ number_format($total_ptdakfsmp / $tanggaran_ptdakfsmp * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Fisik-Bidang Kesehatan dan KB-Penugasan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Peningkatan Pencegahan dan Pengendalian Penyakit</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; dan Sanitasi Total Berbasis Masyarakat</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakfpenyakitsanitasi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdakfpenyakitsanitasi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdakfpenyakitsanitasi - $total_ptdakfpenyakitsanitasi, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdakfpenyakitsanitasi > 0 && $tanggaran_ptdakfpenyakitsanitasi > 0)
                                                                    <span>{{ number_format($total_ptdakfpenyakitsanitasi / $tanggaran_ptdakfpenyakitsanitasi * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Fisik-Bidang Jalan-Reguler-Jalan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakfregjalan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdakfregjalan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdakfregjalan - $total_ptdakfregjalan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdakfregjalan > 0 && $tanggaran_ptdakfregjalan > 0)
                                                                    <span>{{ number_format($total_ptdakfregjalan / $tanggaran_ptdakfregjalan * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Fisik-Bidang Kesehatan dan KB-Penugasan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Keluarga Berencana</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakfkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdakfkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdakfkb - $total_ptdakfkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdakfkb > 0 && $tanggaran_ptdakfkb > 0)
                                                                    <span>{{ number_format($total_ptdakfkb / $tanggaran_ptdakfkb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Fisik-Bidang Kesehatan dan KB-Reguler</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Penguatan Sistem Kesehatan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdakfpsk, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdakfpsk, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdakfpsk - $total_ptdakfpsk, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdakfpsk > 0 && $tanggaran_ptdakfpsk > 0)
                                                                    <span>{{ number_format($total_ptdakfpsk / $tanggaran_ptdakfpsk * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pt141">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsept141">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dana Transfer Khusus-Dana Alokasi Khusus (DAK) Non Fisik</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknf, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknf, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknf - $total_ptdaknf, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknf > 0 && $tanggaran_ptdaknf > 0)
                                                                    <span> {{ number_format($total_ptdaknf / $tanggaran_ptdaknf * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsept141" class="collapse" data-parent="#pt141">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-BOS Reguler</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfbosreg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfbosreg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfbosreg - $total_ptdaknfbosreg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfbosreg > 0 && $tanggaran_ptdaknfbosreg > 0)
                                                                    <span>{{ number_format($total_ptdaknfbosreg / $tanggaran_ptdaknfbosreg * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-TPG PNSD</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknftpg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknftpg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknftpg - $total_ptdaknftpg, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknftpg > 0 && $tanggaran_ptdaknftpg > 0)
                                                                    <span>{{ number_format($total_ptdaknftpg / $tanggaran_ptdaknftpg * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-Tamsil Guru PNSD</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknftamsil, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknftamsil, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknftamsil - $total_ptdaknftamsil, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknftamsil > 0 && $tanggaran_ptdaknftamsil > 0)
                                                                    <span>{{ number_format($total_ptdaknftamsil / $tanggaran_ptdaknftamsil * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-BOP PAUD</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfpaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfpaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfpaud - $total_ptdaknfpaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfpaud > 0 && $tanggaran_ptdaknfpaud > 0)
                                                                    <span>{{ number_format($total_ptdaknfpaud / $tanggaran_ptdaknfpaud * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-BOP Pendidikan Kesetaraan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfkesetaraan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfkesetaraan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfkesetaraan - $total_ptdaknfkesetaraan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfkesetaraan > 0 && $tanggaran_ptdaknfkesetaraan > 0)
                                                                    <span>{{ number_format($total_ptdaknfkesetaraan / $tanggaran_ptdaknfkesetaraan * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-BOKKB-Pengawasan Obat dan Makanan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfobatmakanan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfobatmakanan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfobatmakanan - $total_ptdaknfobatmakanan, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfobatmakanan > 0 && $tanggaran_ptdaknfobatmakanan > 0)
                                                                    <span>{{ number_format($total_ptdaknfobatmakanan / $tanggaran_ptdaknfobatmakanan * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-BOKKB-Akreditasi Puskesmas</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfakreditaspkm, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfakreditaspkm, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfakreditaspkm - $total_ptdaknfakreditaspkm, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfakreditaspkm > 0 && $tanggaran_ptdaknfakreditaspkm > 0)
                                                                    <span>{{ number_format($total_ptdaknfakreditaspkm / $tanggaran_ptdaknfakreditaspkm * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-BOKB-KB</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfkb - $total_ptdaknfkb, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfkb > 0 && $tanggaran_ptdaknfkb > 0)
                                                                    <span>{{ number_format($total_ptdaknfkb / $tanggaran_ptdaknfkb * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-Dana Pelayanan Perlindungan </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Perempuan dan Anak</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfp3a, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfp3a, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfp3a - $total_ptdaknfp3a, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfp3a > 0 && $tanggaran_ptdaknfp3a > 0)
                                                                    <span>{{ number_format($total_ptdaknfp3a / $tanggaran_ptdaknfp3a * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-Dana BOSP-BOS Kinerja</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfboskin, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfboskin, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfboskin - $total_ptdaknfboskin, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfboskin > 0 && $tanggaran_ptdaknfboskin > 0)
                                                                    <span>{{ number_format($total_ptdaknfboskin / $tanggaran_ptdaknfboskin * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-Dana BOSP-BOP PAUD Reguler</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptdaknfbospaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptdaknfbospaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptdaknfbospaud - $total_ptdaknfbospaud, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptdaknfbospaud > 0 && $tanggaran_ptdaknfbospaud > 0)
                                                                    <span>{{ number_format($total_ptdaknfbospaud / $tanggaran_ptdaknfbospaud * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; DAK Non Fisik-Dana BOK-BOK Dinas-BOK</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kabupaten/Kota</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptkabkota, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptkabkota, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptkabkota - $total_ptkabkota, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptkabkota > 0 && $tanggaran_ptkabkota > 0)
                                                                    <span>{{ number_format($total_ptkabkota / $tanggaran_ptkabkota * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pt151">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsept151">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Insentif Fiskal</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptfiskalfiskal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptfiskal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptfiskal - $total_ptfiskal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptfiskal > 0 && $tanggaran_ptfiskal > 0)
                                                                    <span> {{ number_format($total_ptfiskal / $tanggaran_ptfiskal * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsept151" class="collapse" data-parent="#pt151">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Insentif Fiskal Untuk Penghargaan Kinerja</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tahun Berjalan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptfiskalfiskal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptfiskalfiskal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptfiskalfiskal - $total_ptfiskalfiskal, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptfiskalfiskal > 0 && $tanggaran_ptfiskalfiskal > 0)
                                                                    <span>{{ number_format($total_ptfiskalfiskal / $tanggaran_ptfiskalfiskal * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- Transfer Antar Daerah --}}
                                        <div class="" id="pt21">
                                            <div class="collapsed" data-bs-toggle="collapse" href="#collapsept21">
                                                <div class="row col-md-12">
                                                    <div class="col-md-5 table-bordered">
                                                        <span>&nbsp;&nbsp;&nbsp; Pendapatan Transfer Antar Daerah</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_ptad, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($total_ptad, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_ptad - $total_ptad, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
                                                        @if ($total_ptad > 0 && $tanggaran_ptad > 0)
                                                            <span> {{ number_format($total_ptad / $tanggaran_ptad * 100, 2) }} %</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapsept21" class="collapse" data-parent="#pt21">
                                                <div class="" id="pt211">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsept211">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pendapatan Bagi Hasil Pajak</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptadbhp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptadbhp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptadbhp - $total_ptadbhp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptadbhp > 0 && $tanggaran_ptadbhp > 0)
                                                                    <span> {{ number_format($total_ptadbhp / $tanggaran_ptadbhp * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsept211" class="collapse" data-parent="#pt211">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Bagi Hasil Pajak Bahan Bakar </i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kendaraan Bermotor</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptadbhpbbkp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptadbhpbbkp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptadbhpbbkp - $total_ptadbhpbbkp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptadbhpbbkp > 0 && $tanggaran_ptadbhpbbkp > 0)
                                                                    <span>{{ number_format($total_ptadbhpbbkp / $tanggaran_ptadbhpbbkp * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Bagi Hasil Pajak Air Permukaan</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptbhpair, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptbhpair, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptbhpair - $total_ptbhpair, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptbhpair > 0 && $tanggaran_ptbhpair > 0)
                                                                    <span>{{ number_format($total_ptbhpair / $tanggaran_ptbhpair * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Bagi Hasil Pajak Rokok</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptadbhprokok, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptadbhprokok, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptadbhprokok - $total_ptadbhprokok, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptadbhprokok > 0 && $tanggaran_ptadbhprokok > 0)
                                                                    <span>{{ number_format($total_ptadbhprokok / $tanggaran_ptadbhprokok * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="" id="pt221">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsept221">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Bantuan Keuangan Khusus dari Pemerintah Provinsi</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptadbkkpp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptadbkkpp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptadbkkpp - $total_ptadbkkpp, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_ptadbkkpp > 0 && $tanggaran_ptadbkkpp > 0)
                                                                    <span> {{ number_format($total_ptadbkkpp / $tanggaran_ptadbkkpp * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsept221" class="collapse" data-parent="#pt221">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Bantuan Keuangan Khusus dari Pemerintah</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Daerah Provinsi</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_ptadbkkpp2, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptadbkkpp2, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_ptadbkkpp2 - $total_ptadbkkpp2, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_pdpkb > 0 && $tanggaran_ptadbkkpp2 > 0)
                                                                    <span>{{ number_format($total_ptadbkkpp2 / $tanggaran_ptadbkkpp2 * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="llpdys">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cllpdys" aria-expanded="false" aria-controls="cllpdys">
                                        <div class="row col-md-12">
                                            <div class="col-md-5 table-bordered">
                                                <b>Lain-Lain Pendapatan Daerah Yang Sah</b>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($tanggaran_llpdys, 2) }}</span>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($total_llpdys, 2) }}</span>
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                                <span> {{ number_format($tanggaran_llpdys - $total_llpdys, 2) }}</span>
                                            </div>
                                            <div class="col-md-1 table-bordered" align="right">
                                                @if ($total_llpdys > 0 && $tanggaran_llpdys > 0)
                                                    <span> {{ number_format($total_llpdys / $tanggaran_llpdys * 100, 2) }} %</span>
                                                @endif
                                            </div>
                                        </div>
                                    </button>
                                </h2>
                                <div id="cllpdys" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{-- Pendapatan Hibah --}}
                                        <div class="" id="llp11">
                                            <div class="collapsed" data-bs-toggle="collapse" href="#collapsellp11">
                                                <div class="row col-md-12">
                                                    <div class="col-md-5 table-bordered">
                                                        <span>&nbsp;&nbsp;&nbsp; Pendapatan Hibah</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        {{-- <span> {{ number_format($tanggaran_llpdyshibah, 2) }}</span> --}}
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        {{-- <span> {{ number_format($total_llpdyshibah, 2) }}</span> --}}
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        {{-- <span> {{ number_format($tanggaran_llpdyshibah - $total_llpdyshibah, 2) }}</span> --}}
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
                                                        {{-- @if ($total_llpdyshibah > 0 && $tanggaran_llpdyshibah > 0) --}}
                                                            {{-- <span> {{ number_format($total_llpdyshibah / $tanggaran_llpdyshibah * 100, 2) }} %</span> --}}
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapsellp11" class="collapse" data-parent="#llp11">
                                                <div class="" id="llp111">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsellp111">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pendapatan Hibah dari Pemerintah Daerah Lainnya</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($tanggaran_llpdyslainya, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($total_llpdyslainya, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($tanggaran_llpdyslainya - $total_llpdyslainya, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                {{-- @if ($total_llpdyslainya > 0 && $tanggaran_llpdyslainya > 0) --}}
                                                                    {{-- <span> {{ number_format($total_llpdyslainya / $tanggaran_llpdyslainya * 100, 2) }} %</span> --}}
                                                                {{-- @endif --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellp111" class="collapse" data-parent="#llp111">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pendapatan Hibah dari Pemerintah Daerah</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($tanggaran_llpdyslainya2, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span> {{ number_format($total_llpdyslainya2, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                {{-- <span>{{ number_format($tanggaran_llpdyslainya2 - $total_llpdyslainya2, 2) }}</span> --}}
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                {{-- @if ($total_llpdyslainya2 > 0 && $tanggaran_llpdyslainya2 > 0) --}}
                                                                    {{-- <span>{{ number_format($total_llpdyslainya2 / $tanggaran_llpdyslainya2 * 100, 2) }} %</span> --}}
                                                                {{-- @endif --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        {{-- Lain-lain Pendapatan Sesuai dengan Ketentuan Peraturan Perundang-Undangan --}}
                                        <div class="" id="llp21">
                                            <div class="collapsed" data-bs-toggle="collapse" href="#collapsellp21">
                                                <div class="row col-md-12">
                                                    <div class="col-md-5 table-bordered">
                                                        <span>&nbsp;&nbsp;&nbsp; Lain-lain Pendapatan Sesuai dengan</span><br>
                                                        <span>&nbsp;&nbsp;&nbsp; Ketentuan Peraturan Perundang-Undangan</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_llpdysuu, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($total_llpdysuu, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                        <span> {{ number_format($tanggaran_llpdysuu - $total_llpdysuu, 2) }}</span>
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
                                                        @if ($total_llpdysuu > 0 && $tanggaran_llpdysuu > 0)
                                                            <span> {{ number_format($total_llpdysuu / $tanggaran_llpdysuu * 100, 2) }} %</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="collapsellp21" class="collapse" data-parent="#llp21">
                                                <div class="" id="pt321">
                                                    <div class="collapsed" data-bs-toggle="collapse" href="#collapsept321">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Kontribusi dari Sumber Lain yang Sah dan Tidak Mengikat</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdysuumengikat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdysuumengikat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdysuumengikat - $total_llpdysuumengikat, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdysuumengikat > 0 && $tanggaran_llpdysuumengikat > 0)
                                                                    <span> {{ number_format($total_llpdysuumengikat / $tanggaran_llpdysuumengikat * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsept321" class="collapse" data-parent="#pt321">
                                                        <div class="row col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Kontribusi dari Sumber Lain yang Sah dan</i><br>
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Tidak Mengikat</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($tanggaran_llpdysmengikat2, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llpdysmengikat2, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                                <span>{{ number_format($tanggaran_llpdysmengikat2 - $total_llpdysmengikat2, 2) }}</span>
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                                @if ($total_llpdysmengikat2 > 0 && $tanggaran_llpdysmengikat2 > 0)
                                                                    <span>{{ number_format($total_llpdysmengikat2 / $tanggaran_llpdysmengikat2 * 100, 2) }} %</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

        

    </div>
</div>

@include('Penatausahaan.Penerimaan.Realisasi.Fungsi.Fungsi')
@endsection