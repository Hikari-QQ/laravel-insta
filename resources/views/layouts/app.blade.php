<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        :root {
            --piki-gray-main: #6f6f6f;
            --piki-gray-soft: #9a9a9a;
            --piki-gray-light: #bdbdbd;

            --piki-bg-pink: #FBEFEF;
            --piki-bg-header: #FFD1E0;
            --piki-bg-blue: #AEDEFC;
            --piki-bg-purple: #E5D9F2;
            --piki-item-blue: #C2E2FA;
            --piki-icon-purple: #C8A2FF;
            --piki-logo-cloud: #DFF4F8;
        }

        body {
            font-family: 'M PLUS Rounded 1c', sans-serif;
            color: var(--piki-gray-main);
            letter-spacing: 0.04em;
            line-height: 1.8;
            background-color: var(--piki-bg-pink);
            padding-top: 80px;
        }

        body.background-random {
            position: relative;
            overflow-x: hidden;
        }

        .animated-item {
            position: fixed;
            top: 100vh;
            background-size: contain;
            background-repeat: no-repeat;
            animation: float var(--duration) linear infinite;
            opacity: 0.8;
            pointer-events: none;
            z-index: -1;
        }

        .container main .col-9 {
            position: relative;
            z-index: 10;
        }

        h1, h2, h3, .navbar-brand, .fw-bold {
            color: #5f5f5f;
            font-weight: 500;
            letter-spacing: 0.08em;
        }

        .text-muted, .xsmall {
            color: var(--piki-gray-soft) !important;
            font-size: 0.8rem;
        }

        a {
            color: #7a7a7a;
            text-decoration: none;
        }

        a:hover {
            color: #9c9c9c;
        }

        .badge {
            background-color: #CDE7F8 !important;
            color: #4A4A4A;
            font-weight: 400;
            border-radius: 999px;
            padding: 6px 12px;
        }

        button, .btn {
            color: #6f6f6f;
        }

        .btn-outline-secondary {
            border-color: #d6d6d6;
            color: #7a7a7a;
        }

        .btn-outline-secondary:hover {
            background-color: var(--piki-bg-purple);
            border-color: var(--piki-bg-purple);
        }

        .navbar form input[type="search"] {
            background-color: #F0F8FF;
            border: 1px solid #d6d6d6;
            color: #5f5f5f;
        }

        .nav-item a.nav-link i,
        .nav-item button.nav-link i {
            color: var(--piki-icon-purple) !important;
            font-size: 1.3rem; 
            width: 24px;
            text-align: center;
        }

        .nav-item a.nav-link i.fa-circle-plus {
            background-color: #F0F0F0;
            border-radius: 50%;
            padding: 4px;
            font-size: 1.1rem;
        }

        .nav-item a.nav-link i.fa-circle-plus:hover {
            background-color: #E0E0E0;
        }

        .navbar {
            background-color: var(--piki-bg-header);
            transition: background-color 0.3s ease;
        }

        .navbar .navbar-brand h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            padding: 0.5rem 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            color: var(--piki-gray-main);
        }

        .add-story-link {
            color: var(--piki-icon-purple) !important;
            font-weight: bold;
            font-size: 0.9rem;
        }

        .story-heart {
            color: var(--piki-logo-cloud);
            font-weight: bold;
        }

        .heart {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'%3E%3Cpath fill='%23C2E2FA' d='M442.9 144C415.6 144 389.9 157.1 373.9 179.2L339.5 226.8C335 233 327.8 236.7 320.1 236.7C312.4 236.7 305.2 233 300.7 226.8L266.3 179.2C250.3 157.1 224.6 144 197.3 144C150.3 144 112.2 182.1 112.2 229.1C112.2 279 144.2 327.5 180.3 371.4C221.4 421.4 271.7 465.4 306.2 491.7C309.4 494.1 314.1 495.9 320.2 495.9C326.3 495.9 331 494.1 334.2 491.7C368.7 465.4 419 421.3 460.1 371.4C496.3 327.5 528.2 279 528.2 229.1C528.2 182.1 490.1 144 443.1 144z'/%3E%3C/svg%3E");
        }

        .cloud {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'%3E%3Cpath fill='%23E5D9F2' d='M112 256C112 167.6 183.6 96 272 96C319.1 96 361.4 116.4 390.7 148.7C401.3 145.6 412.5 144 424 144C490.3 144 544 197.7 544 264C544 277.2 541.9 289.9 537.9 301.8C579.5 322.9 608 366.1 608 416C608 486.7 550.7 544 480 544L176 544C96.5 544 32 479.5 32 400C32 343.2 64.9 294.1 112.7 270.6C112.3 265.8 112 260.9 112 256z'/%3E%3C/svg%3E");
        }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg) scale(0.8); opacity: 0.8; }
            50% { opacity: 1; }
            100% { transform: translateY(-100vh) rotate(360deg) scale(1.2); opacity: 0; }
        }
    </style>
</head>

