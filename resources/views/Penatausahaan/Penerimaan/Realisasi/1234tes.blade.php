@extends('Template.Layout')
@section('content')

<style>
:root {
  --dot-size: 8px;           /* ukuran titik */
  --dot-gap: 6px;            /* jarak titik dan teks */
  --indent-base: 18px;       /* indent dasar level 0 */
  --font-main: "Segoe UI", "Open Sans", Arial, sans-serif;
}

/* === Struktur grid utama === */
.grid-row {
  display: grid;
  grid-template-columns: 45% 18% 18% 14% 5%;
  align-items: center;
  gap: 1px;
  border-bottom: 0.5px solid #e5e7eb;
  min-height: 32px;
  line-height: 1.4;
  padding: 4px 0;
  font-family: var(--font-main) !important;
}

/* === Header tabel === */
.grid-row.fw-semibold {
  align-items: center !important;
  min-height: 36px;
  font-weight: 600 !important;
  color: #475569;
  background-color: #fafbfc;
  border-bottom: 1px solid #e5e7eb;
}

/* Header 'Uraian' sejajar otomatis ke titik node */
.grid-row.fw-semibold > .cell:first-child {
  display: flex;
  align-items: center;
  padding-left: calc(var(--indent-base) + (var(--dot-size) / 2) + var(--dot-gap)) !important;
  text-align: left !important;
}

/* === Kolom Uraian === */
.cell-uraian {
  font-size: 14px;
  display: flex;
  align-items: center;
  gap: 18px;
  white-space: normal;
  word-wrap: break-word;
  padding-left: var(--indent);
  color: #1e293b;
}

/* === Kolom angka === */
.cell-number {
  font-size: 14px;
  font-family: var(--font-main) !important;
  text-align: center;
  white-space: nowrap;
  display: flex;
  justify-content: flex-end;
  padding-right: 33px !important; /* <--- tambahkan jarak kanan */
}

/* === Node Titik === */
.dot {
  width: var(--dot-size);
  height: var(--dot-size);
  border-radius: 50%;
  flex-shrink: 0;
  margin-top: 1px;
  transition: background-color 0.2s ease;
}

.bg-primary { background-color: #2563eb !important; }
.bg-secondary { background-color: #94a3b8 !important; }

/* === Warna teks === */
.text-primary { color: #1e3a8a !important; }
.text-secondary { color: #475569 !important; }
.text-success { color: #16a34a !important; }
.text-danger  { color: #dc2626 !important; }
.text-warning { color: #f59e0b !important; }

/* === Struktur tree === */
.tree-node {
  margin: 0;
  padding: 0;
  --indent: calc(var(--indent-base) * var(--level, 0));
}

/* Subtree tanpa border tambahan */
.tree-children {
  border-left: none !important;
  margin-left: 0 !important;
  padding-left: 0 !important;
}

/* Hover baris */
.node-header:hover {
  background-color: #f9fafc;
  transition: background 0.2s ease;
}

/* Rata vertikal titik dan teks */
.cell-uraian .dot {
  margin-top: 0px;
}

/* Kolom header juga ikut geser supaya sejajar */
.grid-row.fw-semibold .cell.text-end {
  padding-right: 43px !important;
}
</style>

<div class="card shadow-sm p-3">
    {{-- === Filter tanggal === --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary fw-bold"></h4>
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
        <div style="flex: 0 0 90px;">
            <img src="{{ asset('/app/assets/images/logo/13.png') }}" 
                alt="Logo Kota Palu" 
                width="70" 
                class="img-fluid">
        </div>

        <div style="flex: 1;">
            <h5 class="fw-bold mb-1 text-uppercase" style="color:#1d3557; letter-spacing: 0.5px;">
                PEMERINTAH KOTA PALU
            </h5>
            <h6 class="fw-bold mb-1" style="color:#1d3557;">
                LAPORAN TARGET DAN REALISASI PENDAPATAN DAERAH
            </h6>
            <h6 class="fw-semibold mb-1" style="color:#1d3557;">
                TAHUN ANGGARAN {{ date('Y') }}
            </h6>
            <h6 class="fw-semibold" style="color:#1d3557;">
                PERIODE {{ \Carbon\Carbon::parse($tgl_awal)->format('d M Y') }}
                s/d {{ \Carbon\Carbon::parse($tgl_akhir)->format('d M Y') }}
            </h6>
        </div>
    </div>

    <hr style="
        border: none;
        border-top: 3px solid #1d3557;
        width: 98%;
        margin: 6px auto 40px auto;
        opacity: 0.4;
        ">

    {{-- === HEADER TABEL === --}}
    <div class="grid-row fw-semibold border-bottom py-2" style="font-size:14px;">
        <div class="cell">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uraian</div>
        <div class="cell text-center">Anggaran</div>
        <div class="cell text-center">Total Realisasi (Akumulasi)</div>
        <div class="cell text-center">Sisa</div>
        <div class="cell text-center">%&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
    </div>

    {{-- === ISI DATA === --}}
    <div class="accordion" id="accordion-laporan">
        @foreach ($data as $i => $item)
            @include('Penatausahaan.Penerimaan.Realisasi.component-laporan', [
                'item' => $item,
                'prefix' => 'item-' . $i
            ])
        @endforeach
    </div>
</div>
@endsection
