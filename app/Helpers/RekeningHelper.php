<?php

use Illuminate\Support\Str;

if (!function_exists('getNamaRekening')) {
    /**
     * Ambil nama rekening berdasarkan kode manual.
     * Bisa dipakai di view atau controller.
     */
    function getNamaRekening($kode)
    {
        $data = [
            // Level utama
            '4'        => 'Pendapatan Daerah',

            // Sub-level
            '4.1'      => 'Pendapatan Asli Daerah (PAD)',
            '4.2'      => 'Pendapatan Transfer',
            '4.3'      => 'Lain-lain Pendapatan Daerah yang Sah',

            // Sub-sub-level (PAD)
            '4.1.01'   => 'Pajak Daerah',
            '4.1.02'   => 'Retribusi Daerah',
            '4.1.03'   => 'Hasil Pengelolaan Kekayaan Daerah yang Dipisahkan',
            '4.1.04'   => 'Lain-lain PAD yang Sah',

            // Tambahan jika mau buat untuk transfer
            '4.2.01'   => 'Pendapatan Transfer Pemerintah Pusat',
            '4.2.02'   => 'Pendapatan Transfer Antar Daerah',

            // Tambahan lain
            '4.3.01'   => 'Pendapatan Hibah',
            '4.3.02'   => 'Dana Darurat',
        ];

        return $data[$kode] ?? $kode; // jika tidak ditemukan, tampilkan kode-nya saja
    }
}
