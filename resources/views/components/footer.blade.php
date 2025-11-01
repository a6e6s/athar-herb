<footer class="bg-dark text-white py-5 ">
    <div class="container">
        <div class="row g-4">
            <!-- About Section -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-success mb-3">
                    <i class="fas fa-leaf ms-2"></i> عطار الأعشاب
                </h5>
                <p class="text-white-50">
                    متجرك الموثوق للأعشاب الطبيعية والمنتجات العضوية. نقدم أفضل المنتجات الطبيعية لصحتك وعافيتك.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="btn btn-outline-light btn-sm rounded-circle">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-success mb-3">روابط سريعة</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="{{ route('home') }}" class="text-white-50 text-decoration-none">
                            <i class="fas fa-chevron-left ms-2"></i> الرئيسية
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('about') }}" class="text-white-50 text-decoration-none">
                            <i class="fas fa-chevron-left ms-2"></i> من نحن
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('products.index') }}" class="text-white-50 text-decoration-none">
                            <i class="fas fa-chevron-left ms-2"></i> المنتجات
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('blog.index') }}" class="text-white-50 text-decoration-none">
                            <i class="fas fa-chevron-left ms-2"></i> المدونة
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="{{ route('contact') }}" class="text-white-50 text-decoration-none">
                            <i class="fas fa-chevron-left ms-2"></i> اتصل بنا
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Categories -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-success mb-3">الأقسام الرئيسية</h5>
                <ul class="list-unstyled">
                    @php
                        $categories = \App\Models\Category::where('is_active', true)
                            ->limit(6)
                            ->get();
                    @endphp
                    @foreach($categories as $category)
                        <li class="mb-2">
                            <a href="{{ route('categories.show', $category->slug) }}" class="text-white-50 text-decoration-none">
                                <i class="fas fa-chevron-left ms-2"></i> {{ $category->name_ar }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <h5 class="text-success mb-3">معلومات التواصل</h5>
                <ul class="list-unstyled text-white-50">
                    <li class="mb-3">
                        <i class="fas fa-map-marker-alt text-success ms-2"></i>
                        الرياض، المملكة العربية السعودية
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-phone text-success ms-2"></i>
                        <a href="tel:+966500000000" class="text-white-50 text-decoration-none">
                            +966 50 000 0000
                        </a>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-envelope text-success ms-2"></i>
                        <a href="mailto:info@athar-herb.com" class="text-white-50 text-decoration-none">
                            info@athar-herb.com
                        </a>
                    </li>
                    <li class="mb-3">
                        <i class="fas fa-clock text-success ms-2"></i>
                        السبت - الخميس: 9:00 - 22:00
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4 bg-secondary">

        <!-- Copyright -->
        <div class="row">
            <div class="col-md-6 text-center text-md-start">
                <p class="text-white-50 mb-0">
                    &copy; {{ date('Y') }} عطار الأعشاب. جميع الحقوق محفوظة.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <a href="{{ route('privacy') }}" class="text-white-50 text-decoration-none me-3">سياسة الخصوصية</a>
                <a href="{{ route('terms') }}" class="text-white-50 text-decoration-none">الشروط والأحكام</a>
            </div>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button class="btn btn-success rounded-circle position-fixed bottom-0 end-0 m-4" id="scrollToTop" style="display: none; z-index: 1000;">
    <i class="fas fa-arrow-up"></i>
</button>
