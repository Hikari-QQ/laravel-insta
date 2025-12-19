@extends('layouts.app')

@section('title', $user->name)

@section('content')

<style>

/* タイトルの装飾（Following用） */
.following-title {
    color: #F08FB3;
    font-weight: bold;
    margin-bottom: 30px;
    text-shadow: 1px 1px 0px #fff;
}

/* リストを包む白いカード */
.following-list-card {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 30px;
    padding: 30px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    border: 2px solid #FBEFEF;
}

/* 各ユーザー行 */
.following-item {
    transition: all 0.2s ease;
    border-radius: 20px;
    padding: 10px;
}
.following-item:hover {
    background-color: #FFF9FA;
}

/* アバターのリング装飾 */
.avatar-ring {
    padding: 3px;
    background: linear-gradient(45deg, #f983ff, #66fff5);
    border-radius: 50%;
    display: inline-block;
}

/* ボタン：パステルブルー（Follow） */
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

/* ボタン：シンプル（Following） */
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

    {{-- Show all posts --}}
    <div class="container" style="margin-top: 60px">
        @if ($user->following->isNotEmpty())
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <h3 class="text-center following-title">
                        <i class="fa-solid fa-star me-2"></i>Following
                    </h3>
                    
                    <div class="following-list-card">
                        @foreach ($user->following as $follow)
                            <div class="row align-items-center mb-3 following-item">
                                {{-- 左：アバター --}}
                                <div class="col-auto">
                                    <a href="{{ route('profile.show', $follow->following->id) }}" class="avatar-ring">
                                        @if ($follow->following->avatar)
                                            <img src="{{ $follow->following->avatar }}" alt="{{ $follow->following->name }}"
                                                class="rounded-circle avatar-md border border-white border-2">
                                        @else
                                            <i class="fa-solid fa-circle-user text-pink icon-md bg-white rounded-circle"></i>
                                        @endif
                                    </a>
                                </div>

                                {{-- 中央：ユーザー名 --}}
                                <div class="col ps-2 text-truncate">
                                    <a href="{{ route('profile.show', $follow->following->id) }}"
                                        class="text-decoration-none text-dark fw-bold" style="font-size: 0.95rem;">
                                        {{ $follow->following->name }}
                                    </a>
                                </div>

                                {{-- 右：ボタン --}}
                                <div class="col-auto text-end">
                                    @if(Auth::user()->id !== $follow->following->id)
                                        @if ($follow->following->isFollowed())
                                            <form action="{{ route('follow.destroy', $follow->following->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-following-cute">Following</button>
                                            </form>
                                        @else
                                            <form action="{{ route('follow.store', $follow->following->id) }}" method="post">
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
                <h3 class="following-title">☁️ No Following Yet ☁️</h3>
            </div>
        @endif
    </div>
@endsection