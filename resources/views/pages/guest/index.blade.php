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
        <div class="row mb-4">
            <div class="col-12">
                <span class="text-orange fw-bold d-block mb-1">BERITA UTAMA</span>

                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <h2 class="fw-bold text-dark hover-grow text-truncate-custom flex-grow-1 m-0">
                        {{ $latestArticle?->title ?? 'Judul belum tersedia' }}
                    </h2>

                    <form action="#" method="GET" class="d-flex overflow-hidden rounded shadow-sm"
                        style="min-width: 280px; height: 42px;">
                        <input type="text" class="form-control border-0" placeholder="Cari Berita..." name="q">
                        <button class="btn btn-dark" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <p class="text-muted small mt-2">
                    {{ $latestArticle ? $latestArticle->created_at->format('d M Y') : '' }}
                    oleh
                    <strong>{{ $latestArticle->author ?? 'Admin' }}</strong>
                </p>
                <p class="text-muted">
                    {{ Str::limit(strip_tags($latestArticle->content_article ?? 'Belum ada isi artikel.'), 160) }}
                </p>
                <a href="{{ $latestArticle ? route('article.detail', $latestArticle->id) : '#' }}"
                    class="text-primary text-decoration-none fw-bold">SELENGKAPNYA</a>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <div class="col-md-8 text-center">
                <img src="{{ asset('storage/' . ($latestArticle->image_1 ?? 'default.jpg')) }}"
                    alt="{{ $latestArticle->title }}" class="img-fluid rounded shadow-sm"
                    style="max-height: 600px; object-fit: cover;">
            </div>

            <div class="col-md-4">
                <h5 class="text-primary fw-bold">#TRENDING</h5>
                <ol class="list-group list-group-numbered list-group-flush">
                    @forelse ($categoriesTrending as $cat)
                        @if ($cat->articles->isNotEmpty())
                            <li class="list-group-item border-0 ps-0">
                                <span class="text-muted">{{ strtoupper($cat->name) }}</span><br>
                                <a href="{{ route('article.detail', $cat->articles[0]->id) }}"
                                    class="text-dark text-decoration-none trending-ellipsis">
                                    {{ $cat->articles[0]->title }}
                                </a>
                            </li>
                        @endif
                    @empty
                        <li class="list-group-item border-0 ps-0">
                            <span class="trending-ellipsis text-muted">Tidak ada artikel trending</span>
                        </li>
                    @endforelse
                </ol>

            </div>
        </div>

        <hr class="my-5">

        <div class="mb-4 mt-5 text-center">
            <span class="text-orange fw-bold" style="font-size: 1.3rem;">TERPOPULER</span>
        </div>

        <h4 class="fw-bold mb-3">&gt; LAINNYA</h4>

        @foreach ($categoriesWithArticles as $kategori)
            <h6 class="text-primary border-start border-3 ps-2">{{ strtoupper($kategori->name) }}</h6>

            @if ($kategori->articles->isEmpty())
                <p class="text-muted">Belum ada artikel untuk kategori ini.</p>
            @else
                <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                    @foreach ($kategori->articles as $article)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ asset('storage/' . ($article->image_1 ?? 'default.jpg')) }}"
                                    class="card-img-top" alt="{{ $article->title }}">
                                <div class="card-body">
                                    <p class="card-text">
                                        {{ Str::limit($article->title, 80) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach

    </div>
@endsection
