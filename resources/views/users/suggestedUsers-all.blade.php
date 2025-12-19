@extends('layouts.app')

@section('title', 'Suggested Users')

@section('content')
<style>
    .search-container {
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 20px;
        padding: 30px;
        backdrop-filter: blur(5px);
    }

    .user-name {
        color: #C9B3E0;
        font-weight: bold;
        text-decoration: none;
        font-size: 1.1rem;
    }

    .user-name:hover {
        color: #b399cc;
    }

    .avatar-md {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #fff;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    /* デフォルトのユーザーアイコンをピンクに変更 */
    .icom-md {
        font-size: 60px;
        color: #ff85a2; 
        opacity: 0.8;
    }

    /* Followボタン（水色） */
    .btn-follow {
        background-color: var(--piki-bg-blue);
        color: #4A4A4A;
        border: none;
        border-radius: 50px;
        padding: 5px 20px;
        transition: all 0.3s;
    }

    .btn-follow:hover {
        background-color: #9cd4f8;
        transform: translateY(-1px);
    }

    /* Followingボタン（薄い紫） */
    .btn-following {
        background-color: var(--piki-bg-purple);
        color: #6f6f6f;
        border: none;
        border-radius: 50px;
        padding: 5px 20px;
        transition: all 0.3s;
    }

    .btn-following:hover {
        background-color: #d8c8f0;
    }

    .search-title {
        color: var(--piki-gray-main);
        font-weight: 500;
        border-bottom: 2px dashed #FFD1E0;
        display: inline-block;
    }

    .search-word {
        color: #ff85a2;
    }
    
    /* 検索中アイコン（虫眼鏡）もピンクに合わせる場合 */
    .no-user-icon {
        font-size: 3rem;
        color: #ff85a2;
        opacity: 0.5;
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