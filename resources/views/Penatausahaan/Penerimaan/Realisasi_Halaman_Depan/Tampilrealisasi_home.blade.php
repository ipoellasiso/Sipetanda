<!DOCTYPE html>
<html lang="en">
<head>
    @include('Template.Head')
    <style>
        .text-end { text-align: right; }
        .accordion-button:not(.collapsed) {
            background-color: #eef2ff;
            color: #0d6efd;
        }
        .accordion-item {
            border: 1px solid #ddd;
            margin-bottom: 4px;
            border-radius: 6px;
        }
    </style>
</head>

<body>
<div id="app">
    <div id="main-content">
        <div class="page-heading">
            <section class="section">

                <div class="card">
                    <div class="card-header text-center">
                        <h5 class="fw-bold text-uppercase mb-0">Pemerintah Kota Palu</h5>
                        <h4 class="fw-bold">Laporan Target dan Realisasi Pendapatan Daerah Kota Palu</h4>
                        <p>Periode Tahun {{ $tahun }}</p>
                    </div>

                    <div class="card-body">
                        {{-- =============== LEVEL 1 (4) =============== --}}
                        <div class="accordion" id="accordionPendapatan">

                            @foreach ($laporan as $ket4 => $grup4)
                                @php
                                    $kode4 = '4';
                                    $id4 = 'acc-' . Str::slug($ket4);
                                    $anggaran4 = collect($grup4)->flatten(3)->sum('anggaran');
                                    $realisasi4 = collect($grup4)->flatten(3)->sum('realisasi');
                                    $sisa4 = $anggaran4 - $realisasi4;
                                    $persen4 = $anggaran4 > 0 ? ($realisasi4 / $anggaran4 * 100) : 0;
                                @endphp

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading-{{ $id4 }}">
                                        <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $id4 }}">
                                            {{ $kode4 }} {{ getNamaRekening($kode4) }}
                                        </button>
                                    </h2>

                                    <div id="collapse-{{ $id4 }}" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <table class="table table-bordered mb-2">
                                                <tr>
                                                    <td class="fw-bold">Anggaran</td>
                                                    <td class="text-end">{{ number_format($anggaran4, 2) }}</td>
                                                    <td class="fw-bold">Realisasi</td>
                                                    <td class="text-end">{{ number_format($realisasi4, 2) }}</td>
                                                    <td class="fw-bold">Sisa</td>
                                                    <td class="text-end" style="color: {{ $sisa4 < 0 ? 'red' : 'green' }}">
                                                        {{ $sisa4 < 0 ? '(' . number_format(abs($sisa4), 2) . ')' : number_format($sisa4, 2) }}
                                                    </td>
                                                    <td class="text-end">{{ number_format($persen4, 2) }} %</td>
                                                </tr>
                                            </table>

                                            {{-- =============== LEVEL 2 (4.1, 4.2, 4.3) =============== --}}
                                            <div class="accordion" id="accordion-level2-{{ $id4 }}">
                                                @foreach ($grup4 as $ket1 => $grup1)
                                                    @php
                                                        $kode1 = match (true) {
                                                            Str::contains(strtolower($ket1), 'asli') => '4.1',
                                                            Str::contains(strtolower($ket1), 'transfer') => '4.2',
                                                            Str::contains(strtolower($ket1), 'lain') => '4.3',
                                                            default => '4.1',
                                                        };
                                                        $id1 = 'acc-' . Str::slug($ket1);
                                                        $anggaran1 = collect($grup1)->flatten(2)->sum('anggaran');
                                                        $realisasi1 = collect($grup1)->flatten(2)->sum('realisasi');
                                                        $sisa1 = $anggaran1 - $realisasi1;
                                                        $persen1 = $anggaran1 > 0 ? ($realisasi1 / $anggaran1 * 100) : 0;
                                                    @endphp

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="heading-{{ $id1 }}">
                                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $id1 }}">
                                                                {{ $kode1 }} {{ getNamaRekening($kode1) }}
                                                            </button>
                                                        </h2>

                                                        <div id="collapse-{{ $id1 }}" class="accordion-collapse collapse">
                                                            <div class="accordion-body">
                                                                <table class="table table-bordered mb-2">
                                                                    <tr>
                                                                        <td class="fw-bold">Anggaran</td>
                                                                        <td class="text-end">{{ number_format($anggaran1, 2) }}</td>
                                                                        <td class="fw-bold">Realisasi</td>
                                                                        <td class="text-end">{{ number_format($realisasi1, 2) }}</td>
                                                                        <td class="fw-bold">Sisa</td>
                                                                        <td class="text-end" style="color: {{ $sisa1 < 0 ? 'red' : 'green' }}">
                                                                            {{ $sisa1 < 0 ? '(' . number_format(abs($sisa1), 2) . ')' : number_format($sisa1, 2) }}
                                                                        </td>
                                                                        <td class="text-end">{{ number_format($persen1, 2) }} %</td>
                                                                    </tr>
                                                                </table>

                                                                {{-- =============== LEVEL 3 (4.1.01, 4.1.02, dst) =============== --}}
                                                                <div class="accordion" id="accordion-level3-{{ $id1 }}">
                                                                    @foreach ($grup1 as $ket2 => $grup2)
                                                                        @php
                                                                            $kode2 = match (true) {
                                                                                Str::contains(strtolower($ket2), 'pajak') => '4.1.01',
                                                                                Str::contains(strtolower($ket2), 'retribusi') => '4.1.02',
                                                                                Str::contains(strtolower($ket2), 'pengelolaan') => '4.1.03',
                                                                                Str::contains(strtolower($ket2), 'pad yang sah') => '4.1.04',
                                                                                default => '4.1.99',
                                                                            };
                                                                            $id2 = 'acc-' . Str::slug($ket2);
                                                                            $anggaran2 = collect($grup2)->flatten(1)->sum('anggaran');
                                                                            $realisasi2 = collect($grup2)->flatten(1)->sum('realisasi');
                                                                            $sisa2 = $anggaran2 - $realisasi2;
                                                                            $persen2 = $anggaran2 > 0 ? ($realisasi2 / $anggaran2 * 100) : 0;
                                                                        @endphp

                                                                        <div class="accordion-item">
                                                                            <h2 class="accordion-header" id="heading-{{ $id2 }}">
                                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-{{ $id2 }}">
                                                                                    {{ $kode2 }} {{ getNamaRekening($kode2) }}
                                                                                </button>
                                                                            </h2>

                                                                            <div id="collapse-{{ $id2 }}" class="accordion-collapse collapse">
                                                                                <div class="accordion-body">
                                                                                    <table class="table table-bordered mb-0">
                                                                                        @foreach ($grup2 as $row)
                                                                                            @php
                                                                                                $sisa = $row->anggaran - $row->realisasi;
                                                                                                $persen = $row->anggaran > 0 ? ($row->realisasi / $row->anggaran * 100) : 0;
                                                                                            @endphp
                                                                                            <tr>
                                                                                                <td>- {{ $row->rekening2 }}</td>
                                                                                                <td class="text-end">{{ number_format($row->anggaran, 2) }}</td>
                                                                                                <td class="text-end">{{ number_format($row->realisasi, 2) }}</td>
                                                                                                <td class="text-end" style="color: {{ $sisa < 0 ? 'red' : 'green' }}">
                                                                                                    {{ $sisa < 0 ? '(' . number_format(abs($sisa), 2) . ')' : number_format($sisa, 2) }}
                                                                                                </td>
                                                                                                <td class="text-end">{{ number_format($persen, 2) }} %</td>
                                                                                            </tr>
                                                                                        @endforeach
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div> {{-- end level 3 --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div> {{-- end level 2 --}}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div> {{-- end level 1 --}}
                    </div>
                </div>

            </section>
        </div>
    </div>
</div>

@include('Template.Script')
</body>
</html>
