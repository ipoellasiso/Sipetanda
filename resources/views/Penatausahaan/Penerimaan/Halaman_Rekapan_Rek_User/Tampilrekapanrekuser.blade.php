@extends('Template.Layout')
@section('content')


            <div class="row">
                <div class="col-4">
                    <div class="avatar-image  m-h-15 m-r-25">
                        <img src="/app/assets/images/logo/13.png"  width="13%">
                    </div>
                </div>
                <div class="col-4 text-center">
                    <b><h3>PEMERINTAHAN KOTA PALU</b><br>
                    <b><h3>BUKU PEMBANTU PENERIMAAN</b>
                    <b><h3>TAHUN ANGGARAN 2025</b>
                    <!-- <b><h5>PERIODE</h6></b> -->
                </div>
                <div class="col-4">
                </div>
            </div>
            <br><br>

    <!-- <div class="card"> -->
        <div class="m-t-25 table-responsive">
            <table id="data-table" class="tabelrekapanuser table table-hover table-active table-bordered">
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
                        <!-- <th class="text-center">Ket</th> -->
                        {{-- <th class="text-center" width="100px">Action</th> --}}
                    </tr>
                </thead>
            </table>
        </div>
    <!-- </div> -->

    @include('Penatausahaan.Halaman_Rekapan_Rek_User.Fungsi.Fungsi')


@endsection