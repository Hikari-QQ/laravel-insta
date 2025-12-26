@extends('layouts.app')

@section('title', 'Followers')

@section('content')
<style>
    /* 全体背景 */
    body, #app, main {
        background-color: #FBEFEF !important;
    }

    /* タイトル装飾：下線なし・水色ハート */
    .suggestion-title-text {
        color: #F08FB3; /* ピンクの文字 */
        font-weight: bold;
        text-decoration: none !important; /* 下線を消去 */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        margin-bottom: 25px;
        font-size: 1.5rem;
    }

    /* ハートの色：水色 */
    .icon-blue-light {
        color: #BFEAF2;
    }

    /* リストを包む四角いカード */
    .follow-list-card-square {
        background: #ffffff;
        border-radius: 8px; 
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border: 1px solid #eee;
    }

    /* 各ユーザー行 */
    .follow-item {
        transition: all 0.2s ease;
        border-radius: 4px;
        padding: 10px;
    }
    .follow-item:hover {
        background-color: #FBEFEF;
    }

    /* フォローボタン（水色背景 × 黒文字 #37353E × 四角） */
    .btn-follow-square {
        background-color: #DFF4F8 !important; 
        color: #37353E !important;           
        border: none !important;
        border-radius: 4px !important;       
        font-weight: bold;
        font-size: 0.75rem;
        padding: 5px 15px !important;
        transition: all 0.3s;
    }

    /* 解除ボタン（Following表示） */
    .btn-following-square {
        background-color: #f8f9fa !important;
        color: #adb5bd !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 4px !important;
        font-weight: bold;
        font-size: 0.75rem;
        padding: 5px 15px !important;
    }

    /* デフォルトアイコンの色（ピンク） */
    .text-pink {
        color: #F08FB3;
    }
</style>

@include('users.profile.header')

<div class="container" style="margin-top: 60px">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            {{-- タイトル：水色のハート --}}
            <div class="suggestion-title-text">
                <i class="fa-solid fa-heart icon-blue-light"></i>
                Followers
                <i class="fa-solid fa-heart icon-blue-light"></i>
            </div>

            <div class="follow-list-card-square">
                @forelse ($user->followers as $follow)
                    <div class="row align-items-center mb-2 follow-item">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $follow->follower->id) }}">
                                @if ($follow->follower->avatar)
                                    <img src="{{ $follow->follower->avatar }}" class="rounded-circle" width="45" height="45" style="object-fit: cover;">
                                @else
                                    <i class="fa-solid fa-circle-user text-pink" style="font-size: 45px;"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-2 text-truncate">
                            <a href="{{ route('profile.show', $follow->follower->id) }}" class="text-decoration-none text-dark fw-bold" style="font-size: 0.9rem;">
                                {{ $follow->follower->name }}
                            </a>
                        </div>
                        <div class="col-auto text-end">
                            @if(Auth::id() !== $follow->follower->id)
                                @if ($follow->follower->isFollowed())
                                    <form action="{{ route('follow.destroy', $follow->follower->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-following-square">Following</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', $follow->follower->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-follow-square">Follow</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted mb-0 py-3">@translate('No followers yet.')</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection