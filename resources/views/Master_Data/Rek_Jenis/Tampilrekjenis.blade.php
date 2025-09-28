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
                                <th>Nomor Rekening Sudah Ada</th>
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
                                    <a class="dropdown-item" href="javascript:void(0)" id="createRekjenis">Tambah Data</a>
                                    <a class="dropdown-item" id="createimportrekjenis" href="#">Upload Data</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- class="m-t-25" --}}
                    <br><br>
                    <div class="m-t-25 table-responsive">
                        <table id="data-table" class="tabelrekjenis table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center" width="10px">No</th>
                                    <th class="text-center" width="100px">Id Akun</th>
                                    <th class="text-center" width="100px">Id Kelompok</th>
                                    <th class="text-center" width="100px">Nomor Rekening</th>
                                    <th class="text-center" width="300px">Rekening</th>
                                    <th width="100px">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

@include('Master_Data.Rek_Jenis.Modal.import')
@include('Master_Data.Rek_Jenis.Fungsi.Fungsi')
@include('Master_Data.Rek_Jenis.Modal.Tambah')

@endsection