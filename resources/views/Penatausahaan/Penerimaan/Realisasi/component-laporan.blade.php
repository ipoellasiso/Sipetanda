@php
    $accordionId = 'accordion-' . $prefix;
    $collapseId = 'collapse-' . $prefix;
    $headingId = 'heading-' . $prefix;

    // Hitung level berdasar jumlah tanda '-' di prefix
    $level = substr_count($prefix, '-');
    $bgClass = 'bg-level-' . min($level, 4); // maksimal level 4
@endphp

<div class="accordion-item border-0 border-bottom {{ $bgClass }}">
    
    <h2 class="accordion-header" id="{{ $headingId }}">
        <button 
            class="accordion-button collapsed py-2 px-0 {{ $bgClass }}"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#{{ $collapseId }}"
            aria-expanded="false"
            aria-controls="{{ $collapseId }}"
            style="box-shadow:none;">
            <div class="row w-100 align-items-center gx-1">
                {{-- === Kolom Uraian === --}}
                <div class="col-md-3 text-start indent-{{ $level }}">
                    @if (!empty($item['sub']))
                        <strong class="text-primary">{{ $item['kategori'] }}</strong>
                    @else
                        <span class="text-secondary fw-normal rekening-item">
                            {{ $item['kategori'] }}
                        </span>
                    @endif
                </div>

                {{-- === Anggaran === --}}
                <div class="col-md-2 text-end">{{ number_format($item['anggaran'], 2) }}</div>

                {{-- === Realisasi Bulan === --}}
                <div class="col-md-2 text-end">{{ number_format($item['realisasi_bulan'], 2) }}</div>

                {{-- === Total Realisasi === --}}
                <div class="col-md-2 text-end">{{ number_format($item['total_realisasi'], 2) }}</div>

                {{-- === Sisa (warna dinamis) === --}}
                @php
                    $sisa = $item['sisa'];
                    $isNegative = $sisa < 0;
                    $sisaFormatted = number_format(abs($sisa), 2);
                @endphp
                <div class="col-md-2 text-end fw-semibold {{ $isNegative ? 'text-danger' : 'text-success' }}">
                    {!! $isNegative ? '(' . $sisaFormatted . ')' : $sisaFormatted !!}
                </div>

                {{-- === Persentase === --}}
                <div class="col-md-1 text-end percentage">
                    <span class="@if($item['persen'] >= 80) text-success 
                                 @elseif($item['persen'] >= 50) text-warning 
                                 @else text-danger @endif">
                        {{ number_format($item['persen'], 2) }} %
                    </span>
                </div>
            </div>
        </button>
    </h2>

    {{-- === Sub Accordion === --}}
    <div id="{{ $collapseId }}" class="accordion-collapse collapse" 
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
