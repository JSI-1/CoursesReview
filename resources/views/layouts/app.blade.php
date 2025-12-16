@php
    $locale = app()->getLocale();
    $isRTL = $locale === 'ar';
    $dir = $isRTL ? 'rtl' : 'ltr';
@endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $dir }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('messages.app_name'))</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    @if($isRTL)
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    @else
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @endif

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: {{ $isRTL ? "'Cairo', sans-serif" : "'Figtree', sans-serif" }};
        }
        [dir="rtl"] {
            direction: rtl;
            text-align: right;
        }
        [dir="ltr"] {
            direction: ltr;
            text-align: left;
        }
    </style>
</head>
<body class="font-sans antialiased d-flex flex-column min-vh-100" dir="{{ $dir }}">
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('courses.index') }}">
                {{ __('messages.app_name') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav {{ $isRTL ? 'ms-auto' : 'me-auto' }}">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.index') }}">{{ __('messages.courses') }}</a>
                    </li>
                </ul>
                <ul class="navbar-nav align-items-center">
                    <!-- Language Switcher -->
                    <li class="nav-item {{ $isRTL ? 'ms-2' : 'me-2' }}">
                        <div class="dropdown">
                            <button class="btn btn-link nav-link p-2 text-white" type="button" id="languageDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>{{ $locale === 'ar' ? '🇸🇦' : 'EN' }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                                <li>
                                    <a class="dropdown-item {{ $locale === 'en' ? 'active' : '' }}" href="{{ route('language.switch', 'en') }}">
                                        {{ __('messages.english') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ $locale === 'ar' ? 'active' : '' }}" href="{{ route('language.switch', 'ar') }}">
                                        {{ __('messages.arabic') }}
                                    </a>
                    </li>
                </ul>
                        </div>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu {{ $isRTL ? 'dropdown-menu-start' : 'dropdown-menu-end' }}">
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">{{ __('messages.logout') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('messages.login') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('messages.register') }}</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4 flex-grow-1">
        <div class="container">
            @include('components.flash-messages')
            <div class="content-wrapper">
                @yield('content')
            </div>
        </div>
    </main>

    <footer class="bg-light text-dark py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} {{ __('messages.app_name') }}. {{ $isRTL ? 'جميع الحقوق محفوظة' : 'All rights reserved' }}.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
