@extends('layouts.app')

@section('title', 'إتمام الطلب - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            {{-- Breadcrumb --}}
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">الرئيسية</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('cart') }}">سلة التسوق</a></li>
                    <li class="breadcrumb-item active">إتمام الطلب</li>
                </ol>
            </nav>

            <h1 class="fw-bold mb-4">
                <i class="fas fa-credit-card ms-2"></i>
                إتمام الطلب
            </h1>

            <div class="alert alert-info">
                <i class="fas fa-info-circle ms-2"></i>
                صفحة الدفع قيد التطوير. سيتم إضافة نظام الدفع قريباً.
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">معلومات التوصيل</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted">يرجى إكمال نظام الدفع والتوصيل</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white py-3">
                            <h5 class="mb-0">ملخص الطلب</h5>
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
                                <span>المجموع الفرعي:</span>
                                <span>{{ number_format($subtotal, 2) }} ريال</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>الشحن:</span>
                                <span>{{ $shipping == 0 ? 'مجاني' : number_format($shipping, 2) . ' ريال' }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>الضريبة:</span>
                                <span>{{ number_format($tax, 2) }} ريال</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between">
                                <strong>الإجمالي:</strong>
                                <strong class="text-success">{{ number_format($total, 2) }} ريال</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
