@extends('Template.Layout')
@section('content')

<section class="row">
    <div class="col-12 col-lg-12">
            @php
                $colors = ['purple','blue','green','red','orange','teal'];
                $icons = ['iconly-boldShow','iconly-boldProfile','iconly-boldBookmark','iconly-boldWork','iconly-boldCategory','iconly-boldStar'];
            @endphp

            <div class="row">
                @foreach($cardRealisasi as $index => $item)
                @php
                    $color = $colors[$index % count($colors)];
                    $icon = $icons[$index % count($icons)];
                @endphp

                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <div class="stats-icon {{ $color }}">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="text-muted small mb-1">{{ $item->nama }}</h6>
                                <h5 class="fw-bold mb-0">Rp {{ number_format($item->total, 0, ',', '.') }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <br><br>
            <div class="row">
                <div class="col-12 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Anggaran vs Realisasi</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="realisasiChart" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </div>
</section>

@endsection