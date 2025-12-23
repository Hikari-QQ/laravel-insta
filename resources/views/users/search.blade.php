@extends('layouts.app')

@section('title', 'Explore People')

@section('content')
<style>
    .search-container {
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 20px;
        padding: 30px;
        backdrop-filter: blur(5px);
    }

    .suggestion-heart {
        width: 14px;
        height: 14px;
        fill: #BFEAF2;
    }

    .user-name {
        font-weight: bold;
        text-decoration: none;
        font-size: 1.1rem;
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
       background-color: #DFF4F8 !important; 
       color: #37353E !important;    
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
        color: #F08FB3;
        font-weight: 500;
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

    .user-item {
        padding: 8px 6px;
        border-radius: 14px;
        transition: background-color 0.2s ease;
    }

    .user-item:hover {
        background-color: #FBEFEF;
    }
</style>

<div class="row justify-content-center">
    <div class="col-6 search-container shadow-sm">
        <div class="mb-3 text-center">
            <p class="h5 search-title pb-2">
                <svg class="suggestion-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path
                        d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z" />
                </svg>
                @translate('Search results for') "<span class="search-word fw-bold">{{ $search }}</span>"
                <svg class="suggestion-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640">
                    <path
                        d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z" />
                </svg>
            </p>
        </div>

        @forelse ($users as $user)
            <div class="row align-items-center mb-1 pb-3 border-bottom border-white user-item">
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
                    <a href="{{ route('profile.show', $user->id) }}" class="user-name text-dark">{{ $user->name }}</a>
                    <p class="text-muted mb-0 xsmall">{{ $user->email }}</p>
                </div>
                <div class="col-auto">
                    @if ($user->id !== Auth::user()->id)
                        @if ($user->isFollowed())
                            <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-following btn-sm fw-bold shadow-sm">@translate('Following')</button>
                            </form>
                        @else
                            <form action="{{ route('follow.store', $user->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-follow btn-sm fw-bold shadow-sm">@translate('Follow')</button>
                            </form>
                        @endif
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="fa-solid fa-magnifying-glass mb-3 no-user-icon"></i>
                <p class="lead text-muted">@translate('No users found.')</p>
            </div>
        @endforelse
    </div>
</div>
@endsection