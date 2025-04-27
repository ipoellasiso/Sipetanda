@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-body">
        <div class="row col-md-12">
            <div class="col-md-4">
                <div class="avatar-image  m-h-15 m-r-25">
                    <img src="/app/assets/images/logo/13.png"  width="18%">
                </div>
            </div>
            <div class="col-md-4 text-center">
                <b><h4>PEMERINTAHAN KOTA PALU</b><br>
                <b><h4>BUKU PEMBANTU PENERIMAAN</b>
                <b><h4>TAHUN ANGGARAN 2025</b>
                <!-- <b><h5>PERIODE</h6></b> -->
            </div>
            <div class="col-md-4">
            </div>
        </div>
        <br><br>

        <div class="m-t-25 table-responsive">
            <table id="data-table" class="tabelrekapan table table-hover table-bordered">
                <thead class="table-danger">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nomor Rekening</th>
                        <th class="text-center">Rekening</th>
                        <th class="text-center">Nomor Bukti</th>
                        <th class="text-center">Tanggal</th>
                        <th class="text-center">Uraian</th>
                        <th class="text-center">Opd</th>
                        <th class="text-center">Bank</th>
                        <th class="text-center">Jumlah</th>
                        <th class="text-center">Ket</th>
                        {{-- <th class="text-center" width="100px">Action</th> --}}
                    </tr>
                </thead>
            </table>
        </div>

    </div>
</div>

@include('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek.Fungsi.Fungsi')


@endsection