@extends('layouts.app')
@section('title', 'Home')
<style>
    /* =========================
   Suggestion Box
========================= */
    .suggestion-box {
        background-color: #FFFFFF;
        border-radius: 20px;
        padding: 10px 9px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
    }

    /* タイトルと See all を横並びにするコンテナ */
    .suggestion-title-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
    }

    /* Suggestion For You（文字薄ピンク・♡水色） */
    .suggestion-title-text {
        display: flex;
        text-decoration: underline !important;
        align-items: center;
        gap: 4px;
        margin-left: 6px;
        /* 左のハートと文字の間 */
        margin-right: 6px;
        /* ハートと文字の間 */
        color: #F08FB3;
        font-size: 0.95rem;
        white-space: nowrap;
        /* 一列に */
        margin: 0;
    }

    /* See all（文字薄ピンク・♡水色） */
    .see-all-container {
        display: flex;
        align-items: center;
        gap: 4px;
        /* ハートと文字の間 */
    }

    .see-all-text {
        color: #F08FB3;
        font-size: 0.85rem;
        text-decoration: underline !important;
    }

    .see-all-text:hover {
        color: #E46A9A;
    }

    /* ハート（水色） */
    .suggestion-heart {
        width: 14px;
        height: 14px;
        fill: #BFEAF2;
    }

    /* suggestion item */
    .suggestion-item {
        padding: 8px 6px;
        border-radius: 14px;
        transition: background-color 0.2s ease;
    }

    .suggestion-item:hover {
        background-color: #FBEFEF;
    }

    /* Follow ボタン（水色・ボタン風） */
    .follow-btn {
        background-color: #DFF4F8;
        color: #4B8FA1;
        border: none;
        border-radius: 20px;
        padding: 4px 14px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .follow-btn:hover {
        background-color: #C9ECF3;
    }

    .text-pink {
        color: #F08FB3;
        /* 薄いピンク */
    }

    /* Add Story ボタン専用スタイル */
    .add-story-btn {
        background-color: #BFEAF2 !important;
        /* 少しはっきりした水色 */
        color: #F08FB3 !important;
        /* 文字をピンクに */
        border: none !important;
        border-radius: 20px;
        padding: 6px 20px;
        font-weight: 600;
        text-decoration: none !important;
        /* 下線を消す */
        display: inline-block;
    }

    /* ホバー（マウスを乗せた時）の設定 */
    .add-story-btn:hover {
        background-color: #C9ECF3 !important;
        /* ホバー時に少し濃い水色 */
        color: #E46A9A !important;
        /* ホバー時に少し濃いピンク */
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        /* 軽く影をつけてボタンらしく */
    }
</style>
@section('content')
    <div class="row">
        <a href="{{ route('stories.create') }}" class="btn add-story-btn">♡Add Story♡</a>
    </div>
    {{-- stories --}}
    <div class="story-bar d-flex overflow-auto p-2">
        @foreach ($home_stories as $story)
            <a href="{{ route('stories.show', $story->id) }}"
                class="story-item text-center mx-2 text-decoration-none text-dark"> <img src="{{ $story->user->avatar }}"
                    class="rounded-circle" width="70" height="70">
                <p class="small">{{ $story->user->name }}</p>
            </a>
        @endforeach
    </div>
    {{-- main --}}
    <div class="row gx-5">
        <div class="col-8">
            @forelse ($home_posts as $post)
                <div class="card mb-4">
                    @include('users.posts.contents.title')
                    @include('users.posts.contents.body')
                </div>
            @empty
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-secondary">When you share photos, they'll appear on your profile.</p>
                    <a href="#" class="text-decoration-none">Share your first photo</a>
                </div>
            @endforelse
        </div>
        <div class="col-4">
            {{-- Profile Overview --}}
            <div class="row align-items-center mb-5 bg-white shadow-sm rounded-3 py-3">
                <div class="col-auto">
                    <a href="{{ route('profile.show', Auth::user()->id) }}">
                        @if (Auth::user()->avatar)
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"
                                class="rounded-circle avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user text-pink icom-sm"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-0">
                    <a href="{{ route('profile.show', Auth::user()->id) }}"
                        class="text-decoration-none text-dark fw-bold">{{ Auth::user()->name }}</a>
                    <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
                </div>
            </div>
            {{-- Suggestions --}}
            @if ($suggested_users)
                <div class="suggestion-box">
                    {{-- タイトル行 --}}
                    <div class="row suggestion-title-container" style="margin-bottom:16px;">
                        <div class="col-12">
                        {{-- 左: Suggestion For You --}}
                        <p class="suggestion-title-text text-decoration-none">
                            <svg class="suggestion-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path
                                    d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z" />
                            </svg>
                            Suggestion For You
                            <svg class="suggestion-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path
                                    d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z" />
                            </svg>
                        </p>
                        {{-- 右: See all --}}
                        <a href="#" class="see-all-text d-flex align-items-center text-decoration-none"
                            style="gap:4px; white-space: nowrap;">
                            <svg class="suggestion-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path
                                    d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z" />
                            </svg>
                            See all
                            <svg class="suggestion-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                                <path
                                    d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z" />
                            </svg>
                        </a>
                        </div>
                    </div>
                    {{-- ユーザーリスト --}}
                    @foreach ($suggested_users as $user)
                        <div class="row align-items-center suggestion-item">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $user->id) }}">
                                    @if ($user->avatar)
                                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                            class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-pink icom-sm"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0 text-truncate">
                                <a href="{{ route('profile.show', $user->id) }}"
                                    class="text-decoration-none text-dark fw-bold">{{ $user->name }}</a>
                            </div>
                            <div class="col-auto">
                                <form action="{{ route('follow.store', $user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="follow-btn">Follow</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
        </div>
        @endif
    </div>
    </div>
@endsection
