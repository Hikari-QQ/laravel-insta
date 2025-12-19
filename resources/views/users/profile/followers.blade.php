@extends('layouts.app')

@section('title', $user->name)

@section('content')

<style>
    /* タイトルの装飾 */
.follower-title {
    color: #F08FB3;
    font-weight: bold;
    margin-bottom: 30px;
    text-shadow: 1px 1px 0px #fff;
}

/* フォロワーリストを包む白いカード */
.follower-list-card {
    background: rgba(255, 255, 255, 0.8); /* 少し透ける白 */
    border-radius: 30px;
    padding: 30px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    border: 2px solid #FBEFEF;
}

/* 各ユーザー行のホバー効果 */
.follower-item {
    transition: all 0.2s ease;
    border-radius: 20px;
    padding: 10px;
}
.follower-item:hover {
    background-color: #FFF9FA;
}

/* アバターのリング装飾 */
.avatar-ring {
    padding: 3px;
    background: linear-gradient(45deg, #f983ff, #66fff5);
    border-radius: 50%;
    display: inline-block;
}

/* フォローボタン（水色） */
.btn-follow-cute {
    background-color: #BFEAF2 !important;
    color: #4B8FA1 !important;
    border: none !important;
    border-radius: 50px !important;
    font-weight: bold;
    font-size: 0.8rem;
    padding: 5px 15px !important;
    box-shadow: 0 4px 10px rgba(191, 234, 242, 0.4);
}

/* フォロー中ボタン（グレー/白） */
.btn-following-cute {
    background-color: #f8f9fa !important;
    color: #adb5bd !important;
    border: 1px solid #dee2e6 !important;
    border-radius: 50px !important;
    font-weight: bold;
    font-size: 0.8rem;
    padding: 5px 15px !important;
}
</style>
    
    @include('users.profile.header')

    <div class="container" style="margin-top: 60px">
        @if ($user->followers->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <h3 class="text-center follower-title">
                        <i class="fa-solid fa-heart me-2"></i>Followers
                    </h3>
                    
                    <div class="follower-list-card">
                        @foreach ($user->followers as $follow)
                            <div class="row align-items-center mb-3 follower-item">
                                {{-- 左：アバター --}}
                                <div class="col-auto">
                                    <a href="{{ route('profile.show', $follow->follower->id) }}" class="avatar-ring">
                                        @if ($follow->follower->avatar)
                                            <img src="{{ $follow->follower->avatar }}" alt="{{ $follow->follower->name }}"
                                                class="rounded-circle avatar-md border border-white border-2">
                                        @else
                                            <i class="fa-solid fa-circle-user text-pink icon-md bg-white rounded-circle"></i>
                                        @endif
                                    </a>
                                </div>

                                {{-- 中央：ユーザー名 --}}
                                <div class="col ps-2 text-truncate">
                                    <a href="{{ route('profile.show', $follow->follower->id) }}"
                                        class="text-decoration-none text-dark fw-bold" style="font-size: 0.95rem;">
                                        {{ $follow->follower->name }}
                                    </a>
                                </div>

                                {{-- 右：ボタン --}}
                                <div class="col-auto text-end">
                                    @if(Auth::user()->id !== $follow->follower->id)
                                        @if ($follow->follower->isFollowed())
                                            <form action="{{ route('follow.destroy', $follow->follower->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-following-cute">Following</button>
                                            </form>
                                        @else
                                            <form action="{{ route('follow.store', $follow->follower->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-follow-cute">Follow</button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="text-center" style="margin-top: 100px;">
                <h3 class="follower-title">☁️ No Followers Yet ☁️</h3>
            </div>
        @endif
    </div>
@endsection