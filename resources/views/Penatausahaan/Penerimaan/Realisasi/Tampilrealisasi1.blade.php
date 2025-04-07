@extends('Template.Layout')
@section('content')

<style>
    .line-title{
        border: 0;
        border-style: inset;
        border-top: 1px solid #dee117;
    }

    .table-borderless td,
    .table-borderless th {
        border: 0;
    }
</style>

<div class="card">
    <div class="card-body">
        <br>
        <div class="row" border="0" align="center" style="width: 200%">
            <div class="col-1 text-center" align="center" style="width: 15%">
                <td colspan="0" style="width: 5%;"><center><img src="/theme/assets/images/13.png" width="100" height="100"></center></td>
            </div>
            <div class="col-4 align-middle fw-bold text-center" style="width: 20%; margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                <td colspan="6" style="width: 55%;">
                    <font style="font-size: 20pt;font-weight: bold;"><center>PEMERINTAH KOTA PALU</center></font>
                    <font style="font-size: 13pt;font-weight: bold;"><center>REKAPITULASI PAJAK REALISASI BELANJA</center></font>
                    {{-- <font style="font-size: 13pt;font-weight: bold;"><center>{{ $bulanrekap->nama_skpd }}</center></font> --}}
                    <font style="font-size: 13pt;font-weight: bold;"><center>TAHUN ANGGARAN 2025</center></font>
                    <!-- <font style="font-size: 11pt;font-weight:13"><center>Alamat : Jl. Baruga No. 2 No.Tlp : 0451-9384 Kode Pos : 94362</center></font> -->
                </td>
            </div>
            <div class="col-5">

            </div>
        </div>
        
        <div class="row">
            <div class="table-responsive">
                <table id="tbl2" class="table-bordered" border="0" cellpadding="10" align="center" cellspacing="20" style="width: 100%">
                    <br>
                    <tbody>
                        <tr>
                            <th>No</th>
                            <th class="text-center" style="width: 40%">Uraian</th>
                            <th class="text-center" style="width: 10%">Anggaran</th>
                            <th class="text-center" style="width: 10%">Realisasi</th>
                            <th class="text-center" style="width: 10%">Sisa</th>
                            <th class="text-center" style="width: 5%">%</th>
                        </tr>
                        <!-- @php $no=1; @endphp -->
                        <tr>
                            <td style="width: 2%">1</td>
                            <td class="text-center" style="width: 10%">
                                411211 <br>
                                411121 <br>
                                411122 <br>
                                411124 <br>
                                411128
                            </td>
                            <td class="text-center" style="width: 15%">
                                Pajak Pertambahan Nilai <br>
                                PPh 21 <br>
                                Pajak Penghasilan PS 22 <br>
                                Pajak Penghasilan PS 23 <br>
                                Pajak Penghasilan PS 24 <br>
                                Pajak Penghasilan PS 24
                            </td>
                            @php $total2 = 0; @endphp
                            <td class="text-right" style="width: 5%" align="right">
                                {{-- Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411211')->sum('nilai_pajak'), 0) }} <br> --}}
                                {{-- Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411121')->sum('nilai_pajak'), 0) }} <br> --}}
                                {{-- Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411122')->sum('nilai_pajak'), 0) }} <br> --}}
                                {{-- Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411124')->sum('nilai_pajak'), 0) }} <br> --}}
                                {{-- Rp. {{ number_format($total2 = $datapajaklsrekap->where('akun_pajak', '411128')->sum('nilai_pajak'), 0) }} --}}
                            </td>
                        </tr>

                        @php $total = 0; @endphp
                            <tr style="border: 10;" align="left">
                                <td colspan="3" align="right"><b>TOTAL</b></td>
                                {{-- <td align="right"> Rp. <b>{{ number_format($total = $datapajaklsrekap->sum('nilai_pajak'), 0) }}</b></td> --}}
                            </tr>
                </table>
            </div>

            <br><br><br>
            <div class="row" border="0" align="center" style="width: 150%">
                <div class="col-1">
                </div>
                <div class="col-4">
                    </td>
                </div>
                <div class="col-5" style="width: 15%;">
                    Palu, {{ now()->format('d M Y') }}<br>
                    <td><center><b>Kepala Bidang Penatausahaan dan Akuntansi</b></center></td><br><br><br><br>
                    <u><b>Maskur Salim, ST., MM</b></u><br>
                    <b>NIP.  -</b>
                </div>
            </div>
                
        </div>
        </div>
        
    </div>
</div>



@endsection