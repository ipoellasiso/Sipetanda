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
                            <?php
                                // $angka = $total_pendapatandaerah - $tanggaran_pendapatandaerah;
                                // echo ($angka < 0 ? "(".abs($angka).")" : $angka);
                                // $formatted_angka = number_format($angka, 2, '.', ',');
                                // $format1 = $angka < 0 ? "(".abs($angka).")" : $angka;
                                // $format1 = $angka < 0 ? $angka : $angka;
                                // $formatted_angka = number_format($format1, 2, '.', ',');

                            ?>
                            <div class="col-md-5">
                                <b>Pendapatan Daerah</b>
                            </div>
                            <div class="col-md-2" align="right">
                            </div>
                            <div class="col-md-2" align="right">
                            </div>
                            <div class="col-md-2" align="right">
                            </div>
                            <div class="col-md-1" align="right">
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
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                            </div>
                                            <div class="col-md-2 table-bordered" align="right">
                                            </div>
                                            <div class="col-md-1 table-bordered" align="right">
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
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                    </div>
                                                    <div class="col-md-2 table-bordered" align="right">
                                                    </div>
                                                    <div class="col-md-1 table-bordered" align="right">
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
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="collapsellpad111" class="collapse" data-parent="#pad111">
                                                        <div class="row col-md-12 col-md-12">
                                                            <div class="col-md-5 table-bordered">
                                                                <i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&nbsp; Pajak Kendaraan Bermotor (PKB)</i>
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                            </div>
                                                            <div class="col-md-2 table-bordered" align="right">
                                                            </div>
                                                            <div class="col-md-1 table-bordered" align="right">
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

@include('Penatausahaan.Penerimaan.Realisasi_Opd.Fungsi.Fungsi')
@endsection