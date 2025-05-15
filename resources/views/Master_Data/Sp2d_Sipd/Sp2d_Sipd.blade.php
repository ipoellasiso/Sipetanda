@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="col-md-9">
            </div>
            <div class="col-md-1">
                <a class="text-end btn btn-outline-primary btn-tone m-r-5 btn-xs ml-auto" href="javascript:void(0)" id="createOpd" data-toggle="tooltip" data-placement="top" title="">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </div>
        </div>

        <br><br>
        <div class="m-t-25 table-responsive">
            <table id="tabelopd1" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Nama Opd</th>
                        <th>Nomor Sp2d</th>
                        <th>Tanggal Sp2d</th>
                        <th>Keterangan</th>
                        <th>Nilai Sp2d</th>
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

@include('Master_Data.Sp2d_Sipd.Modal.Tambah')
@include('Master_Data.Sp2d_Sipd.Fungsi.Fungsi')
@endsection