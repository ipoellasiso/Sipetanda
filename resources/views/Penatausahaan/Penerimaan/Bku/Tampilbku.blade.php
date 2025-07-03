@extends('Template.Layout')
@section('content')


{{-- <div class="card"> --}}

    <div class="tab-content m-t-15" id="myTabContentJustified">
        <div class="tab-pane fade show active" id="bku" role="tabpanel" aria-labelledby="home-tab-justified">
            <div class="card">
                <div class="card-body">

                    @if (session()->has('failures'))
                        <table class="table table-warning">
                            <tr>
                                <th>Baris</th>
                                <th>Nomor Buku Sudah Ada</th>
                                <th>Error</th>
                                <th>Value</th>
                            </tr>
                            @foreach (session()->get('failures') as $validasi)
                                <tr>
                                    <td>{{ $validasi->row() }}</td>
                                    <td>{{ $validasi->attribute() }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($validasi->errors() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $validasi->values()[$validasi->attribute()] }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <div class="col-md-7">
                        </div>
                        <div class="col-md-1">
                            <div class="btn-group dropdown me-1 mb-1">
                                <button type="button" class="btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto dropdown-toggle" id="dropdownMenuOffset"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    data-offset="5,20">
                                    <i class="fas fa-pencil-alt"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                                    <a class="dropdown-item" href="javascript:void(0)" id="createBku">Tambah Data</a>
                                    <a class="dropdown-item" id="createimportbku" href="#">Upload Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- class="m-t-25" --}}
                    <br><br>
                    <div class="m-t-25 table-responsive">
                        <table id="data-table" class="tabelbku table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th class="text-center" width="100px">Nomor Rekening</th>
                                    <th class="text-center" width="200px">Rekening</th>
                                    <th class="">Nomor Bukti</th>
                                    <th class="text-center">Tanggal</th>
                                    <th width="200px">Uraian</th>
                                    <th class="text-center">Opd</th>
                                    <th class="text-center">Bank</th>
                                    <th class="text-right" width="100px">Jumlah</th>
                                    {{-- <th class="text-center">Ket</th> --}}
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Januari</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jan) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0"> Rp. {{ number_format($total_jan_mandiri) }} </p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jan_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jan_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Februari</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_feb) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0"> Rp. {{ number_format($total_feb_mandiri) }} </p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_feb_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_feb_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Maret</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_mar) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_mar_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_mar_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_mar_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">April</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_apr) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_apr_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_apr_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_apr_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mei</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_mei) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_mei_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_mei_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_mei_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Juni</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jun) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jun_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jun_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jun_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Juli</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jul) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jul_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jul_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_jul_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Agustus</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_ags) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_ags_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_ags_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_ags_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">September</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_sep) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_sep_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_sep_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_sep_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Oktober</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_okt) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_okt_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_okt_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_okt_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">November</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_nov) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_nov_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_nov_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_nov_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Desember</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_des) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">Mandiri</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_des_mandiri) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BPD</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_des_bpd) }}</p>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <p class="m-b-0">BTN</p>
                                            <div id="total_pajak"></div>
                                    </div>
                                    <div>
                                        <p class="m-b-0">Rp. {{ number_format($total_des_btn) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

@include('Penatausahaan.Penerimaan.Bku.Modal.import')
@include('Penatausahaan.Penerimaan.Bku.Fungsi.Fungsi2')
@include('Penatausahaan.Penerimaan.Bku.Modal.Tambah')
@include('Penatausahaan.Penerimaan.Bku.Fungsi.Fungsi')


@endsection