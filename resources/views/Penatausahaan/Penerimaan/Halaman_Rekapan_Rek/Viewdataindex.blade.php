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
    <table id="table2" class="tabelrekapan table table-hover table-bordered datatable-minimal">
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
        <tbody>
            @php $total = 0; @endphp
            @php $no = 1; @endphp
            @foreach ($datarealisasi as $d )
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $d->no_rekening }}</td>
                    <td>{{ $d->rekening2 }}</td>
                    <td>{{ $d->no_buku }}</td>
                    <td>{{ $d->tgl_transaksi }}</td>
                    <td>{{ $d->uraian }}</td>
                    <td>{{ $d->nama_opd }}</td>
                    <td>{{ $d->nama_bank }}</td>
                    <td style="text-align:right">{{ number_format($d->nilai_transaksi) }}</td>
                    <!-- <td>{{ $d->ket }}</td> -->
                </tr>
                
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8" style="text-align: right">Total Penerimaan</th>
                <td style="text-align: right"><strong> {{ number_format($total = $datarealisasi->sum('nilai_transaksi'), 0) }}</td>
            </tr>
        </tfoot>
    </table>
</div>

{{-- @include('Penatausahaan.Penerimaan.Halaman_Rekapan_Rek.Fungsi.Fungsi') --}}