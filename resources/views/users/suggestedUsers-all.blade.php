@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
<style>
    /* 全体を白背景に固定 */
    body, #app, main {
        background-color: #FBEFEF !important;
    }

    /* 検索・おすすめコンテナ：真っ白なカードが浮いているデザイン */
    .search-container {
        background-color: #ffffff;
        border-radius: 30px;
        padding: 40px;
        box-shadow: 0 15px 40px rgba(183, 156, 156, 0.12);
        margin-top: 40px;
    }

    /* ユーザー名：ご指定の #37353E に変更 */
    .user-name {
        color: #37353E;
        font-weight: 700;
        text-decoration: none;
        font-size: 1.1rem;
        transition: color 0.3s;
    }

    .user-name:hover {
        color: #F08FB3; /* ホバー時はテーマカラーのピンクに */
    }

    .avatar-md {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    /* デフォルトのユーザーアイコン */
    .icom-md {
        font-size: 65px;
        color: #F08FB3; /* ピンク */
        opacity: 0.8;
    }

    /* Followボタン：水色ベース × ピンク文字（他のボタンと統一） */
    .btn-follow {
        background-color: #BFEAF2 !important;
        color: #F08FB3 !important;
        border: none !important;
        border-radius: 50px;
        padding: 8px 25px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .btn-follow:hover {
        background-color: #C9ECF3 !important;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(191, 234, 242, 0.4);
    }

    /* タイトル部分 */
    .search-title {
        color: var(--piki-gray-main);
        font-weight: 800;
        letter-spacing: 1px;
        border-bottom: 3px dashed #BFEAF2; /* 水色の点線 */
        display: inline-block;
        padding-bottom: 8px;
    }

    /* リストの区切り線 */
    .user-row {
        border-bottom: 1px solid #f8f1f1;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .user-row:last-child {
        border-bottom: none;
    }
</style>

<div class="row justify-content-center">
    <div class="col-6 search-container shadow-sm">
        <div class="mb-5 text-center">
            <p class="h5 search-title pb-2">
                Suggestion For You
            </p>
        </div>

        @foreach ($suggested_users as $user)
            <div class="row align-items-center mb-4 pb-3 border-bottom border-white">
                <div class="col-auto">
                    <a href="{{ route('profile.show', $user->id) }}">
                        @if ($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar-md">
                        @else
                            <i class="fa-solid fa-circle-user icom-md"></i>
                        @endif
                    </a>
                </div>
                <div class="col ps-3 text-truncate">
                    <a href="{{ route('profile.show', $user->id) }}" class="user-name">{{ $user->name }}</a>
                </div>
                <div class="col-auto">
                    <form action="{{ route('follow.store', $user->id) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-follow btn-sm fw-bold shadow-sm">Follow</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection