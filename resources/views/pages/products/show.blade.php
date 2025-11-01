@extends('layouts.app')

@section('title', $product->name_ar . ' - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
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

                    @if($product->stock > 0)
                        <div class="d-flex gap-2 mb-4">
                            <button class="btn btn-success btn-lg flex-grow-1" onclick="addToCart({{ $product->id }})">
                                <i class="fas fa-cart-plus ms-2"></i>
                                إضافة إلى السلة
                            </button>
                            <button class="btn btn-outline-danger btn-lg" onclick="addToWishlist({{ $product->id }})">
                                <i class="fas fa-heart"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            
            @if($relatedProducts->count() > 0)
                <div class="mt-5">
                    <h3 class="fw-bold mb-4">منتجات ذات صلة</h3>
                    <div class="row g-4">
                        @foreach($relatedProducts as $relatedProduct)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card product-card h-100 shadow-sm">
                                    <img src="{{ asset('storage/' . $relatedProduct->image) }}"
                                         class="card-img-top"
                                         alt="{{ $relatedProduct->name_ar }}"
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $relatedProduct->name_ar }}</h5>
                                        <p class="text-success fw-bold">{{ number_format($relatedProduct->price, 2) }} ريال</p>
                                        <a href="{{ route('products.show', $relatedProduct->slug) }}" class="btn btn-success w-100">
                                            عرض التفاصيل
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

@push('scripts')
<script>
    function addToCart(productId) {
        fetch('/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ product_id: productId, quantity: 1 })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('cartCount').textContent = data.cart_count;
                const toast = new bootstrap.Toast(document.getElementById('liveToast'));
                document.querySelector('#liveToast .toast-body').textContent = data.message;
                toast.show();
            }
        });
    }
    
    function addToWishlist(productId) {
        fetch('/wishlist/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ product_id: productId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('wishlistCount').textContent = data.wishlist_count;
                const toast = new bootstrap.Toast(document.getElementById('liveToast'));
                document.querySelector('#liveToast .toast-body').textContent = data.message;
                toast.show();
            }
        });
    }
</script>
@endpush
