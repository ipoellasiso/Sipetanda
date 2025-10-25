@extends('Template.Layout')
@section('content')

<style>
.text-nowrap {
    white-space: nowrap !important;
}
.accordion-body .text-secondary {
    line-height: 1.6;
    font-size: 14px;
    padding-left: 8px;
}
.accordion-body strong {
    font-weight: 600;
    color: #002060; /* biru tua profesional */
}
.rekening-item {
    font-style: normal;
    line-height: 1.6;
    white-space: normal;
    display: block;
    text-indent: -10px;
    margin-left: 15px;
}

.number-col {
    white-space: nowrap;
    padding-right: 10px;
    font-feature-settings: "tnum";
}

/* indent berjenjang untuk sub-level */
.indent-level-0 { padding-left: 0px; }
.indent-level-1 { padding-left: 18px; }   /* level: PAD / Transfer */
.indent-level-2 { padding-left: 36px; }   /* jenis: Pajak, Retribusi, DBH */
.indent-level-3 { padding-left: 54px; }   /* objek / rincian */

/* beri jarak vertikal antar baris leaf agar tidak rapat */
.component-leaf-row, .accordion-item .accordion-body .row {
    margin-bottom: 6px;
}

/* agar teks nama panjang wrap tapi tetap rapi pada kolom uraian */
.col-md-4 {
    word-break: break-word;
}

/* buat warna persen jelas */
.text-success { color: #2ecc71; }
.text-warning { color: #0fedf1; }
.text-danger  { color: #e74c3c; }

.card {
    border: none;
    border-radius: 12px;
    background-color: #f9fafb;
}

/* Header tabel */
.table-header {
    background-color: #f1f3f5;
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
    color: #333;
}

/* .text-nowrap { white-space: nowrap !important; } */
.text-right { text-align: right; }

.accordion-button {
    background-color: transparent;
    box-shadow: none !important;
}
.accordion-button:not(.collapsed) {
    color: #0d6efd;
    background-color: #f8f9fa;
}

/* Level padding indent */
.indent-0 { padding-left: 0px; }
.indent-1 { padding-left: 20px; }
.indent-2 { padding-left: 40px; }
.indent-3 { padding-left: 60px; }
.indent-4 { padding-left: 80px; }

/* Warna persen
.text-success { color: #1e1f1e !important; }
.text-warning { color: #1e1f1e !important; }
.text-danger  { color: #1e1f1e !important; } */

.percentage {
    font-weight: 600;
}

.text-success {
    color: #2ecc71 !important; /* hijau segar */
}
.text-danger {
    color: #e74c3c !important; /* merah tegas */
}

.bg-level-0 {
    background: linear-gradient(to right, #e3f2fd, #f8fbff) !important; /* biru lembut */
}
.bg-level-1 {
    background: linear-gradient(to right, #f1f8ff, #ffffff) !important;
}
.bg-level-2 {
    background: linear-gradient(to right, #fafcff, #ffffff) !important;
}
.bg-level-3 {
    background: linear-gradient(to right, #ffffff, #ffffff) !important;
}
.bg-level-4 {
    background-color: #ffffff !important;
}

/* 🧱 Pastikan warna tidak hilang saat di-collapse */
.accordion-item.bg-level-0,
.accordion-item.bg-level-1,
.accordion-item.bg-level-2,
.accordion-item.bg-level-3 {
    transition: background 0.4s ease;
    border-left: 4px solid transparent;
}

/* 🩵 Warna border kiri per level agar kontras dan elegan */
.bg-level-0 { border-left-color: #1565c0 !important; }  /* biru tua */
.bg-level-1 { border-left-color: #1e88e5 !important; }  /* biru terang */
.bg-level-2 { border-left-color: #64b5f6 !important; }  /* biru lembut */
.bg-level-3 { border-left-color: #bbdefb !important; }  /* sangat lembut */

/* 🧩 Pastikan tombol collapse mewarisi warna parent */
.accordion-button.bg-level-0,
.accordion-button.bg-level-1,
.accordion-button.bg-level-2,
.accordion-button.bg-level-3 {
    background-color: inherit !important;
    box-shadow: none !important;
    transition: all 0.3s ease;
}

/* Saat dibuka, tetap gunakan warna yang sama */
.accordion-button:not(.collapsed).bg-level-0,
.accordion-button:not(.collapsed).bg-level-1,
.accordion-button:not(.collapsed).bg-level-2,
.accordion-button:not(.collapsed).bg-level-3 {
    background-color: inherit !important;
    color: #0d47a1 !important;
}

/* Hover efek lembut */
.accordion-item:hover {
    filter: brightness(0.98);
}
</style>

<div class="card shadow-sm p-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary fw-bold"></h4>
        {{-- Filter Bulan --}}
        <form method="GET" class="d-flex align-items-center justify-content-end mb-2" style="gap: 10px;">
            <label class="fw-semibold mb-0">Periode:</label>
            <input type="date" name="tgl_awal" value="{{ $tgl_awal }}" class="form-control" style="width: 160px;">
            <span class="fw-bold">s/d</span>
            <input type="date" name="tgl_akhir" value="{{ $tgl_akhir }}" class="form-control" style="width: 160px;">
            <button type="submit" class="btn btn-primary btn-sm">
                <i class="bi bi-search"></i> Tampilkan
            </button>
        </form>
    </div>

    {{-- === HEADER LAPORAN === --}}
    <div class="d-flex align-items-center justify-content-center mb-4 text-center" style="gap: 20px;">
        {{-- Logo Kota Palu --}}
        <div style="flex: 0 0 90px;">
            <img src="{{ asset('/app/assets/images/logo/13.png') }}" 
                alt="Logo Kota Palu" 
                width="90" 
                class="img-fluid">
        </div>

        {{-- Teks Judul --}}
        <div style="flex: 1;">
            <h5 class="fw-bold mb-1 text-uppercase" style="color:#1d3557; letter-spacing: 0.5px;">
                PEMERINTAHAN KOTA PALU
            </h5>
            <h6 class="fw-bold mb-1" style="color:#1d3557;">
                LAPORAN TARGET DAN REALISASI PENDAPATAN DAERAH KOTA PALU
            </h6>
            <h6 class="fw-semibold mb-1" style="color:#1d3557;">
                TAHUN ANGGARAN {{ date('Y') }}
            </h6>
            <h6 class="fw-semibold" style="color:#1d3557;">
                PERIODE {{ \Carbon\Carbon::parse($tgl_awal)->format('d M Y') }}
                s/d
                {{ \Carbon\Carbon::parse($tgl_akhir)->format('d M Y') }}
            </h6>
        </div>
    </div>

    <hr style="border: 1px solid #1d3557; opacity: 0.3; margin-top: 10px; margin-bottom: 20px;">

    {{-- Header tabel --}}
    <div class="row text-center py-2 table-header">
        <div class="col-md-3 text-start">Uraian</div>
        <div class="col-md-2">Anggaran</div>
        <div class="col-md-2">Realisasi (Bulan Ini)</div>
        <div class="col-md-2">Total Realisasi (Akumulasi)</div>
        <div class="col-md-2">Sisa</div>
        <div class="col-md-1">%</div>
    </div>

    {{-- Isi laporan --}}
    <div class="accordion" id="accordion-laporan">
        @foreach ($data as $i => $item)
            @include('Penatausahaan.Penerimaan.Realisasi.component-laporan', ['item' => $item, 'prefix' => 'item'.$i])
        @endforeach
    </div>
</div>

@endsection
