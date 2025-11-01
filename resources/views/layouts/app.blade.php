<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'متجر عطار الأعشاب')</title>

    <!-- Bootstrap 5 RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts - Cairo -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            font-family: 'Cairo', sans-serif;
            padding-top: 80px; /* Space for fixed navbar */
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.08);
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }

        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease, border-color 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,.1);
        }

        .testimonial-card {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-3px);
        }

        .blog-card {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-3px);
        }

        #scrollToTop {
            width: 50px;
            height: 50px;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
        }

        #scrollToTop:hover {
            transform: scale(1.1);
        }

        .card, .btn, .form-control, .form-select, .modal-content, .dropdown-menu, .alert {
            transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
        }

        /* Smooth transition for dark mode toggle button */
        #darkModeToggle i {
            transition: transform 0.3s ease;
        }

        #darkModeToggle:hover i {
            transform: rotate(20deg);
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    @include('components.navbar')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">إشعار</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('js/app.js') }}"></script>

    @stack('scripts')
</body>
</html>
