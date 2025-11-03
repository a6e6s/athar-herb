@extends('layouts.app')

@section('title', $post->title_ar . ' - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <article>
                <h1 class="fw-bold mb-3">{{ $post->title_ar }}</h1>
                <p class="text-muted mb-4">{{ $post->published_at?->format('d M Y') }}</p>

                <img src="{{ asset('storage/' . $post->featured_image) }}"
                     alt="{{ $post->title_ar }}"
                     class="img-fluid rounded mb-4">

                <div class="content">
                    {!! nl2br(e($post->content_ar)) !!}
                </div>
            </article>

            @if($relatedPosts->count() > 0)
                <div class="mt-5">
                    <h3 class="fw-bold mb-4">مقالات ذات صلة</h3>
                    <div class="row g-4">
                        @foreach($relatedPosts as $relatedPost)
                            <div class="col-lg-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="{{ asset('storage/' . $relatedPost->image) }}"
                                         class="card-img-top"
                                         alt="{{ $relatedPost->title_ar }}"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $relatedPost->title_ar }}</h5>
                                        <p class="text-muted small">{{ $relatedPost->published_at?->format('d M Y') }}</p>
                                        <a href="{{ route('blog.show', $relatedPost->slug) }}" class="btn btn-outline-success">
                                            اقرأ المزيد
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
