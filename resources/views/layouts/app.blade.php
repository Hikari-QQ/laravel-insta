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


        h1,
        h2,
        h3,
        .navbar-brand,
        .fw-bold {
            color: #5f5f5f;
            font-weight: 500;
            letter-spacing: 0.08em;
        }

        .text-muted,
        .xsmall {
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

        button,
        .btn {
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
            0% {
                transform: translateY(0) rotate(0deg) scale(0.8);
                opacity: 0.8;
            }

            50% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg) scale(1.2);
                opacity: 0;
            }
        }

        /* + メニュー */
        .create-menu {
            position: absolute;
            top: 45px;
            right: 0;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 6px 0;
            min-width: 120px;
            display: none;
            z-index: 1000;
        }

        /* 表示用 */
        .create-menu.show {
            display: block;
        }

        /* 中の項目 */
        .create-item {
            display: block;
            padding: 8px 16px;
            font-size: 0.9rem;
            color: #7a7a7a;
            text-align: center;
            transition: background-color 0.2s, color 0.2s;
        }

        .create-item:hover {
            background-color: #FBEFEF;
            color: #F08FB3;
        }

        /* Post/Story と同じ hover デザイン */
        /* Search メニュー全体の hover + input focus で文字色をピンク */
        /* Search メニュー内のホバー設定 */
        #search-menu:hover {
            background-color: #FBEFEF;
        }

        /* ホバーした時に中の文字とプレースホルダーをピンクにする */
        #search-menu:hover input,
        #search-menu:hover input::placeholder {
            color: #F08FB3 !important;
        }

        /* 通常時のinput設定（背景を透明にしてメニュー側の背景を見せる） */
        #search-menu input {
            background: transparent;
            border: none;
            padding: 8px 16px;
            width: 100%;
            outline: none;
            color: #5f5f5f;
            transition: color 0.2s;
        }

        /* メニュー全体の共通デザイン（浮いている感じ） */
        .create-menu {
            position: absolute;
            top: 50px;
            /* 位置の微調整 */
            right: 0;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 8px 0;
            min-width: 150px;
            display: none;
            z-index: 1000;
        }

        /* 表示された時のクラス */
        .create-menu.show {
            display: block;
        }

        /* 各項目のデザイン */
        .create-item {
            display: block;
            padding: 10px 20px;
            font-size: 0.9rem;
            color: #7a7a7a;
            text-align: left;
            /* 左揃えが見やすいです */
            text-decoration: none;
            transition: all 0.2s ease;
        }

        /* 【重要】触った時（ホバー）の設定 */
        .create-item:hover {
            background-color: #FBEFEF;
            /* 薄いピンク背景 */
            color: #F08FB3 !important;
            /* かわいいピンク文字 */
        }

        /* アイコンも一緒にピンクにする */
        .create-item:hover i {
            color: #F08FB3 !important;
        }

        /* ナビゲーションアイコンの共通ホバー設定 */
        .navbar-nav .nav-item .nav-link i {
            transition: all 0.3s ease;
            /* 動きをなめらかにする */
            display: inline-block;
            /* 浮き上がる動きを有効にするために必要 */
        }

        .navbar-nav .nav-item .nav-link:hover i {
            transform: translateY(-4px);
            /* 4px分、上に浮き上がる */
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            /* アイコンの下にふわっとした影をつける */
            color: #ffb3c6 !important;
            /* ホバー時に少しピンクっぽく光らせる（お好みで） */
        }

        /* プラスボタン（fa-circle-plus）専用の調整 */
        .nav-item a.nav-link i.fa-circle-plus:hover {
            background-color: #E0E0E0;
            transform: translateY(-4px) scale(1.05);
            /* 少し大きくしながら浮かす */
        }
        /* ナビ右上のプロフィール写真もホバーで浮かす */
#user-toggle img {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

#user-toggle:hover img {
    transform: translateY(-4px);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

    </style>
</head>

