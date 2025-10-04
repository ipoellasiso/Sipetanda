@extends('Template.Layout')
@section('content')

<section class="tasks">
    <div class="row">
        <div class="col-lg-7">
            <div class="card widget-todo">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-flex">
                        {{ $title }}
                    </h4>
                    <a class="text-end btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto">
                        Rp. {{ number_format($total = $dataq->sum('nilai_transaksi'), 0) }},00
                    </a>
                </div>
                
                <div class="card-body px-0 py-1 overflow-auto">
                    <div class="card">
                        <div class="card-body">
                            <table id="data-table" class="tabelfix table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th></th>
                                        <th>Nomor Bukti</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Uraian</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                @php $total = 0; @endphp
                                <tfoot>
                                    {{-- <tr>
                                        <th colspan="5" style="text-align: right">Total</th>
                                        <td style="text-align: right"><strong> {{ number_format($total = $dataq->sum('nilai_transaksi'), 0) }}</td>
                                    </tr> --}}
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card widget-todo">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-flex">
                        <i class="bx bx-check font-medium-5 pl-25 pr-75"></i>Rincian Rekening (total nilai rekening sudah rekon)
                    </h4>

                </div>
                <div class="card-body px-0 py-1">
                    <div class="card">
                        <div class="card-body">

                            <table class="table table-hover">
                                @if($dataq->count() > 0 )
                                    @foreach ($dataq as $d)
                                        <tr>
                                            <td class="col-3">{{$d->rek_sro}}</td>
                                            <td class="col-6" style="text-align:right;">Rp.</td>
                                            <td class="col-3" style="text-align:right;">{{number_format($d->nilai_transaksi, 0)}},00</td>
                                        </tr>
                                    @endforeach
                                @endif   
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="tasks">
    <div class="row">
        <div class="col-lg-7">
            <div class="card widget-todo">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-flex">
                        Data Belum Rekon
                    </h4>
                    <a class="text-end btn btn-outline-danger btn-tone m-r-5 btn-xs ml-auto">
                        Rp. {{ number_format($total = $dataq1->sum('nilai_transaksi'), 0) }},00
                    </a>
                </div>
                
                <div class="card-body px-0 py-1 overflow-auto">
                    <div class="card">
                        <div class="card-body">
                            <table id="data-table" class="tabelbelumfix table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        {{-- <th></th> --}}
                                        <th>Nomor Bukti</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Uraian</th>
                                        <th>Nilai</th>
                                        {{-- <th></th> --}}
                                    </tr>
                                </thead>
                                @php $total = 0; @endphp
                                <tfoot>
                                    {{-- server side --}}
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card widget-todo">
                <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                    <h4 class="card-title d-flex">
                        <i class="bx bx-check font-medium-5 pl-25 pr-75"></i>Rincian Rekening (nilai ini harus nol)
                    </h4>

                </div>
                <div class="card-body px-0 py-1">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                @if($dataq1->count() > 0 )
                                    @foreach ($dataq1 as $d)
                                        <tr>
                                            <td class="col-3 text-left">{{$d->rekening2}}</td>
                                            <td class="col-6" style="text-align:right;">Rp.</td>
                                            <td class="col-3" style="text-align:right;">{{number_format($d->nilai_transaksi, 0)}},00</td>
                                        </tr>
                                    @endforeach
                                @endif   
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('Penatausahaan.Penerimaan.Rekon.Fungsi.Fungsi')

@endsection