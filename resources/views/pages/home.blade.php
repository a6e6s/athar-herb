@extends('layouts.app')

@section('title', 'عطار الأعشاب - منتجات عشبية طبيعية')

@push('styles')
<style>
    .section-products,
    .section-testimonials,
    .section-faq,
    .section-blog-preview,
    .section-about,
    .section-contact-cta {
        padding-top: 3rem;
        padding-bottom: 3rem;
    }
</style>
@endpush

@section('content')
    <!-- Banner Slider -->
    @if($banners->count() > 0)
        @include('components.banner-slider', ['banners' => $banners])
    @endif

    <!-- Featured Products Section -->
    <section class="section-products py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold">منتجاتنا المميزة</h2>
                <p class="text-muted">اختر من بين مجموعة متنوعة من المنتجات الطبيعية عالية الجودة</p>
            </div>

            <div class="row g-4">
                @forelse($featuredProducts as $product)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="card product-card h-100 shadow-sm">
                            @if($product->discount_price)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-3">
                                    خصم {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                </span>
                            @endif

                            @if($product->stock <= 0)
                                <span class="badge bg-secondary position-absolute top-0 end-0 m-3">
                                    نفذت الكمية
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

                                    <div class="product-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= round($product->average_rating ?? 5) ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <a href="{{ route('products.show', $product->slug) }}"
                                       class="btn btn-outline-success flex-grow-1">
                                        <i class="fas fa-eye ms-1"></i> عرض
                                    </a>

                                    @if($product->stock > 0)
                                        <button class="btn btn-success flex-grow-1"
                                                onclick="addToCart({{ $product->id }})">
                                            <i class="fas fa-cart-plus ms-1"></i> إضافة
                                        </button>
                                    @else
                                        <button class="btn btn-secondary flex-grow-1" disabled>
                                            غير متوفر
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">لا توجد منتجات مميزة حالياً</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary btn-lg">
                    عرض جميع المنتجات
                    <i class="fas fa-arrow-left ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section-testimonials py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold">آراء عملائنا</h2>
                <p class="text-muted">ماذا يقول عملاؤنا السعداء عن منتجاتنا</p>
            </div>

            <div class="row g-4">
                @forelse($testimonials as $testimonial)
                    <div class="col-lg-4 col-md-6">
                        <div class="card testimonial-card h-100 shadow-sm">
                            <div class="card-body">
                                <div class="testimonial-rating mb-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </div>

                                <p class="card-text">"{{ $testimonial->content_ar }}"</p>

                                <div class="d-flex align-items-center mt-4">
                                    @if($testimonial->image)
                                        <img src="{{ asset('storage/' . $testimonial->image) }}"
                                             alt="{{ $testimonial->name_ar }}"
                                             class="rounded-circle me-3"
                                             width="50" height="50"
                                             style="object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-success text-white d-flex align-items-center justify-content-center me-3"
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif

                                    <div>
                                        <h6 class="mb-0">{{ $testimonial->name_ar }}</h6>
                                        <small class="text-muted">{{ $testimonial->position_ar }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">لا توجد آراء حالياً</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section-faq py-5">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold">الأسئلة الشائعة</h2>
                <p class="text-muted">إجابات على الأسئلة الأكثر شيوعاً</p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion accordion-flush" id="faqAccordion">
                        @foreach($faqs as $index => $faq)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                            type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#faq{{ $faq->id }}">
                                        {{ $faq->question_ar }}
                                    </button>
                                </h2>
                                <div id="faq{{ $faq->id }}"
                                     class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}"
                                     data-bs-parent="#faqAccordion">
                                    <div class="accordion-body">
                                        {{ $faq->answer_ar }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Posts Preview -->
    <section class="section-blog-preview py-5 bg-light">
        <div class="container">
            <div class="section-header text-center mb-5">
                <h2 class="fw-bold">أحدث المقالات</h2>
                <p class="text-muted">تابع آخر المقالات والنصائح الصحية</p>
            </div>

            <div class="row g-4">
                @forelse($posts as $post)
                    <div class="col-lg-4 col-md-6">
                        <div class="card blog-card h-100 shadow-sm">
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $post->image) }}"
                                     class="card-img-top"
                                     alt="{{ $post->title_ar }}"
                                     style="height: 250px; object-fit: cover;">
                                @if($post->category)
                                    <span class="badge bg-success position-absolute top-0 end-0 m-3">
                                        {{ $post->category->name_ar }}
                                    </span>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column">
                                <div class="blog-meta mb-3 text-muted small">
                                    <span class="me-3">
                                        <i class="fas fa-calendar ms-1"></i>
                                        {{ $post->published_at?->format('d M Y') }}
                                    </span>
                                    @if($post->author)
                                        <span>
                                            <i class="fas fa-user ms-1"></i>
                                            {{ $post->author }}
                                        </span>
                                    @endif
                                </div>

                                <h5 class="card-title">{{ $post->title_ar }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit($post->excerpt_ar ?? $post->content_ar, 100) }}
                                </p>

                                <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-link p-0">
                                    اقرأ المزيد <i class="fas fa-arrow-left ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p class="text-muted">لا توجد مقالات حالياً</p>
                    </div>
                @endforelse
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('blog.index') }}" class="btn btn-outline-primary btn-lg">
                    عرض جميع المقالات
                    <i class="fas fa-arrow-left ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="section-about py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-4 mb-lg-0">
                    <h2 class="fw-bold mb-4">من نحن</h2>
                    <p class="lead text-success">عطار الأعشاب هو متجرك الموثوق للمنتجات العشبية والطبيعية عالية الجودة</p>
                    <p class="text-muted">
                        نحن نؤمن بقوة الطبيعة في تحسين الصحة والعافية. نقدم لكم منتجات مختارة بعناية من أجود المصادر الطبيعية،
                        مع الالتزام بأعلى معايير الجودة والنقاء.
                    </p>

                    <div class="row mt-4">
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                                <span class="fw-bold">منتجات طبيعية 100%</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                                <span class="fw-bold">جودة عالية مضمونة</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                                <span class="fw-bold">أسعار منافسة</span>
                            </div>
                        </div>
                        <div class="col-sm-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success fa-2x me-3"></i>
                                <span class="fw-bold">توصيل سريع</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="btn btn-success btn-lg mt-4">
                        اكتشف المزيد عنا
                        <i class="fas fa-arrow-left ms-2"></i>
                    </a>
                </div>

                <div class="col-lg-6 text-center">
                    <img src="{{ asset('images/logo.png') }}"
                         alt="عطار الأعشاب"
                         class="img-fluid rounded shadow"
                         style="max-width: 400px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Contact CTA Section -->
    <section class="section-contact-cta py-5 bg-success text-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">هل لديك أسئلة؟</h2>
            <p class="lead mb-4">فريقنا جاهز للإجابة على استفساراتكم</p>
            <a href="{{ route('contact') }}" class="btn btn-light btn-lg">
                <i class="fas fa-envelope ms-2"></i>
                اتصل بنا الآن
            </a>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Add to Cart Function
    function addToCart(productId) {
        // Implement cart functionality
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
                // Update cart count
                document.getElementById('cartCount').textContent = data.cart_count;

                // Show toast notification
                const toast = new bootstrap.Toast(document.getElementById('liveToast'));
                document.querySelector('#liveToast .toast-body').textContent = 'تمت إضافة المنتج إلى السلة';
                toast.show();
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@endpush
