@extends('Template.Layout')
@section('content')


{{-- <div class="card"> --}}

    <div class="tab-content m-t-15" id="myTabContentJustified">
        <div class="tab-pane fade show active" id="pajakls" role="tabpanel" aria-labelledby="home-tab-justified">
            
            <div class="card">
                <div class="card-body">

                    @if (session()->has('failures'))
                        <table class="table table-warning">
                            <tr>
                                <th>Baris</th>
                                <th>Rekening Sudah Ada</th>
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
                            <a class="text-end btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createimportanggaran" data-toggle="tooltip" data-placement="top" title="Upload">
                                <i class="bi bi-upload"></i>
                            </a>
                        </div>
                    </div>
                    {{-- class="m-t-25" --}}
                    <br><br>
                    <div class="m-t-25 table-responsive"> 
                        <table id="data-table" class="tabelanggaran table table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th class="text-center">No</th>
                                    <th>Nomor Rekening</th>
                                    <th>Rekening</th>
                                    <th>Opd</th>
                                    <th>Nilai</th>
                                    {{-- <th class="text-center" width="100px">Action</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- </div> --}}

@include('Master_Data.Anggaran.Modal.import')
@include('Master_Data.Anggaran.Fungsi.Fungsi')


@endsection