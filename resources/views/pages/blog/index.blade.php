@extends('layouts.app')

@section('title', 'المدونة - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="fw-bold mb-4">المدونة</h1>

            <div class="row g-4">
                @php
                    $posts = \App\Models\Post::where('is_active', true)->paginate(9);
                @endphp

                @foreach($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $post->image) }}"
                                 class="card-img-top"
                                 alt="{{ $post->title_ar }}"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title_ar }}</h5>
                                <p class="text-muted small">{{ $post->published_at?->format('d M Y') }}</p>
                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-success">
                                    اقرأ المزيد
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </section>
@endsection
