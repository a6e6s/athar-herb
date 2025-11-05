<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('images/logo.png') }}" alt="{{ env('APP_NAME') }} logo" height="60" class="me-2">
            {{-- <span class="fw-bold text-success"> {{ env('APP_NAME') }}</span> --}}
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-home ms-1"></i> الرئيسية
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        <i class="fas fa-leaf ms-1"></i> المنتجات
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="fas fa-th-large ms-1"></i> الأقسام
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}" href="{{ route('blog.index') }}">
                        <i class="fas fa-newspaper ms-1"></i> المدونة
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        <i class="fas fa-info-circle ms-1"></i> من نحن
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="fas fa-envelope ms-1"></i> اتصل بنا
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                <!-- Dark Mode Toggle -->
                <button class="btn btn-outline-secondary" id="darkModeToggle" title="وضع داكن/فاتح">
                    <i class="fas fa-moon"></i>
                </button>

                <!-- Search -->
                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#searchModal" title="بحث">
                    <i class="fas fa-search"></i>
                </button>

                <!-- Wishlist -->
                <a href="{{ route('wishlist') }}" class="btn btn-outline-danger position-relative" title="المفضلة">
                    <i class="fas fa-heart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="wishlistCount">
                        0
                    </span>
                </a>

                <!-- Cart -->
                <a href="{{ route('cart') }}" class="btn btn-outline-success position-relative" title="السلة">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success" id="cartCount">
                        0
                    </span>
                </a>

                <!-- User Account -->
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user ms-1"></i> {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user-circle ms-2"></i> حسابي
                            </a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}">
                                <i class="fas fa-box ms-2"></i> طلباتي
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt ms-2"></i> تسجيل الخروج
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-primary">
                        <i class="fas fa-sign-in-alt ms-1"></i> تسجيل الدخول
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<!-- Search Modal -->
<div class="modal fade" id="searchModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">بحث عن المنتجات</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="ابحث عن منتج..." required>
                        <button class="btn btn-success" type="submit">
                            <i class="fas fa-search"></i> بحث
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
