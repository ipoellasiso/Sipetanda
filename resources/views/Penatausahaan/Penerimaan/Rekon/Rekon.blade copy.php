@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                {{-- <a class="text-end btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createBank" data-toggle="tooltip" data-placement="top" title="">
                    <i class="fas fa-pencil-alt"></i>
                </a> --}}
                <a class="text-end btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto">
                    Rp. {{ number_format($total = $dataq->sum('nilai_transaksi'), 0) }},00
                </a>
            </div>
        </div>

        <br><br>
        <div class="m-t-25">
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

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <h4 class="card-title">Data Tidak Ditemukan</h4>
            </div>
            <div class="col-md-2">
            </div>
            <div class="col-md-2">
                {{-- <a class="text-end btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createBank" data-toggle="tooltip" data-placement="top" title="">
                    <i class="fas fa-pencil-alt"></i>
                </a> --}}
                <a class="text-end btn btn-outline-danger btn-tone m-r-5 btn-xs ml-auto">
                    Rp. {{ number_format($total = $dataq1->sum('nilai_transaksi'), 0) }},00
                </a>
            </div>
        </div>

        <br><br>
        <div class="m-t-25">
            <table id="data-table" class="tabelbelumfix table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        {{-- <th></th> --}}
                        <th>Nomor Bukti</th>
                        <th>Tanggal Transaksi</th>
                        <th>Uraian</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                @php $total = 0; @endphp
                <tfoot>
                    {{-- <tr>
                        <th colspan="7" style="text-align: right">Total</th>
                        <td style="text-align: right"><strong> {{ number_format($total = $dataq->sum('nilai_transaksi'), 0) }}</td>
                    </tr> --}}
                </tfoot>
            </table>
        </div>
    </div>
</div>

@include('Penatausahaan.Penerimaan.Rekon.Fungsi.Fungsi')

@endsection