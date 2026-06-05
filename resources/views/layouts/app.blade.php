<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .fade-in { animation: fadeIn 0.5s ease-in; }
            @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
            .slide-up { animation: slideUp 0.4s ease-out; }
            @keyframes slideUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
            .hover-lift { transition: transform 0.2s ease, box-shadow 0.2s ease; }
            .hover-lift:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(0,0,0,0.1); }
            .main-content { padding-top: 80px; }
            @media (min-width: 992px) { .main-content { padding-top: 105px; } }
            .hover-text-light { transition: color 0.2s ease; }
            .hover-text-light:hover { color: rgba(255,255,255,.8) !important; }
            .tracking-wider { letter-spacing: 0.05em; }
        </style>
    </head>
    <body class="font-sans antialiased">
        @include('layouts.navigation')

        <div class="min-h-screen bg-gray-100 main-content">
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-3">
                <button onclick="history.back()" class="text-sm text-gray-500 hover:text-gray-700 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/></svg>
                    Back
                </button>
            </div>

            <main class="fade-in">
                {{ $slot }}
            </main>

            <footer class="bg-dark text-light mt-5">
                <div class="container py-5">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <h6 class="fw-bold text-uppercase small tracking-wider mb-3">SmartTrade Africa Ltd</h6>
                            <p class="text-secondary small lh-lg">Your trusted e-commerce platform for secure and convenient online shopping.</p>
                        </div>
                        <div class="col-md-4">
                            <h6 class="fw-bold text-uppercase small tracking-wider mb-3">Quick Links</h6>
                            <ul class="list-unstyled small lh-lg">
                                <li><a href="{{ route('products.index') }}" class="text-secondary text-decoration-none hover-text-light">Products</a></li>
                                <li><a href="{{ route('about') }}" class="text-secondary text-decoration-none hover-text-light">About Us</a></li>
                                <li><a href="{{ route('contact') }}" class="text-secondary text-decoration-none hover-text-light">Contact</a></li>
                                <li><a href="{{ route('faq') }}" class="text-secondary text-decoration-none hover-text-light">FAQ</a></li>
                                <li><a href="{{ route('privacy') }}" class="text-secondary text-decoration-none hover-text-light">Privacy Policy</a></li>
                                <li><a href="{{ route('terms') }}" class="text-secondary text-decoration-none hover-text-light">Terms &amp; Conditions</a></li>
                                <li><a href="{{ route('refund') }}" class="text-secondary text-decoration-none hover-text-light">Refund Policy</a></li>
                                <li><a href="{{ route('trust') }}" class="text-secondary text-decoration-none hover-text-light">Trust Policy</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6 class="fw-bold text-uppercase small tracking-wider mb-3">Contact Info</h6>
                            <ul class="list-unstyled small lh-lg text-secondary">
                                <li>Ngongona, Dodoma - Tanzania</li>
                                <li>+255 689 045 666</li>
                                <li>francis@hesmb.com</li>
                            </ul>
                            <h6 class="fw-bold text-uppercase small tracking-wider mb-3 mt-4">Payment Methods</h6>
                            <div class="d-flex gap-2">
                                <span class="badge bg-secondary">Stripe</span>
                                <span class="badge bg-secondary">PayPal</span>
                                <span class="badge bg-secondary">Mock</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top border-secondary py-3">
                    <div class="container text-center text-secondary small">
                        &copy; {{ date('Y') }} SmartTrade Africa Ltd. All rights reserved. Powered by <span class="fw-semibold">HESMB</span>
                    </div>
                </div>
            </footer>
        </div>

        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
            @if(session('success'))
                <div class="toast show align-items-center text-bg-success border-0" role="alert" data-bs-delay="4000">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('success') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="toast show align-items-center text-bg-danger border-0" role="alert" data-bs-delay="4000">
                    <div class="d-flex">
                        <div class="toast-body">{{ session('error') }}</div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            @endif
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            document.querySelectorAll('.toast').forEach(el => {
                const toast = new bootstrap.Toast(el);
                toast.show();
            });
        </script>
        @stack('scripts')
    </body>
</html>
