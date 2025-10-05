@extends('Template.Layout')
@section('content')

{{-- <div class="card"> --}}
    {{-- <div class="card-body"> --}}
        {{-- <div class="tab-content m-t-15" id="myTabContentJustified"> --}}
            {{-- <div class="tab-pane fade show active" id="bku" role="tabpanel" aria-labelledby="home-tab-justified"> --}}
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content m-t-15" id="myTabContentJustified">
                             {{-- <div class="tab-pane fade show active" id="bku" role="tabpanel" aria-labelledby="home-tab-justified"> --}}

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
                                    <div class="col-md-4 text-start">
                                        <h4 class="card-title">{{ $title }}</h4>
                                    </div>
                                    <div class="col-md-7">
                                    </div>
                                    <div class="col-md-1">
                                        </div>
                                    </div>
                                </div>

                                <br>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label>OPD</label>
                                        <select class="form-select" name="id_opd" id="id_opdopd" style="width: 100%" required>
                                            <option></option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label>Rekening</label>
                                        <select class="form-select" name="id_rekening" id="id_rekeningopd" style="width: 100%" required>
                                            <option></option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="tanggal-awal">Tanggal Awal</label>
                                        <input type="date" id="tanggal-awal" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <label for="tanggal-akhir">Tanggal Akhir</label>
                                        <input type="date" id="tanggal-akhir" class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <button id="btn-filter" class="btn btn-primary">Terapkan</button>
                                    <button id="btn-reset" class="btn btn-secondary">Reset</button>
                                </div>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="m-t-25 table-responsive">
                            <table id="data-table" class="tabelposting table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>
                                            <input type="checkbox" id="select-all"> <!-- Pilih semua -->
                                        </th>
                                        <th class="text-center" width="100px">Nomor Rekening</th>
                                        <th class="text-center" width="200px">Rekening</th>
                                        <th class="">Nomor Bukti</th>
                                        <th class="text-center">Tanggal</th>
                                        <th width="200px">Uraian</th>
                                        <th class="text-center">Opd</th>
                                        <th class="text-center">Bank</th>
                                        <th class="text-right" width="100px">Jumlah</th>
                                    </tr>
                                </thead>
                            </table>
                            <button id="btn-update" class="btn btn-primary mt-3">Posting Terpilih</button>
                        </div>
                        </div>
                        
                    </div>
                </div>
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </div> --}}
{{-- </div> --}}

@include('Penatausahaan.Penerimaan.Posting.Fungsi.Fungsi')
@include('Penatausahaan.Penerimaan.Posting.Modal.Tambah')

@endsection