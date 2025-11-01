@extends('layouts.app')

@section('title', 'الأقسام - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="fw-bold mb-4">جميع الأقسام</h1>

            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <a href="{{ route('categories.show', $category->slug) }}" class="text-decoration-none">
                            <div class="card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <i class="fas fa-leaf fa-3x text-success mb-3"></i>
                                    <h5 class="card-title">{{ $category->name_ar }}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