<body class="background-random">
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1 class="mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" style="width:24px; height:24px; fill:var(--piki-logo-cloud); margin-right:8px;">
                            <path d="M112 256C112 167.6 183.6 96 272 96C319.1 96 361.4 116.4 390.7 148.7C401.3 145.6 412.5 144 424 144C490.3 144 544 197.7 544 264C544 277.2 541.9 289.9 537.9 301.8C579.5 322.9 608 366.1 608 416C608 486.7 550.7 544 480 544L176 544C96.5 544 32 479.5 32 400C32 343.2 64.9 294.1 112.7 270.6C112.3 265.8 112 260.9 112 256z" />
                        </svg>
                        <span style="color:var(--piki-icon-purple); font-weight:500; font-size: 1.4rem;">{{ config('app.name') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" style="width:24px; height:24px; fill:var(--piki-logo-cloud); margin-left:8px;">
                            <path d="M112 256C112 167.6 183.6 96 272 96C319.1 96 361.4 116.4 390.7 148.7C401.3 145.6 412.5 144 424 144C490.3 144 544 197.7 544 264C544 277.2 541.9 289.9 537.9 301.8C579.5 322.9 608 366.1 608 416C608 486.7 550.7 544 480 544L176 544C96.5 544 32 479.5 32 400C32 343.2 64.9 294.1 112.7 270.6C112.3 265.8 112 260.9 112 256z" />
                        </svg>
                    </h1>
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item mx-1">
                                <a href="{{ route('index') }}" class="nav-link">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>

                            <li class="nav-item" title="Create Post">
                                <a href="{{ route('post.create') }}" class="nav-link">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('stories.create') }}" class="nav-link add-story-link">
                                    <span class="story-heart">♡</span>Add Story<span class="story-heart">♡</span>
                                </a>
                            </li>

                            @if (!request()->is('admin/*'))
                                <li class="nav-item" title="Search" id="search-li">
                                    <button type="button" class="nav-link" id="search-icon-link">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                    <div id="search-input-container">
                                        <form action="{{ route('search') }}" method="get">
                                            <input type="search" name="search" placeholder="Search user..." class="form-control form-control-sm">
                                        </form>
                                    </div>
                                </li>
                            @endif

                            @php
                                $translationService = app(\App\Services\DeepLTranslationService::class);
                                $locales = $translationService->getTargetLanguages();
                                $currentLocale = Session::get('locale', 'en'); 
                            @endphp

                            <li class="nav-item dropdown" title="Languages">
                                <button type="button" id="languageDropdown" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="background: none; border: none;">
                                    <i class="fa-solid fa-earth-americas"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown" style="max-height: 70vh; overflow-y: auto;">
                                    @foreach($locales as $code => $name)
                                        @php
                                            $linkCode = strtolower($code);
                                            $isActive = (strtoupper($currentLocale) === $code);
                                        @endphp
                                        <li>
                                            <a href="{{ route('locale.set', $linkCode) }}" class="dropdown-item {{ $isActive ? 'active' : '' }}">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="nav-item dropdown">
                                <button class="btn shadow-none nav-link" data-bs-toggle="dropdown">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" class="rounded-circle avatar-sm" style="width:30px; height:30px; object-fit:cover;">
                                    @else
                                        <i class="fa-solid fa-circle-user" style="color: #ff85a2;"></i>
                                    @endif
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    @can('admin')
                                        <a href="{{ route('admin.users') }}" class="dropdown-item"><i class="fa-solid fa-user-gear"></i> Admin</a>
                                        <hr class="dropdown-divider">
                                    @endcan
                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="dropdown-item"><i class="fa-solid fa-circle-user"></i> Profile</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container">
                <div class="row justify-content-center">
                    @if (request()->is('admin/*'))
                        <div class="col-3">
                            <div class="list-group">
                                <a href="{{ route('admin.users') }}" class="list-group-item">Users</a>
                                <a href="{{ route('admin.posts') }}" class="list-group-item">Posts</a>
                                <a href="{{ route('admin.categories') }}" class="list-group-item">Categories</a>
                            </div>
                        </div>
                    @endif
                    <div class="col-9">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const itemCount = 20;
            const itemClasses = ['heart', 'cloud'];
            const minDuration = 6;
            const maxDuration = 12;
            const minSize = 40;
            const maxSize = 80;

            for (let i = 0; i < itemCount; i++) {
                const item = document.createElement("div");
                item.classList.add("animated-item", itemClasses[Math.floor(Math.random() * itemClasses.length)]);
                item.style.left = Math.random() * 100 + "vw";
                item.style.setProperty('--duration', (minDuration + Math.random() * (maxDuration - minDuration)) + "s");
                const size = minSize + Math.random() * (maxSize - minSize);
                item.style.width = size + "px";
                item.style.height = size + "px";
                item.style.animationDelay = Math.random() * maxDuration + "s";
                document.body.appendChild(item);
            }

            const searchIconLink = document.getElementById('search-icon-link');
            const searchInputContainer = document.getElementById('search-input-container');

            if (searchIconLink && searchInputContainer) {
                searchIconLink.addEventListener('click', function (e) {
                    e.stopPropagation(); 
                    searchInputContainer.classList.toggle('search-active');
                    if (searchInputContainer.classList.contains('search-active')) {
                        searchInputContainer.querySelector('input').focus();
                    }
                });
                searchInputContainer.addEventListener('click', function (e) { e.stopPropagation(); });
                document.addEventListener('click', function () {
                    searchInputContainer.classList.remove('search-active');
                });
            }
        });
    </script>
</body>
</html>