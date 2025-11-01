@extends('layouts.app')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            @php
                $post = \App\Models\Post::where('slug', $slug)->firstOrFail();
            @endphp
            
            <article>
                <h1 class="fw-bold mb-3">{{ $post->title_ar }}</h1>
                <p class="text-muted mb-4">{{ $post->published_at?->format('d M Y') }}</p>
                
                <img src="{{ asset('storage/' . $post->image) }}" 
                     alt="{{ $post->title_ar }}" 
                     class="img-fluid rounded mb-4">
                
                <div class="content">
                    {!! nl2br(e($post->content_ar)) !!}
                </div>
            </article>
        </div>
    </section>
@endsection
