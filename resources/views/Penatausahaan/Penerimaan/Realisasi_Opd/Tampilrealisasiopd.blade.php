@extends('Template.Layout')
@section('content')

<div class="card">
    <div class="card-header">
        <div class="row col-md-12">
            <div class="col-2">
                <div class="avatar-image  m-h-10 m-r-25">
                    <img src="/app/assets/images/logo/13.png"  width="40%">
                </div>
            </div>
            <div class="col-8 text-center">
                <b><h5>PEMERINTAHAN KOTA PALU</b><br>
                <b><h5>LAPORAN REALISASI ANGGARAN PENDAPATAN DAERAH</b>
                @if ($datainduk)
                    <b><h5>{{strtoupper($datainduk->nama_opd)}} </h4></b>
                @else
                        <h5>DATA BELUM ADA</h5>
                @endif
                <b><h5>TAHUN ANGGARAN 2025</h6></b>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>

    <br><br><br>
    <div class="card-body">
        <div class="card-body px-0 py-1">
            <div class="card">
                <div class="card-body">
                    <style>
                        table {
                            border-collapse: collapse; /* Menggabungkan garis sel */
                            width: 100%;
                        }
                        table, th, td {
                            border: 1px solid black; /* Menambahkan garis pada tabel, header, dan sel */
                        }
                        th, td {
                            padding: 8px;
                            text-align: left;
                        }
                        th {
                            background-color: #ffffff;
                        }
                    </style>

                    <table class="table table-hover">

                            <tr>
                                <th style="text-align:center; word-wrap: break-word; overflow-wrap: break-word; background-color: #f7dfb2;">Kode Rekening</th>
                                <th style="text-align:center; word-wrap: break-word; overflow-wrap: break-word; background-color: #f7dfb2;">URAIAN</th>
                                <th style="text-align:center; background-color: #f7dfb2;" width="200px">ANGGARAN</th>
                                <th style="text-align:center; background-color: #f7dfb2;" width="200px">REALISASI</th>
                                <th style="text-align:center; background-color: #f7dfb2;" width="200px">SISA</th>
                                <th style="text-align:center; background-color: #f7dfb2;" width="60px">%</th>
                            </tr>

                        @if($dataq->count() > 0 )
                            @foreach ($dataq as $d)
                            @php
                                $sisa = $dataanggaran - $d->nilai_transaksi;
                                $persen = $dataanggaran > 0 ? ($d->nilai_transaksi / $dataanggaran) * 100 : 0;
                            @endphp
                                <tr>
                                    <td style="text-align:left;">{{$d->no_rek}}</td>
                                    <td><b>{{$d->rek}}</b></td>
                                    <td style="text-align:right;"><b>{{number_format($dataanggaran, 0)}},00</b></td>
                                    <td style="text-align:right;"><b>{{number_format($d->nilai_transaksi, 0)}},00</b></td>
                                    <td style="text-align:right;">{{ number_format($sisa, 2, ',', '.') }}</td>
                                    <td style="text-align:right;">{{ number_format($persen, 2) }}</td>
                                </tr>
                            
                        @foreach ($dataq2 as $d)
                            @if ($d->id_kelompok == '1')
                                @if($dataq2->count() > 0 )
                                
                                @php
                                    $sisa = $dataanggaran - $d->nilai_transaksi_kel;
                                    $persen = $dataanggaran > 0 ? ($d->nilai_transaksi_kel / $dataanggaran) * 100 : 0;
                                @endphp
                                    <tr>
                                        <td style="text-align:left;">{{$d->no_rek_kel}}</td>
                                        <td ><b>{{$d->rek_kel}}</b></td>
                                        <td style="text-align:right;"><b><b>{{number_format($dataanggaran, 0)}},00</b></td>
                                        <td style="text-align:right;"><b>{{number_format($d->nilai_transaksi_kel, 0)}},00</b></td>
                                    <td style="text-align:right;">{{ number_format($sisa, 2, ',', '.') }}</td>
                                        <td style="text-align:right;">{{ number_format($persen, 2) }}</td>
                                    </tr>

                            @foreach ($dataq3 as $d3)
                                @if ($d->id_kelompok == '1')
                                    @if($dataq3->count() > 0 )
                                    
                                    @php
                                        $sisa = $dataanggaran - $d3->nilai_transaksi_jen;
                                        $persen = $dataanggaran > 0 ? ($d3->nilai_transaksi_jen / $dataanggaran) * 100 : 0;
                                    @endphp
                                        <tr>
                                            <td style="text-align:left;">{{$d3->no_rek_jen}}</td>
                                            <td ><b>{{$d3->rek_jen}}</b></td>
                                            <td style="text-align:right;"><b><b>{{number_format($dataanggaran, 0)}},00</b></td>
                                            <td style="text-align:right;"><b>{{number_format($d3->nilai_transaksi_jen, 0)}},00</b></td>
                                        <td style="text-align:right;">{{ number_format($sisa, 2, ',', '.') }}</td>
                                            <td style="text-align:right;">{{ number_format($persen, 2) }}</td>
                                        </tr>

                                        @foreach ($dataq4 as $d4)
                                            @if ($d->id_kelompok == '1')
                                                @if ($d3->id_jenis == $d4->id_jenis)
                                                    @if($dataq4->count() > 0 )
                                                    
                                                    @php
                                                        $sisa = $dataanggaran - $d4->nilai_transaksi_o;
                                                        $persen = $dataanggaran > 0 ? ($d4->nilai_transaksi_o / $dataanggaran) * 100 : 0;
                                                    @endphp
                                                        <tr>
                                                            <td style="text-align:left;">{{$d4->no_rek_o}}</td>
                                                            <td ><b>{{$d4->rek_o}}</b></td>
                                                            <td style="text-align:right;"><b><b>{{number_format($dataanggaran, 0)}},00</b></td>
                                                            <td style="text-align:right;"><b>{{number_format($d4->nilai_transaksi_o, 0)}},00</b></td>
                                                        <td style="text-align:right;">{{ number_format($sisa, 2, ',', '.') }}</td>
                                                            <td style="text-align:right;">{{ number_format($persen, 2) }}</td>
                                                        </tr>

                                                        @foreach ($dataq5 as $d5)
                                                            @if ($d->id_kelompok == '1')
                                                                @if ($d3->id_jenis == $d4->id_jenis)
                                                                    @if ($d4->id_objek == $d5->id_objek)
                                                                        @if($dataq5->count() > 0 )
                                                                        
                                                                        @php
                                                                            $sisa = $dataanggaran - $d5->nilai_transaksi_ro;
                                                                            $persen = $dataanggaran > 0 ? ($d5->nilai_transaksi_ro / $dataanggaran) * 100 : 0;
                                                                        @endphp
                                                                            <tr>
                                                                                <td style="text-align:left;">{{$d5->no_rek_ro}}</td>
                                                                                <td >{{$d5->rek_ro}}</td>
                                                                                <td style="text-align:right;">{{number_format($dataanggaran, 0)}},00</td>
                                                                                <td style="text-align:right;">{{number_format($d5->nilai_transaksi_ro, 0)}},00</td>
                                                                                <td style="text-align:right;">{{ number_format($sisa, 2, ',', '.') }}</td>
                                                                                <td style="text-align:right;">{{ number_format($persen, 2) }}</td>
                                                                            </tr>

                                                                            @foreach ($dataq6 as $d6)
                                                                                @if ($d->id_kelompok == '1')
                                                                                    @if ($d3->id_jenis == $d4->id_jenis)
                                                                                        @if ($d4->id_objek == $d5->id_objek)
                                                                                            @if ($d5->id_rincianobjek == $d6->id_rincianobjek)
                                                                                                @if($dataq6->count() > 0 )
                                                                                                
                                                                                                @php
                                                                                                    $sisa = $dataanggaran - $d6->nilai_transaksi_sro;
                                                                                                    $persen = $dataanggaran > 0 ? ($d6->nilai_transaksi_sro / $dataanggaran) * 100 : 0;
                                                                                                @endphp
                                                                                                    <tr>
                                                                                                        <td style="text-align:left;">{{$d6->no_rek_sro}}</td>
                                                                                                        <td >{{$d6->rek_sro}}</td>
                                                                                                        <td style="text-align:right;">{{number_format($dataanggaran, 0)}},00</td>
                                                                                                        <td style="text-align:right;">{{number_format($d6->nilai_transaksi_sro, 0)}},00</td>
                                                                                                        <td style="text-align:right;">{{ number_format($sisa, 2, ',', '.') }}</td>
                                                                                                        <td style="text-align:right;">{{ number_format($persen, 2) }}</td>
                                                                                                    </tr>

                                                                                                    @endif
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    @endif
                                                                                @endforeach

                                                                            @endif
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                            @endforeach

                                                        @endif
                                                    @endif
                                                @endif
                                            @endforeach

                                        @endif
                                    @endif
                                @endforeach

                                @endif
                            @endif
                        @endforeach
                        
                    @endforeach
                    @endif
                        
                    </table>

                    <br><br>
                    @if ($datainduk)
                        <div class="row">
                            <div class="col-5 align-middle fw-bold text-center" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;">
                                Mengetahui,<br>
                                {{ strtoupper($datainduk->jabatan) }}<br>
                                {{ strtoupper($datainduk->nama_opd) }}<br><br><br><br><br><br>
                                {{ $datainduk->nama_kepala_opd }}<br>
                                NIP. {{ $datainduk->nip_kepala_opd }}
                            </div>
                            <div class="col-2">
                            </div>
                            <div class="col-5 align-middle fw-bold text-center" style=" margin-top: 15px; text-align: center; font-size: 17px; font-weight: bold;"><br>
                                Palu, {{ now()->format('d M Y') }}<br>
                                BENDAHARA PENERIMAAN<br><br><br><br><br><br>
                                {{ $datainduk->nama_bendahara }}<br>
                                NIP. {{ $datainduk->nip_bendahara }}
                            </div>
                        </div>
                    @else
                            <h5></h5>
                    @endif

                </div>
            </div>
        </div>

    </div>
</div>

@include('Penatausahaan.Penerimaan.Realisasi_Opd.Fungsi.Fungsi')
@endsection