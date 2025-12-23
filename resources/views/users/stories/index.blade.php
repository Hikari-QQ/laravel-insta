@extends('layouts.app')

@section('title', 'Story Home')

@section('content')

<style>
    .story-image-cute {
        height: 75vh;
        object-fit: cover;
        border-radius: 35px;
        border: 8px solid #fff;
        box-shadow: 0 10px 30px rgba(240, 143, 179, 0.4);
        transition: transform 0.3s ease;
    }

    .story-image-cute:hover {
        transform: scale(1.02);
    }

    .user-info-capsule {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(5px);
        padding: 10px 25px 10px 15px;
        border-radius: 50px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        display: inline-flex;
        align-items: center;
        gap: 15px;
    }

    .story-username {
        color: #F08FB3;
        font-weight: 800;
        letter-spacing: 1px;
        margin-bottom: 0;
    }

    .btn-delete-cute {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #FBEFEF;
        color: #E46A9A;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }

    .btn-delete-cute:hover {
        background-color: #E46A9A;
        color: white;
        transform: rotate(15deg);
    }

    .story-avatar-ring {
        padding: 2px;
        background: linear-gradient(45deg, #F08FB3, #BFEAF2);
        border-radius: 50%;
        display: inline-block;
    }
</style>

<div class="story-page text-dark d-flex flex-column justify-content-center align-items-center" style="height:100vh;">

    @if ($story->user->isFollowing(Auth::user()) || $story->user->id === Auth::id())
        <div class="mb-4 text-center">
            <img src="{{ $story->story_image }}" class="img-fluid story-image-cute">
        </div>

        <div class="user-info-capsule">
            <a href="{{ route('profile.show', $story->user->id) }}" class="story-avatar-ring">
                @if ($story->user->avatar)
                    <img src="{{ $story->user->avatar }}" alt="{{ $story->user->name }}"
                         class="rounded-circle border border-2 border-white" width="40" height="40"
                         style="object-fit: cover;">
                @else
                    <i class="fa-solid fa-circle-user text-pink icon-md bg-white rounded-circle"
                       style="font-size: 40px;"></i>
                @endif
            </a>

            <h4 class="story-username">{{ $story->user->name }}</h4>

            @if (Auth::user()->id === $story->user->id)
                <button class="btn btn-delete-cute shadow-sm" data-bs-toggle="modal"
                        data-bs-target="#delete-story-{{ $story->id }}">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            @endif
        </div>
    @endif

</div>

@include('users.stories.modals.delete')

<script>
    const nextStoryUrl = @json($nextStory ? route('stories.show', $nextStory->id) : route('index'));

    @if (!($story->user->isFollowing(Auth::user()) || $story->user->id === Auth::id()))
        window.location.href = nextStoryUrl;
    @endif

    setTimeout(() => {
        window.location.href = nextStoryUrl;
    }, 10000);

    document.addEventListener('dblclick', (e) => {
        if (e.clientX > window.innerWidth / 2) {
            window.location.href = nextStoryUrl;
        } else {
            history.back();
        }
    });
</script>

@endsection