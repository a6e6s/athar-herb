@extends('layouts.app')

@section('title', 'من نحن - عطار الأعشاب')

@section('content')
    <section class="py-5" style="margin-top: 80px;">
        <div class="container">
            <div class="page-header text-center mb-5">
                <h1 class="fw-bold">من نحن</h1>
                <p class="lead">تعرف على قصتنا ورؤيتنا</p>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <img src="https://images.unsplash.com/photo-1556742393-d75f468bfcb0?w=600"
                         alt="من نحن"
                         class="img-fluid rounded shadow">
                </div>

                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">رؤيتنا</h2>
                    <p class="text-muted">
                        نسعى لأن نكون الخيار الأول للباحثين عن المنتجات الطبيعية عالية الجودة في المنطقة.
                        نؤمن بأن الطبيعة تحمل الحلول الأفضل للصحة والعافية.
                    </p>
                    <p class="text-muted">
                        منذ تأسيسنا، التزمنا بتقديم منتجات طبيعية نقية 100%، مع الحفاظ على أعلى معايير الجودة
                        في كل مرحلة من مراحل الإنتاج والتوزيع.
                    </p>
                </div>
            </div>

            <div class="row text-center mt-5">
                <div class="col-md-3 mb-4">
                    <div class="card stat-card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-success mb-3">
                                <i class="fas fa-users fa-3x"></i>
                            </div>
                            <h3 class="fw-bold">500+</h3>
                            <p class="text-muted mb-0">عميل سعيد</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card stat-card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-success mb-3">
                                <i class="fas fa-box fa-3x"></i>
                            </div>
                            <h3 class="fw-bold">50+</h3>
                            <p class="text-muted mb-0">منتج طبيعي</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card stat-card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-success mb-3">
                                <i class="fas fa-award fa-3x"></i>
                            </div>
                            <h3 class="fw-bold">100%</h3>
                            <p class="text-muted mb-0">جودة مضمونة</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 mb-4">
                    <div class="card stat-card h-100 shadow-sm">
                        <div class="card-body">
                            <div class="text-success mb-3">
                                <i class="fas fa-truck fa-3x"></i>
                            </div>
                            <h3 class="fw-bold">24 ساعة</h3>
                            <p class="text-muted mb-0">توصيل سريع</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
