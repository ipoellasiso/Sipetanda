@extends('Template.Layout')
@section('content')


{{-- <div class="card"> --}}

    <div class="card">
        <div class="card-header">
            <h5 class="card-title">
                {{-- <a class="" data-toggle="" href=""> --}}
                    <div class="row">
                        <div class="col-5" align="center">
                            <b>Uraian</b>
                        </div>
                        <div class="col-2" align="center">
                            <b>Anggaran</b>
                        </div>
                        <div class="col-2" align="center">
                            <b>Realisasi</b>
                        </div>
                        <div class="col-2" align="center">
                            <b>Sisa</b>
                        </div>
                        <div class="col-1" align="center">
                            <b>%</b>
                        </div>
                    </div>
                {{-- </a> --}}
            </h5>
        </div>

        <div class="" id="accordion-default">
            <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <div class="collapsed" data-toggle="collapse" href="#collapseoneDefault">
                            <div class="row">
                                <div class="col-5 table-bordered">
                                    <b>Pendapatan Daerah</b>
                                </div>
                                <div class="col-2 table-bordered" align="right">
                                    <span> </span>
                                </div>
                                <div class="col-2 table-bordered" align="right">
                                    <span> {{ number_format($total_pendapatandaerah) }}</span>
                                </div>
                                <div class="col-2 table-bordered" align="right">
                                    <span> </span>
                                </div>
                                <div class="col-1 table-bordered" align="right">
                                    <span>20 %</span>
                                </div>
                            </div>
                        </div>
                    </h3>
                </div>
                <div id="collapseoneDefault" class="collapse" data-parent="#accordion-default">
                    

                        {{-- === PAD === --}}
                        <div class="" id="pad">
                            <div class="card">

                                <div class="card-header">
                                    <h5 class="card-title">
                                        <div class="collapsed" data-toggle="collapse" href="#collapsepad">
                                            <div class="row table-bordered">
                                                <div class="col-5 table-bordered">
                                                    <b>&nbsp;&nbsp;&nbsp;Pendapatan Asli Daerah (PAD)</b>
                                                </div>
                                                <div class="col-2 table-bordered" align="right">
                                                    <span> </span>
                                                </div>
                                                <div class="col-2 table-bordered" align="right">
                                                    <span> {{ number_format($total_pad) }}</span>
                                                </div>
                                                <div class="col-2 table-bordered" align="right">
                                                    <span> </span>
                                                </div>
                                                <div class="col-1 table-bordered" align="right">
                                                    <span> %</span>
                                                </div>
                                            </div>
                                        </div>
                                    </h5>
                                </div>

                                <div id="collapsepad" class="collapse" data-parent="#pad">
                                    <div class="" id="pad1">
                                        {{-- <div class="card"> --}}

                                            <div class="card-header">
                                                <h5 class="card-title">
                                                    <div class="collapsed" data-toggle="collapse" href="#collapsepad1">
                                                        <div class="row">
                                                            <div class="col-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pajak Daerah</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_pd) }}</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-1 table-bordered" align="right">
                                                                <span> %</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapsepad1" class="collapse" data-parent="#pad1">
                                                <div class="" id="pad1.1">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            <div class="collapsed" data-toggle="collapse" href="#collapsepad1.1">
                                                                <div class="row">
                                                                    <div class="col-5 table-bordered">
                                                                        <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pajak Hotel</i>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_pdhotel) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>

                                                                    <br>
                                                                    <div class="col-5 table-bordered">
                                                                        <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pajak Restoran</i>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_pdrestoran) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>

                                                                    <br>
                                                                    <div class="col-5 table-bordered">
                                                                        <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pajak Karaoke</i>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_pdkaraoke) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- </div> --}}
                                    </div>
                                </div>

                                <div id="collapsepad" class="collapse" data-parent="#pad">
                                    <div class="" id="pad2">
                                        {{-- <div class="card"> --}}

                                            <div class="card-header">
                                                <h5 class="card-title">
                                                    <div class="collapsed" data-toggle="collapse" href="#collapsepad2">
                                                        <div class="row">
                                                            <div class="col-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retribusi Daerah</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rd) }}</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-1 table-bordered" align="right">
                                                                <span> %</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapsepad2" class="collapse" data-parent="#pad2">
                                                <div class="" id="padd21">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            <div class="collapsed" data-toggle="collapse" href="#collapsepad21">
                                                                <div class="row">
                                                                    <div class="col-5 table-bordered">
                                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dinas Lingkungan Hidup</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_rddlh) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h5>
                                                    </div>
                                                    <div id="collapsepad21" class="collapse" data-parent="#padd21">
                                                        <div class="card-header">
                                                            <h5 class="card-title">
                                                                <div class="collapsed" data-toggle="collapse" href="#collapsepad21">
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retribusi Pelayanan Persampahan/ Kebersihan</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- </div> --}}
                                    </div>
                                </div>

                                <div id="collapsepad" class="collapse" data-parent="#pad">
                                    <div class="" id="pad3">
                                        {{-- <div class="card"> --}}

                                            <div class="card-header">
                                                <h5 class="card-title">
                                                    <div class="collapsed" data-toggle="collapse" href="#collapsepad3">
                                                        <div class="row">
                                                            <div class="col-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lain-Lain PAD Yang Sah</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_llp) }}</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-1 table-bordered" align="right">
                                                                <span> %</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapsepad3" class="collapse" data-parent="#pad3">
                                                <div class="" id="padd31">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            <div class="collapsed" data-toggle="collapse" href="#collapsepad31">
                                                                <div class="row">
                                                                    <div class="col-5 table-bordered">
                                                                        <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jasa Giro pada Kas Daerah</i>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_llpjsdaerah) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-5 table-bordered">
                                                                        <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Jasa Giro pada Kas di Bendahara</i>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_llpjsbendahara) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- </div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{-- == Batas PAD == --}}

                        <div class="" id="pt">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <div class="collapsed" data-toggle="collapse" href="#collapsept">
                                            <div class="row">
                                                <div class="col-5 table-bordered">
                                                    <b>&nbsp;&nbsp;&nbsp;Pendapatan Transfer</b>
                                                </div>
                                                <div class="col-2 table-bordered" align="right">
                                                    <span> </span>
                                                </div>
                                                <div class="col-2 table-bordered" align="right">
                                                    <span> {{ number_format($total_pt) }}</span>
                                                </div>
                                                <div class="col-2 table-bordered" align="right">
                                                    <span> </span>
                                                </div>
                                                <div class="col-1 table-bordered" align="right">
                                                    <span> %</span>
                                                </div>
                                            </div>
                                        </div>
                                    </h5>
                                </div>

                                <div id="collapsept" class="collapse" data-parent="#pt">
                                    <div class="" id="pt11">
                                        {{-- <div class="card"> --}}

                                            <div class="card-header">
                                                <h5 class="card-title">
                                                    <div class="collapsed" data-toggle="collapse" href="#collapsept11">
                                                        <div class="row">
                                                            <div class="col-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Pendapatan Transfer Pemerintah Pusat</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_ptpp) }}</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-1 table-bordered" align="right">
                                                                <span> %</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapsept11" class="collapse" data-parent="#pt11">
                                                <div class="" id="pt12">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            <div class="collapsed" data-toggle="collapse" href="#collapsept12">
                                                                <div class="row">
                                                                    <div class="col-5 table-bordered">
                                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dana Transfer Umum-Dana Bagi Hasil (DBH)</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_rddlh) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h5>
                                                    </div>
                                                    <div id="collapsept12" class="collapse" data-parent="#pt12">
                                                        <div class="card-header">
                                                            <h5 class="card-title">
                                                                <div class="collapsed" data-toggle="collapse" href="#collapsept11">
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DBH Pajak Bumi dan Bangunan</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DBH PPh Pasal 21</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DBH PPh Pasal 25 dan Pasal 29/WPOPDN</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DBH Cukai Hasil Tembakau (CHT)</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DBH Sumber Daya Alam (SDA) Minyak Bumi</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DBH Sumber Daya Alam (SDA) Gas Bumi</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dana Bagi Hasil (DBH) Sumber Daya Alam (SDA) Mineral dan Batubara-Royalty</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DBH Sumber Daya Alam (SDA) Kehutanan- Provisi Sumber Daya Hutan (PSDH)</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; DBH Sumber Daya Alam (SDA) Perikanan</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DBH Sumber Daya Alam (SDA) Perkebunan Sawit</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="collapsept11" class="collapse" data-parent="#pt11">
                                                <div class="" id="pt13">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            <div class="collapsed" data-toggle="collapse" href="#collapsept13">
                                                                <div class="row">
                                                                    <div class="col-5 table-bordered">
                                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Dana Transfer Umum-Dana Alokasi Umum (DAU)</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_ptdau) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h5>
                                                    </div>
                                                    <div id="collapsept13" class="collapse" data-parent="#pt13">
                                                        <div class="card-header">
                                                            <h5 class="card-title">
                                                                <div class="collapsed" data-toggle="collapse" href="#collapsept11">
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAU</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_ptdaudau) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAU Tambahan Dukungan Pendanaan Kelurahan</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAU Tambahan Dukungan Pendanaan atas Kebijakan Penggajian PPPK</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAU yang Ditentukan Penggunaannya Bidang Pendidikan</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAU yang Ditentukan Penggunaannya Bidang Kesehatan</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DAU yang Ditentukan Penggunaannya Bidang Pekerjaan Umum</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- </div> --}}
                                    </div>
                                </div>

                                <div id="collapsept" class="collapse" data-parent="#pt">
                                    <div class="" id="pt2">
                                        {{-- <div class="card"> --}}

                                            <div class="card-header">
                                                <h5 class="card-title">
                                                    <div class="collapsed" data-toggle="collapse" href="#collapsept2">
                                                        <div class="row">
                                                            <div class="col-5 table-bordered">
                                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retribusi Daerah</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> {{ number_format($total_rd) }}</span>
                                                            </div>
                                                            <div class="col-2 table-bordered" align="right">
                                                                <span> </span>
                                                            </div>
                                                            <div class="col-1 table-bordered" align="right">
                                                                <span> %</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </h5>
                                            </div>

                                            <div id="collapsept2" class="collapse" data-parent="#pt2">
                                                <div class="" id="pt21">
                                                    <div class="card-header">
                                                        <h5 class="card-title">
                                                            <div class="collapsed" data-toggle="collapse" href="#collapsept21">
                                                                <div class="row">
                                                                    <div class="col-5 table-bordered">
                                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dinas Lingkungan Hidup</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span class="text-right">{{ number_format($total_rddlh) }}</span>
                                                                    </div>
                                                                    <div class="col-2 table-bordered" align="right">
                                                                        <span></span>
                                                                    </div>
                                                                    <div class="col-1 table-bordered" align="right">
                                                                        <span> %</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </h5>
                                                    </div>
                                                    <div id="collapsept21" class="collapse" data-parent="#pt21">
                                                        <div class="card-header">
                                                            <h5 class="card-title">
                                                                <div class="collapsed" data-toggle="collapse" href="#collapsept21">
                                                                    <div class="row">
                                                                        <div class="col-5 table-bordered">
                                                                            <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retribusi Pelayanan Persampahan/ Kebersihan</i>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span class="text-right">{{ number_format($total_rddlhsampah) }}</span>
                                                                        </div>
                                                                        <div class="col-2 table-bordered" align="right">
                                                                            <span></span>
                                                                        </div>
                                                                        <div class="col-1 table-bordered" align="right">
                                                                            <span> %</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        {{-- </div> --}}
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="" id="llpdys">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">
                                        <div class="collapsed" data-toggle="collapse" href="#collapsellpdys">
                                            <div class="row">
                                                <div class="col-5">
                                                    <b>&nbsp;&nbsp;&nbsp;Lain - Lain Pendapatan Daerah Yang Sah</b>
                                                </div>
                                                <div class="col-2" align="right">
                                                    <span> </span>
                                                </div>
                                                <div class="col-2" align="right">
                                                    <span> </span>
                                                </div>
                                                <div class="col-2" align="right">
                                                    <span> </span>
                                                </div>
                                                <div class="col-1 text-center">
                                                    <span>20 %</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="collapsellpdys" class="collapse" data-parent="#llpdys">
                                            <div class="card-body">
                                                ...
                                            </div>
                                        </div>
                                    </h5>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


   
{{-- </div> --}}



@endsection