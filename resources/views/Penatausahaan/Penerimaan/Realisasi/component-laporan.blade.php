@php
    // hitung level berdasarkan prefix
    $level = substr_count($prefix, '-');
@endphp

<div 
    x-data="{ open: true }" 
    class="tree-node" 
    style="--level: {{ $level }};"
>
    <div class="node-header" @click="open = !open">
        <div 
            class="grid-row"
            style="--indent: calc(var(--indent-base) * {{ $level }});"
        >
            {{-- === Kolom Uraian === --}}
            <div class="cell cell-uraian">
                {{-- Titik node --}}
                <span 
                    class="dot" 
                    :class="open ? 'bg-primary' : 'bg-secondary'"
                ></span>

                {{-- Teks kategori --}}
                @if (!empty($item['sub']))
                    <strong class="text-primary">{{ $item['kategori'] }}</strong>
                @else
                    <span class="text-secondary">{{ ltrim($item['kategori'], '- ') }}</span>
                @endif
            </div>

            {{-- === Kolom Anggaran === --}}
            <div class="cell cell-number">
                {{ number_format($item['anggaran'], 2) }}
            </div>

            {{-- === Kolom Realisasi === --}}
            <div class="cell cell-number">
                {{ number_format($item['total_realisasi'], 2) }}
            </div>

            {{-- === Kolom Sisa === --}}
            @php
                $sisa = $item['sisa'];
                $isNegative = $sisa < 0;
                $sisaFormatted = number_format(abs($sisa), 2);
            @endphp
            <div 
                class="cell cell-number fw-semibold {{ $isNegative ? 'text-danger' : 'text-success' }}"
            >
                {!! $isNegative ? '(' . $sisaFormatted . ')' : $sisaFormatted !!}
            </div>

            {{-- === Kolom Persentase === --}}
            <div class="cell cell-number">
                <span 
                    class="@if($item['persen'] >= 80) text-success 
                             @elseif($item['persen'] >= 50) text-warning 
                             @else text-danger @endif"
                >
                    {{ number_format($item['persen'], 2) }} %
                </span>
            </div>
        </div>
    </div>

    {{-- === Sub (Recursive) === --}}
    @if (!empty($item['sub']))
        <div class="tree-children" x-show="open" x-collapse>
            @foreach ($item['sub'] as $j => $sub)
                @include('Penatausahaan.Penerimaan.Realisasi.component-laporan', [
                    'item' => $sub,
                    'prefix' => $prefix . '-' . $j
                ])
            @endforeach
        </div>
    @endif
</div>
