@extends('layouts.app')

@section('title', 'سلة التسوق - عطار الأعشاب')

@push('styles')
<style>
    .quantity-input {
        -moz-appearance: textfield;
    }
    .quantity-input::-webkit-outer-spin-button,
    .quantity-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .cart-item-row {
        transition: all 0.3s ease;
    }

    .cart-item-row:hover {
        background-color: rgba(0, 0, 0, 0.02);
    }

    .btn-outline-secondary:hover {
        transform: scale(1.05);
    }

    .sticky-top {
        transition: box-shadow 0.3s ease;
    }

    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }

        .sticky-top {
            position: relative !important;
            top: auto !important;
        }
    }
</style>
@endpush

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item active">سلة التسوق</li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-4">
                <i class="fas fa-shopping-cart ms-2"></i>
                سلة التسوق
            </h1>

            @if(empty($cartItems))
                {{-- Empty Cart State --}}
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-shopping-cart fa-5x text-muted opacity-50"></i>
                    </div>
                    <h3 class="text-muted mb-3">سلة التسوق فارغة</h3>
                    <p class="text-muted mb-4">لم تقم بإضافة أي منتجات بعد. ابدأ بالتسوق الآن!</p>
                    <a href="{{ route('products.index') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-shopping-bag ms-2"></i>
                        تصفح المنتجات
                    </a>
                </div>
            @else
                <div class="row g-4">
                    {{-- Cart Items Section --}}
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-list ms-2"></i>
                                    المنتجات ({{ count($cartItems) }})
                                </h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-hover align-middle mb-0" id="cart-table">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width: 100px;">الصورة</th>
                                                <th>المنتج</th>
                                                <th style="width: 120px;">السعر</th>
                                                <th style="width: 150px;">الكمية</th>
                                                <th style="width: 120px;">الإجمالي</th>
                                                <th style="width: 80px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $item)
                                                <tr data-item-id="{{ $item['id'] }}" class="cart-item-row">
                                                    <td>
                                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                                             alt="{{ $item['name'] }}"
                                                             class="img-thumbnail"
                                                             style="width: 80px; height: 80px; object-fit: cover;">
                                                    </td>
                                                    <td>
                                                        <h6 class="mb-0">{{ $item['name'] }}</h6>
                                                    </td>
                                                    <td>
                                                        <span class="text-success fw-bold">
                                                            {{ number_format($item['price'], 2) }} ريال
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="input-group input-group-sm" style="max-width: 120px;">
                                                            <button class="btn btn-outline-secondary"
                                                                    type="button"
                                                                    onclick="updateQuantity({{ $item['id'] }}, -1)">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                            <input type="number"
                                                                   class="form-control text-center quantity-input"
                                                                   value="{{ $item['quantity'] }}"
                                                                   min="1"
                                                                   max="99"
                                                                   id="quantity-{{ $item['id'] }}"
                                                                   onchange="updateCartItem({{ $item['id'] }}, this.value)">
                                                            <button class="btn btn-outline-secondary"
                                                                    type="button"
                                                                    onclick="updateQuantity({{ $item['id'] }}, 1)">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="fw-bold item-total" id="total-{{ $item['id'] }}">
                                                            {{ number_format($item['price'] * $item['quantity'], 2) }} ريال
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-outline-danger"
                                                                onclick="removeItem({{ $item['id'] }})"
                                                                title="حذف">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-footer bg-white">
                                <a href="{{ route('products.index') }}" class="btn btn-outline-success">
                                    <i class="fas fa-arrow-right ms-2"></i>
                                    متابعة التسوق
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Order Summary Section --}}
                    <div class="col-lg-4">
                        <div class="card shadow-sm sticky-top" style="top: 100px;">
                            <div class="card-header bg-success text-white py-3">
                                <h5 class="mb-0">
                                    <i class="fas fa-receipt ms-2"></i>
                                    ملخص الطلب
                                </h5>
                            </div>
                            <div class="card-body">
                                @php
                                    $subtotal = 0;
                                    foreach($cartItems as $item) {
                                        $subtotal += $item['price'] * $item['quantity'];
                                    }
                                    $shipping = $subtotal >= 200 ? 0 : 30;
                                    $tax = $subtotal * 0.15;
                                    $total = $subtotal + $shipping + $tax;
                                @endphp

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">المجموع الفرعي:</span>
                                    <span class="fw-bold" id="subtotal">{{ number_format($subtotal, 2) }} ريال</span>
                                </div>

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">الشحن:</span>
                                    <span class="fw-bold" id="shipping">
                                        @if($shipping == 0)
                                            <span class="text-success">مجاني</span>
                                        @else
                                            {{ number_format($shipping, 2) }} ريال
                                        @endif
                                    </span>
                                </div>

                                @if($subtotal < 200 && $subtotal > 0)
                                    <div class="alert alert-info small mb-3">
                                        <i class="fas fa-info-circle ms-1"></i>
                                        أضف {{ number_format(200 - $subtotal, 2) }} ريال للحصول على شحن مجاني
                                    </div>
                                @endif

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">ضريبة القيمة المضافة (15%):</span>
                                    <span class="fw-bold" id="tax">{{ number_format($tax, 2) }} ريال</span>
                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-4">
                                    <span class="h5 mb-0">الإجمالي:</span>
                                    <span class="h4 text-success mb-0 fw-bold" id="grand-total">
                                        {{ number_format($total, 2) }} ريال
                                    </span>
                                </div>

                                <a href="{{ route('checkout') }}" class="btn btn-success btn-lg w-100 mb-3">
                                    <i class="fas fa-credit-card ms-2"></i>
                                    إتمام الطلب
                                </a>

                                <button class="btn btn-outline-danger btn-sm w-100" onclick="clearCart()">
                                    <i class="fas fa-trash-alt ms-2"></i>
                                    إفراغ السلة
                                </button>
                            </div>
                        </div>

                        {{-- Security Badges --}}
                        <div class="card shadow-sm mt-3">
                            <div class="card-body text-center">
                                <div class="row g-2">
                                    <div class="col-4">
                                        <i class="fas fa-lock fa-2x text-success mb-2"></i>
                                        <p class="small mb-0">دفع آمن</p>
                                    </div>
                                    <div class="col-4">
                                        <i class="fas fa-truck fa-2x text-success mb-2"></i>
                                        <p class="small mb-0">شحن سريع</p>
                                    </div>
                                    <div class="col-4">
                                        <i class="fas fa-undo fa-2x text-success mb-2"></i>
                                        <p class="small mb-0">إرجاع سهل</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- Toast Notification --}}
    <div class="position-fixed bottom-0 start-50 translate-middle-x p-3" style="z-index: 11">
        <div id="cartToast" class="toast align-items-center" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body" id="toastMessage"></div>
                <button type="button" class="btn-close ms-auto me-2" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // Update quantity with +/- buttons
    function updateQuantity(itemId, change) {
        const input = document.getElementById(`quantity-${itemId}`);
        let newValue = parseInt(input.value) + change;

        if (newValue < 1) newValue = 1;
        if (newValue > 99) newValue = 99;

        input.value = newValue;
        updateCartItem(itemId, newValue);
    }

    // Update cart item quantity
    function updateCartItem(itemId, quantity) {
        if (quantity < 1) return;

        fetch(`/cart/${itemId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ quantity: parseInt(quantity) })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Recalculate and update the page
                location.reload();
            } else {
                showToast('حدث خطأ في تحديث الكمية', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('حدث خطأ في تحديث الكمية', 'danger');
        });
    }

    // Remove item from cart
    function removeItem(itemId) {
        if (!confirm('هل أنت متأكد من حذف هذا المنتج من السلة؟')) {
            return;
        }

        fetch(`/cart/${itemId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showToast('تم حذف المنتج من السلة', 'success');
                setTimeout(() => location.reload(), 1000);
            } else {
                showToast('حدث خطأ في حذف المنتج', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('حدث خطأ في حذف المنتج', 'danger');
        });
    }

    // Clear entire cart
    function clearCart() {
        if (!confirm('هل أنت متأكد من إفراغ السلة بالكامل؟')) {
            return;
        }

        const cartItems = document.querySelectorAll('[data-item-id]');
        const deletePromises = [];

        cartItems.forEach(row => {
            const itemId = row.dataset.itemId;
            deletePromises.push(
                fetch(`/cart/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
            );
        });

        Promise.all(deletePromises)
            .then(() => {
                showToast('تم إفراغ السلة بنجاح', 'success');
                setTimeout(() => location.reload(), 1000);
            })
            .catch(error => {
                console.error('Error:', error);
                showToast('حدث خطأ في إفراغ السلة', 'danger');
            });
    }

    // Show toast notification
    function showToast(message, type = 'success') {
        const toastEl = document.getElementById('cartToast');
        const toastBody = document.getElementById('toastMessage');

        toastEl.classList.remove('text-bg-success', 'text-bg-danger', 'text-bg-info');
        toastEl.classList.add(`text-bg-${type}`);
        toastBody.textContent = message;

        const toast = new bootstrap.Toast(toastEl);
        toast.show();
    }
</script>
@endpush
