@php
    // buat ID unik untuk setiap level agar tidak bentrok antar level accordion
    $accordionId = 'accordion-' . $prefix;
    $collapseId = 'collapse-' . $prefix;
    $headingId = 'heading-' . $prefix;
@endphp

<div class="accordion-item border-0 border-bottom">
    {{-- === HEADER ITEM === --}}
    <h2 class="accordion-header" id="{{ $headingId }}">
        <button 
            class="accordion-button collapsed bg-white py-2 px-0"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#{{ $collapseId }}"
            aria-expanded="false"
            aria-controls="{{ $collapseId }}"
            style="box-shadow:none;">

            <div class="row w-100 align-items-center gx-1">
                {{-- Kolom uraian --}}
                <div class="col-md-3 text-start" 
                     style="padding-left: {{ 10 + substr_count($prefix, '-') * 20 }}px;">
                    @if (!empty($item['sub']))
                        <strong class="text-primary">{{ $item['kategori'] }}</strong>
                    @else
                        <span class="text-secondary fw-normal rekening-item">
                            {{ $item['kategori'] }}
                        </span> 
                    @endif
                </div>

                {{-- Kolom angka --}}
                <div class="col-md-2 text-end text-nowrap">{{ number_format($item['anggaran'], 2) }}</div>
                <div class="col-md-2 text-end text-nowrap">{{ number_format($item['realisasi_bulan'], 2) }}</div>
                <div class="col-md-2 text-end text-nowrap">{{ number_format($item['total_realisasi'], 2) }}</div>
                <div class="col-md-2 text-end text-nowrap">{{ number_format($item['sisa'], 2) }}</div>
                <div class="col-md-1 text-end text-nowrap">
                    <span class="@if($item['persen'] >= 80) text-success 
                                 @elseif($item['persen'] >= 50) text-warning 
                                 @else text-danger @endif">
                        {{ number_format($item['persen'], 2) }} %
                    </span>
                </div>
            </div>
        </button>
    </h2>

    {{-- === BODY COLLAPSE (SUB LEVEL) === --}}
    <div 
        id="{{ $collapseId }}" 
        class="accordion-collapse collapse" 
        aria-labelledby="{{ $headingId }}"
        data-bs-parent="#{{ $accordionId }}">
        <div class="accordion-body py-0 px-0">
            @if (!empty($item['sub']))
                <div class="accordion" id="{{ $accordionId }}">
                    @foreach ($item['sub'] as $j => $sub)
                        @include('Penatausahaan.Penerimaan.Realisasi.component-laporan', [
                            'item' => $sub,
                            'prefix' => $prefix . '-' . $j
                        ])
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
