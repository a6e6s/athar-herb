@extends('layouts.app')

@section('title', 'جميع المنتجات - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <div class="page-header text-center mb-5">
                <h1 class="fw-bold">جميع المنتجات</h1>
                <p class="lead text-muted">تصفح مجموعتنا الكاملة من المنتجات الطبيعية</p>
            </div>
            
            <div class="row">
                <div class="col-lg-3 mb-4">
                    <!-- Filters Sidebar -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">التصنيفات</h5>
                            @php
                                $categories = \App\Models\Category::where('is_active', true)->orderBy('name_ar')->get();
                            @endphp
                            <div class="list-group">
                                <a href="{{ route('products.index') }}" class="list-group-item list-group-item-action">
                                    الكل
                                </a>
                                @foreach($categories as $category)
                                    <a href="{{ route('categories.show', $category->slug) }}" 
                                       class="list-group-item list-group-item-action">
                                        {{ $category->name_ar }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="fw-bold mb-3">نطاق السعر</h5>
                            <div class="mb-3">
                                <label class="form-label">من</label>
                                <input type="number" class="form-control" placeholder="0">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">إلى</label>
                                <input type="number" class="form-control" placeholder="1000">
                            </div>
                            <button class="btn btn-success w-100">تطبيق</button>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-9">
                    <div class="row g-4">
                        @php
                            $products = \App\Models\Product::where('is_active', true)
                                ->orderBy('sort_order')
                                ->paginate(12);
                        @endphp
                        
                        @forelse($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="card product-card h-100 shadow-sm">
                                    @if($product->discount_price)
                                        <span class="badge bg-danger position-absolute top-0 start-0 m-3">
                                            خصم {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                        </span>
                                    @endif
                                    
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         class="card-img-top" 
                                         alt="{{ $product->name_ar }}"
                                         style="height: 250px; object-fit: cover;">
                                    
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title">{{ $product->name_ar }}</h5>
                                        <p class="card-text text-muted small flex-grow-1">
                                            {{ Str::limit($product->description_ar, 80) }}
                                        </p>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div>
                                                @if($product->discount_price)
                                                    <span class="h5 text-success mb-0">{{ number_format($product->discount_price, 2) }} ريال</span>
                                                    <span class="text-muted text-decoration-line-through small d-block">
                                                        {{ number_format($product->price, 2) }} ريال
                                                    </span>
                                                @else
                                                    <span class="h5 text-success mb-0">{{ number_format($product->price, 2) }} ريال</span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('products.show', $product->slug) }}" 
                                               class="btn btn-outline-success flex-grow-1">
                                                عرض
                                            </a>
                                            <button class="btn btn-success flex-grow-1">
                                                إضافة
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <p class="text-muted">لا توجد منتجات</p>
                            </div>
                        @endforelse
                    </div>
                    
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
