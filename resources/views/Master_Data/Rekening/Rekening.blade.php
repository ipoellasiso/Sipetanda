@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        {{-- <div class="d-flex flex-row"> --}}
            {{-- <h4 class="card-title">{{ $title }}</h4> --}}
            {{-- <a class="btn btn-secondary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createRekening" data-toggle="tooltip" data-placement="top" title="Tambah Data">
                <i class="fas fa-pencil-alt"></i>
            </a> --}}
        {{-- </div> --}}

        <div class="row">
            <div class="col-md-2">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="col-md-9">
            </div>
            <div class="col-md-1 text-right">
                <div class="btn-group dropdown me-1 mb-1">
                    <button type="button" class="btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto dropdown-toggle" id="dropdownMenuOffset"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        data-offset="5,20">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset">
                        <a class="dropdown-item" href="javascript:void(0)" id="createRekening">Tambah Data</a>
                        <a class="dropdown-item" id="createimport" href="#">Upload Data</a>
                    </div>
                </div>
            </div>
        </div>

        <br><br><br>
        {{-- @if (isset($errors) && $errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    {{ $error }}                    
                @endforeach
            </div>
        @endif --}}
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

        <div class="m-t-25">
            <table id="data-table" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Rekening</th>
                        <th>Rekening</th>
                        <th class="text-center" width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- datatable ajax --}}
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('Master_Data.Rekening.Modal.Tambah')
@include('Master_Data.Rekening.Modal.import')
@include('Master_Data.Rekening.Fungsi.Fungsi')
@endsection