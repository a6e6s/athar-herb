@extends('layouts.app')

@section('title', $category->name_ar . ' - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <h1 class="fw-bold mb-4">{{ $category->name_ar }}</h1>

            @if($category->description_ar)
                <p class="text-muted mb-4">{{ $category->description_ar }}</p>
            @endif

            <div class="row g-4">
                @foreach($products as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card product-card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="card-img-top"
                                 alt="{{ $product->name_ar }}"
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name_ar }}</h5>
                                <p class="text-success fw-bold">{{ number_format($product->price, 2) }} ريال</p>
                                <a href="{{ route('products.show', $product->slug) }}" class="btn btn-success w-100">
                                    عرض التفاصيل
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
