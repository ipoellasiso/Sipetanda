@php
use Carbon\Carbon;

// === Fungsi tampil data tanpa subtotal ===
function renderRows($items, $level = 0)
{
    $totalAnggaran = 0;
    $totalRealisasi = 0;
    $totalSisa = 0;

    foreach ($items as $item) {
        $hasChild = !empty($item['sub']);
        $indent = str_repeat(' ', $level); // indentasi visual

        // Warna dan gaya per level
        $background = match ($level) {
            0 => '#dbeafe', // level utama
            1 => '#eef3ff', // sub kategori
            2 => '#ffffff', // anak
            default => '#ffffff',
        };
        $fontWeight = $hasChild ? 'bold' : 'normal';
        $fontSize = $level <= 1 ? '13px' : '12px';
        $color = $item['sisa'] < 0 ? 'red' : '#000000';

        // Format angka
        $anggaran = number_format($item['anggaran'], 2, ',', '.');
        $realisasi = number_format($item['total_realisasi'], 2, ',', '.');
        $sisa = number_format($item['sisa'], 2, ',', '.');
        $persen = number_format($item['persen'], 2, ',', '.');

        echo "
        <tr style='background:{$background}; color:{$color}; font-size:{$fontSize};'>
            <td style='border:1px solid #cbd5e1; padding:5px 8px; font-weight:{$fontWeight};'>{$indent}{$item['kategori']}</td>
            <td style='border:1px solid #cbd5e1; text-align:right; padding:5px 8px;'>{$anggaran}</td>
            <td style='border:1px solid #cbd5e1; text-align:right; padding:5px 8px;'>{$realisasi}</td>
            <td style='border:1px solid #cbd5e1; text-align:right; padding:5px 8px;'>{$sisa}</td>
            <td style='border:1px solid #cbd5e1; text-align:center; padding:5px 8px;'>{$persen}%</td>
        </tr>";

        // Hitung total keseluruhan
        $totalAnggaran += $item['anggaran'];
        $totalRealisasi += $item['total_realisasi'];
        $totalSisa += $item['sisa'];

        // Jika ada anak, render rekursif
        if ($hasChild) {
            [$childAng, $childReal, $childSisa] = renderRows($item['sub'], $level + 1);
            $totalAnggaran += $childAng;
            $totalRealisasi += $childReal;
            $totalSisa += $childSisa;
        }
    }

    return [$totalAnggaran, $totalRealisasi, $totalSisa];
}
@endphp

{{-- ============ HEADER ============ --}}
<table style="width:100%; border-collapse:collapse; margin-bottom:15px; font-family:Arial, sans-serif;">
    <tr>
        <td style="width:15%; text-align:center; vertical-align:top;">
            <img src="{{ public_path('app/assets/images/logo/13.png') }}" width="90" alt="logo">
        </td>
        <td style="text-align:center; line-height:1.3;">
            <h3 style="margin:0; color:#1e3a8a;">PEMERINTAH KOTA PALU</h3>
            <h4 style="margin:2px 0;">LAPORAN TARGET DAN REALISASI PENDAPATAN DAERAH</h4>
            <h5 style="margin:2px 0;">TAHUN ANGGARAN {{ date('Y') }}</h5>
            <h6 style="margin:2px 0; font-weight:normal;">
                PERIODE {{ Carbon::parse($tgl_awal)->format('d M Y') }} s/d {{ Carbon::parse($tgl_akhir)->format('d M Y') }}
            </h6>
        </td>
        <td style="width:15%;"></td>
    </tr>
</table>

{{-- ============ TABEL UTAMA ============ --}}
<table style="width:100%; border-collapse:collapse; font-family:Arial, sans-serif; font-size:12px;">
    <thead>
        <tr style="background:#1e3a8a; color:white; text-align:center;">
            <th style="width:42%; border:1px solid #cbd5e1; padding:8px;">Uraian</th>
            <th style="width:18%; border:1px solid #cbd5e1; padding:8px;">Anggaran</th>
            <th style="width:18%; border:1px solid #cbd5e1; padding:8px;">Realisasi</th>
            <th style="width:17%; border:1px solid #cbd5e1; padding:8px;">Sisa</th>
            <th style="width:5%; border:1px solid #cbd5e1; padding:8px;">%</th>
        </tr>
    </thead>
    <tbody>
        @php
            [$totalAnggaran, $totalRealisasi, $totalSisa] = renderRows($data);
        @endphp

        {{-- Baris TOTAL AKHIR --}}
        @php
            $totalPersen = $totalAnggaran > 0 ? ($totalRealisasi / $totalAnggaran * 100) : 0;
        @endphp
        <tr style="background:#0f172a; color:white; font-weight:bold;">
            <td style="border-top:3px double #000; padding:6px 8px;">TOTAL AKHIR PENDAPATAN DAERAH</td>
            <td style="border-top:3px double #000; text-align:right; padding:6px 8px;">{{ number_format($totalAnggaran, 2, ',', '.') }}</td>
            <td style="border-top:3px double #000; text-align:right; padding:6px 8px;">{{ number_format($totalRealisasi, 2, ',', '.') }}</td>
            <td style="border-top:3px double #000; text-align:right; padding:6px 8px;">{{ number_format($totalSisa, 2, ',', '.') }}</td>
            <td style="border-top:3px double #000; text-align:center; padding:6px 8px;">{{ number_format($totalPersen, 2, ',', '.') }}%</td>
        </tr>
    </tbody>
</table>

{{-- ============ FOOTER ============ --}}
<br><br>
<table style="width:100%; font-size:11px;">
    <tr>
        <td style="text-align:left; color:#475569;">
            Dicetak oleh: <strong>{{ Auth::user()->fullname ?? 'SIPETANDA' }}</strong><br>
            Waktu Cetak: {{ now()->format('d M Y H:i') }}
        </td>
    </tr>
</table>
