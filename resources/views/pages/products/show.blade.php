@extends('layouts.app')

@section('title', 'تفاصيل المنتج - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            @php
                $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
            @endphp
            
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">المنتجات</a></li>
                    <li class="breadcrumb-item active">{{ $product->name_ar }}</li>
                </ol>
            </nav>
            
            <div class="row">
                <div class="col-lg-6 mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name_ar }}" 
                         class="img-fluid rounded shadow">
                </div>
                
                <div class="col-lg-6">
                    <h1 class="fw-bold mb-3">{{ $product->name_ar }}</h1>
                    
                    <div class="mb-4">
                        @if($product->discount_price)
                            <span class="h2 text-success">{{ number_format($product->discount_price, 2) }} ريال</span>
                            <span class="h4 text-muted text-decoration-line-through ms-2">
                                {{ number_format($product->price, 2) }} ريال
                            </span>
                        @else
                            <span class="h2 text-success">{{ number_format($product->price, 2) }} ريال</span>
                        @endif
                    </div>
                    
                    <div class="mb-4">
                        <p class="text-muted">{{ $product->description_ar }}</p>
                    </div>
                    
                    @if($product->stock > 0)
                        <div class="mb-3">
                            <span class="badge bg-success">متوفر في المخزون ({{ $product->stock }} قطعة)</span>
                        </div>
                    @else
                        <div class="mb-3">
                            <span class="badge bg-danger">نفذت الكمية</span>
                        </div>
                    @endif
                    
                    <div class="d-flex gap-2 mb-4">
                        <button class="btn btn-success btn-lg flex-grow-1">
                            <i class="fas fa-cart-plus ms-2"></i>
                            إضافة إلى السلة
                        </button>
                        <button class="btn btn-outline-danger btn-lg">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