<body class="background-random">
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h1 class="mb-0 d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                            style="width:24px; height:24px; fill:var(--piki-logo-cloud); margin-right:8px;">
                            <path
                                d="M112 256C112 167.6 183.6 96 272 96C319.1 96 361.4 116.4 390.7 148.7C401.3 145.6 412.5 144 424 144C490.3 144 544 197.7 544 264C544 277.2 541.9 289.9 537.9 301.8C579.5 322.9 608 366.1 608 416C608 486.7 550.7 544 480 544L176 544C96.5 544 32 479.5 32 400C32 343.2 64.9 294.1 112.7 270.6C112.3 265.8 112 260.9 112 256z" />
                        </svg>
                        <span
                            style="color:var(--piki-icon-purple); font-weight:500; font-size: 1.4rem;">{{ config('app.name') }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"
                            style="width:24px; height:24px; fill:var(--piki-logo-cloud); margin-left:8px;">
                            <path
                                d="M112 256C112 167.6 183.6 96 272 96C319.1 96 361.4 116.4 390.7 148.7C401.3 145.6 412.5 144 424 144C490.3 144 544 197.7 544 264C544 277.2 541.9 289.9 537.9 301.8C579.5 322.9 608 366.1 608 416C608 486.7 550.7 544 480 544L176 544C96.5 544 32 479.5 32 400C32 343.2 64.9 294.1 112.7 270.6C112.3 265.8 112 260.9 112 256z" />
                        </svg>
                    </h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('index') }}" class="nav-link">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="nav-item position-relative" title="Create">
                                <button type="button" id="create-toggle" class="nav-link"
                                    style="background:none; border:none;">
                                    <i class="fa-solid fa-circle-plus"></i>
                                </button>

                                <div id="create-menu" class="create-menu">
                                    <a href="{{ route('post.create') }}" class="create-item">Post</a>
                                    <a href="{{ route('stories.create') }}" class="create-item">Story</a>
                                </div>
                            </li>

                            <li class="nav-item" title="DirectMessage">
                                <a href="{{ route('message.show') }}" class="nav-link position-relative">
                                    <i class="fa-regular fa-paper-plane"></i>

                                    <span id="nav-unread-dot"
                                        class="position-absolute translate-middle p-1 rounded-circle {{ isset($global_unread_count) && $global_unread_count > 0 ? '' : 'd-none' }}"
                                        style="background-color: #ff85a2; top: 12px; left: 80%;">
                                        <span class="visually-hidden">New alerts</span>
                                    </span>
                                </a>
                            </li>

                            @if (!request()->is('admin/*'))
                                <li class="nav-item position-relative" title="Search" id="search-li">
                                    <button type="button" class="nav-link" id="search-toggle"
                                        style="background:none; border:none;">
                                        <i class="fa-solid fa-magnifying-glass"></i>
                                    </button>
                                    <div id="search-menu" class="create-menu" style="min-width:180px;">
                                        <form action="{{ route('search') }}" method="get" class="m-0 p-1">
                                            <input type="search" name="search" placeholder="Search user...">
                                        </form>
                                    </div>
                                </li>
                            @endif

                            @php
                                $translationService = app(\App\Services\DeepLTranslationService::class);
                                $locales = $translationService->getTargetLanguages();
                                $currentLocale = Session::get('locale', 'en');
                            @endphp
                            <li class="nav-item position-relative" title="Languages">
                                <button type="button" id="language-toggle" class="nav-link"
                                    style="background:none; border:none;">
                                    <i class="fa-solid fa-earth-americas"></i>
                                </button>
                                <div id="language-menu" class="create-menu" style="max-height: 50vh; overflow-y: auto;">
                                    @foreach ($locales as $code => $name)
                                        <a href="{{ route('locale.set', strtolower($code)) }}" class="create-item">
                                            {{ $name }}
                                        </a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item position-relative">
                                <button type="button" id="user-toggle" class="nav-link"
                                    style="background:none; border:none; display: flex; align-items: center;">
                                    @if (Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar }}" class="rounded-circle"
                                            style="width:30px; height:30px; object-fit:cover;">
                                    @else
                                        <i class="fa-solid fa-circle-user" style="color: var(--piki-icon-purple);"></i>
                                    @endif
                                </button>

                                <div id="user-menu" class="create-menu" style="right: 0;">
                                    @can('admin')
                                        <a href="{{ route('admin.users') }}" class="create-item">
                                            <i class="fa-solid fa-user-gear me-2"></i>Admin
                                        </a>
                                    @endcan

                                    <a href="{{ route('profile.show', Auth::user()->id) }}" class="create-item">
                                        <i class="fa-solid fa-circle-user me-2"></i>Profile
                                    </a>

                                    <a href="{{ route('logout') }}" class="create-item"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>{{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
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
            // 1. 背景のアニメーション（ハートと雲）
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
                item.style.setProperty('--duration', (minDuration + Math.random() * (maxDuration - minDuration)) +
                    "s");
                const size = minSize + Math.random() * (maxSize - minSize);
                item.style.width = size + "px";
                item.style.height = size + "px";
                item.style.animationDelay = Math.random() * maxDuration + "s";
                document.body.appendChild(item);
            }

            // 2. メニュー開閉の共通関数
            function setupToggle(buttonId, menuId) {
                const btn = document.getElementById(buttonId);
                const menu = document.getElementById(menuId);

                if (!btn || !menu) return;

                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    // 他の開いているメニューを全部閉じる
                    document.querySelectorAll('.create-menu').forEach(m => {
                        if (m !== menu) m.classList.remove('show');
                    });
                    // 自分のメニューだけ切り替える
                    menu.classList.toggle('show');

                    // Searchメニューが開いた時は自動で入力欄にフォーカスを当てる
                    if (menuId === 'search-menu' && menu.classList.contains('show')) {
                        const input = menu.querySelector('input');
                        if (input) input.focus();
                    }
                });
            }

            // 3. 各メニューに機能を割り当て
            setupToggle('create-toggle', 'create-menu');
            setupToggle('search-toggle', 'search-menu');
            setupToggle('language-toggle', 'language-menu');
            setupToggle('user-toggle', 'user-menu');

            // 4. 画面のどこかをクリックしたらメニューを閉じる
            document.addEventListener('click', function() {
                document.querySelectorAll('.create-menu').forEach(m => {
                    m.classList.remove('show');
                });
            });

            // 5. メニューの中（入力欄など）をクリックしても閉じないようにする
            document.querySelectorAll('.create-menu').forEach(m => {
                m.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });

        function checkUnreadCount() {
            fetch("{{ route('message.unreadCount') }}")
                .then(res => res.json())
                .then(data => {
                    const dot = document.getElementById('nav-unread-dot');
                    if (!dot) return;

                    if (data.unread_count > 0) {
                        dot.classList.remove('d-none'); // 未読があれば表示
                    } else {
                        dot.classList.add('d-none'); // 未読がなければ隠す
                    }
                })
                .catch(err => console.error("Error fetching unread count:", err));
        }

        // 5秒ごとにチェック（3秒より少し余裕を持たせるとサーバーに優しいです）
        setInterval(checkUnreadCount, 5000);
    </script>

</body>

</html>
