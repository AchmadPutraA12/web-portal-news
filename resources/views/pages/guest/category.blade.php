@extends('layouts.guest')

@section('content')
    <div class="container py-5">
        <h4 class="fw-bold mb-4">Kategori: {{ strtoupper($category->name) }}</h4>

        @if ($category->articles->isEmpty())
            <p class="text-muted">Belum ada artikel untuk kategori ini.</p>
        @else
            <div class="row row-cols-1 row-cols-md-3 g-4 mb-5">
                @foreach ($category->articles as $article)
                    <div class="col">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . ($article->image_1 ?? 'default.jpg')) }}" class="card-img-top"
                                alt="{{ $article->title }}">
                            <div class="card-body">
                                <h6 class="card-title">
                                    <a href="{{ route('article.detail', $article->id) }}"
                                        class="text-dark text-decoration-none">
                                        {{ $article->title }}
                                    </a>
                                </h6>
                                <p class="card-text">{{ Str::limit(strip_tags($article->content_article), 100) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
