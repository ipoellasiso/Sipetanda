@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-header">
        {{-- <h4>Default</h4> --}}
    </div>
    <div class="card-body">
        {{-- Header --}}
        <div class="accordion" id="">
            <div class="accordion-item">
                <h4 class="accordion-header" id="headingOne">
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
                </h4>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="" aria-controls="collapseOne">
                        <div class="row col-md-12 col-md-12">
                            @if($dataq->count() > 0 )
                                @foreach ($dataq as $d)
                                    <div class="col-md-5">
                                        <b>{{$d->rek}}</b>
                                    </div>
                                    <div class="col-md-2" align="right">
                                    </div>
                                    <div class="col-md-2" align="right">{{number_format($d->nilai_transaksi, 0)}},00
                                    </div>
                                    <div class="col-md-2" align="right">
                                    </div>
                                    <div class="col-md-1" align="right">
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        </button>
                    </h2>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="" aria-controls="collapseTwo">
                            <b>&nbsp;&nbsp;&nbsp;Pendapatan Asli Daerah (PAD)</b>
                            </button>
                        </h2>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="" aria-controls="collapseThree">
                            <b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retribusi Daerah </b>
                            </button>
                        </h2>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="" aria-controls="collapseThree">
                            <div class="row col-md-12 col-md-12">
                                @if($dataq6->count() > 0 )
                                    @foreach ($dataq6 as $d)
                                        <div class="col-md-5" style="text-align: justify; text-indent: px; padding-left: 40px;">
                                            <b>{{$d->rek_sro}}</b>
                                        </div>
                                        <div class="col-md-2" align="right">
                                        </div>
                                        <div class="col-md-2" align="right">{{number_format($d->nilai_transaksi_sro, 0)}},00
                                        </div>
                                        <div class="col-md-2" align="right">
                                        </div>
                                        <div class="col-md-1" align="right">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            </button>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    
    </div>
</div>

@include('Penatausahaan.Penerimaan.Realisasi_Opd.Fungsi.Fungsi')
@endsection