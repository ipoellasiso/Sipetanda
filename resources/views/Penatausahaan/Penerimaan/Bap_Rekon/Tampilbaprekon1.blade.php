@extends('Template.Layout')
@section('content')

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 6px;
            text-align: left;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .bg-green { background: #28a745; color: #fff; padding: 2px 6px; border-radius: 4px; }
        .bg-red { background: #dc3545; color: #fff; padding: 2px 6px; border-radius: 4px; }

        body { font-family: "Times New Roman", serif; font-size: 12pt; line-height: 1.5; }
        .center { text-align: center; }
        .justify { text-align: justify; }
        .table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        .table, .table th, .table td { border: 1px solid #000; }
        .table th, .table td { padding: 6px; }
        .ttd { margin-top: 50px; width: 100%; }
        .ttd td { text-align: center; vertical-align: top; }

    </style>

    <div class="card">
        <div class="card-body">

            <h2 class="text-center">BERITA ACARA REKONSILIASI</h2>
            <h3 class="text-center">{{ strtoupper($rekon->nama_opd ?? '') }}</h3>
            <p class="text-center">
                Tanggal: {{ \Carbon\Carbon::parse($rekon->tanggal)->format('d-m-Y') }}
            </p>

            {{-- 🔎 Filter bulan & tahun --}}
            <form method="GET" action="{{ route('baprekon.index') }}" class="mb-3">
                <div class="row">
                    <div class="col-md-2">
                        <select name="bulan" class="form-control">
                            @for($i=1; $i<=12; $i++)
                                <option value="{{ $i }}" {{ $i == $bulan ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="tahun" class="form-control">
                            @for($t=date('Y')-2; $t<=date('Y')+1; $t++)
                                <option value="{{ $t }}" {{ $t == $tahun ? 'selected' : '' }}>
                                    {{ $t }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <table class="table-striped text-center">
                <thead class="">
                    <tr>
                        <th class="text-center" style="text-align:center;" width="60px">No</th>
                        {{-- <th>No Rekening</th> --}}
                        <th style="text-align:center;">Uraian</th>
                        <th class="text-right" style="text-align:center;" width="180px">Realisasi Sebelumnya</th>
                        <th class="text-right" style="text-align:center;" width="180px">Realisasi Bulan Ini</th>
                        {{-- <th class="text-right">Trx Sebelumnya</th> --}}
                        {{-- <th class="text-right">Trx Bulan Ini</th> --}}
                        <th class="text-right" style="text-align:center;" width="180px">Total Realisasi</th>
                        <th class="text-right" style="text-align:center;" width="180px">Total Trx</th>
                        <th class="text-right" style="text-align:center;" width="180px">Selisih</th>
                        <th class="text-center" style="text-align:center;" width="100px">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rekonDetails as $i => $row)
                    <tr>
                        <td class="text-center">{{ $i+1 }}</td>
                        {{-- <td>{{ $row->no_rekening }}</td> --}}
                        <td>{{ $row->rekening2 }}</td>
                        <td class="text-right">{{ number_format($row->bku_sebelumnya, 0, ',', '.') }}</td>
                        <td class="text-right">{{ number_format($row->bku_bulan_ini, 0, ',', '.') }}</td>
                        {{-- <td class="text-right">{{ number_format($row->trx_sebelumnya, 0, ',', '.') }}</td> --}}
                        {{-- <td class="text-right">{{ number_format($row->trx_bulan_ini, 0, ',', '.') }}</td> --}}
                        <td class="text-right"><strong>{{ number_format($row->total_bku, 0, ',', '.') }}</strong></td>
                        <td class="text-right"><strong>{{ number_format($row->total_trx, 0, ',', '.') }}</strong></td>
                        <td class="text-right">
                            <strong>{{ number_format($row->selisih, 0, ',', '.') }}</strong>
                        </td>
                        <td class="text-center">
                            @if($row->status_rekon == 'Sama')
                                <span class="bg-green">Sama</span>
                            @else
                                <span class="bg-red">Tidak Sama</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection