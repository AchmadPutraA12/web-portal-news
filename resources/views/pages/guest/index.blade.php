@extends('layouts.guest')

@section('css')
    <style>
        .hover-grow {
            transition: all 0.3s ease;
        }

        .hover-grow:hover {
            transform: scale(1.05);
        }

        .text-truncate-custom {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            max-width: 100%;
        }

        img.img-fluid {
            object-fit: cover;
        }

        .trending-ellipsis {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="container py-5">
        <!-- BERITA UTAMA + SEARCH -->
        <div class="row mb-4">
            <div class="col-12">
                <span class="text-orange fw-bold d-block mb-1">BERITA UTAMA</span>

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <!-- Judul -->
                    <h2 class="fw-bold text-dark hover-grow text-truncate-custom flex-grow-1 m-0">
                        Wamentan Sudaryono: Inovasi dan Kreativitas Kunci Sukses Pembangunan Pertanian
                    </h2>

                    <!-- Search -->
                    <form action="#" method="GET" class="d-flex overflow-hidden rounded shadow-sm"
                        style="min-width: 280px; height: 42px;">
                        <input type="text" class="form-control border-0" placeholder="Cari Berita..." name="q">
                        <button class="btn btn-dark" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <p class="text-muted small mt-2">01 Jan 2025 oleh <strong>alex</strong></p>
                <p class="text-muted">
                    Wakil Menteri Pertanian (Wamentan), Sudaryono, mengajak seluruh jajaran Kementerian Pertanian (Kementan)
                    untuk lebih kreatif dan inovatif...
                </p>
                <a href="#" class="text-primary text-decoration-none fw-bold">SELENGKAPNYA</a>
            </div>
        </div>

        <!-- GAMBAR + TRENDING (1 baris) -->
        <div class="row g-4 align-items-start">
            <!-- Gambar -->
            <div class="col-md-6 text-center">
                <img src="https://www.researchgate.net/publication/354245899/figure/fig1/AS:1062879461666816@1630421619887/Gambar-5-Gambar-Sketsa-Terpilih-Produk-1-Sumber-Penulis-2020.jpg"
                    alt="Gambar Berita" class="img-fluid rounded shadow-sm" style="max-height: 600px; object-fit: cover;">
            </div>

            <!-- TRENDING -->
            <div class="col-md-6">
                <h5 class="text-primary fw-bold">#TRENDING</h5>
                <ol class="list-group list-group-numbered list-group-flush">
                    <li class="list-group-item border-0 ps-0">
                        <span class="text-muted">Bisnis</span><br>
                        <a href="#" class="text-dark text-decoration-none trending-ellipsis">
                            Indonesia Bisa Jadi Negara Maju 2045 Ditopang Investasi dan Hilirisasi
                        </a>
                    </li>
                    <li class="list-group-item border-0 ps-0">
                        <span class="text-muted">Bisnis</span><br>
                        <a href="#" class="text-dark text-decoration-none trending-ellipsis">
                            Indonesia Bisa Jadi
                            Negara Maju 2045
                            Ditopang Investasi dan Hilirisasi</a>
                    </li>
                    <li class="list-group-item border-0 ps-0">
                        <span class="text-muted text-bold">Budaya</span><br>
                        <span class="trending-ellipsis text-muted">Tidak ada artikel trending</span>
                    </li>
                </ol>
            </div>
        </div>

        <hr class="my-5">

        <!-- TERPOPULER -->
        <div class="mb-4 mt-5 text-center">
            <span class="text-orange fw-bold" style="font-size: 1.3rem;">TERPOPULER</span>
        </div>

        <!-- LAINNYA -->
        <h4 class="fw-bold mb-3">&gt; LAINNYA</h4>

        <!-- BISNIS -->
        <h6 class="text-primary border-start border-3 ps-2">BISNIS</h6>
        <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('gambar/artikel1.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Indonesia Bisa Jadi Negara Maju 2045 Ditopang Investasi dan Hilirisasi</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('gambar/artikel2.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Dinilai Gercep Wujudkan Swasembada Pangan, Mentan...</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card h-100">
                    <img src="{{ asset('gambar/artikel3.jpg') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">Kementan Usulkan Alokasi Rp23,61 Triliun dari APBN</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- KATEGORI LAIN -->
        @foreach (['KEUANGAN', 'OLAHRAGA', 'INTERNASIONAL', 'BUDAYA'] as $kategori)
            <h6 class="text-primary border-start border-3 ps-2">{{ $kategori }}</h6>
            <p class="text-muted">Belum ada artikel untuk kategori ini.</p>
        @endforeach

    </div>
@endsection
