@extends('layouts.guest')

@section('content')
    <div class="container py-5">
        <h1 class="fw-bold mb-3">{{ $article->title }}</h1>
        <p class="text-muted mb-4">
            {{ $article->created_at->format('d M Y') }} |
            Kategori:
            <a href="{{ route('category', $article->category->id) }}" class="text-decoration-none">
                {{ strtoupper($article->category->name) }}
            </a>
        </p>

        @if ($article->image_1)
            <img src="{{ asset('storage/' . $article->image_1) }}" alt="{{ $article->title }}" class="img-fluid mb-4 rounded"
                style="max-height: 500px; object-fit: cover; width: 100%;">
        @endif

        <div class="article-content mb-4">
            {!! $article->content_article !!}
        </div>

        @if ($article->layout != 1)
            <div class="row mb-4">
                @if ($article->image_2)
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $article->image_2) }}" alt="Image 2" class="img-fluid rounded"
                            style="max-height: 400px; object-fit: cover; width: 100%;">
                    </div>
                @endif
                @if ($article->image_3)
                    <div class="col-md-6">
                        <img src="{{ asset('storage/' . $article->image_3) }}" alt="Image 3" class="img-fluid rounded"
                            style="max-height: 400px; object-fit: cover; width: 100%;">
                    </div>
                @endif
            </div>
        @endif

    </div>
@endsection
