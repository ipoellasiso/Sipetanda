@php
    $level = substr_count($prefix, '-') + 1;
    $indentClass = 'indent-level-' . ($level - 1);
@endphp

<div class="row w-100 py-1">
    <div class="col-md-4 {{ $indentClass }}">
        {!! $level > 2 ? '&nbsp;&nbsp;&nbsp;&nbsp; - ' : '' !!} <em>{{ $item['kategori'] }}</em>
    </div>
    <div class="col-md-2 text-end text-nowrap">{{ number_format($item['anggaran'] ?? 0, 2) }}</div>
    <div class="col-md-2 text-end text-nowrap">{{ number_format($item['realisasi_bulan'] ?? 0, 2) }}</div>
    <div class="col-md-2 text-end text-nowrap">{{ number_format($item['total_realisasi'] ?? 0, 2) }}</div>
    <div class="col-md-1 text-end text-nowrap">{{ number_format($item['sisa'] ?? 0, 2) }}</div>
    <div class="col-md-1 text-end">
        <span class="@if(round($item['persen'] ?? 0,2) >= 80) text-success @elseif(round($item['persen'] ?? 0,2) >= 50) text-warning @else text-danger @endif">
            {{ number_format($item['persen'] ?? 0, 2) }} %
        </span>
    </div>
</div>
