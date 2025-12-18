@extends('layouts.app')

@section('title', 'Story Home')

@section('content')

    <div class="story-page bg-transparent text-dark d-flex justify-content-center align-items-center" style="height:100vh;">

        @if (Auth::user()->id === $story->user->id)
            <div>
                <button class="text-danger btn" data-bs-toggle="modal" data-bs-target="#delete-story-{{ $story->id }}">
                    <i class="fa-regular fa-trash-can"></i>
                </button>
            </div>
        @endif

        <div class="text-center">
            <img id="story-image" src="{{ $story->story_image }}" class="img-fluid rounded" style="height:75vh;">

            <p class="mt-2">{{ $story->user->name }}</p>
        </div>
    </div>

    @include('users.stories.modals.delete')

    <script>
        const nextStoryUrl = @json($nextStory ? route('stories.show', $nextStory->id) : route('index'));

        // 10秒後に次へ
        setTimeout(() => {
            window.location.href = nextStoryUrl;
        }, 10000);

        // 'click' を 'dblclick' に変更
        document.addEventListener('dblclick', (e) => {
            if (e.clientX > window.innerWidth / 2) {
                // 画面の右側をダブルクリック
                window.location.href = nextStoryUrl;
            } else {
                // 画面の左側をダブルクリック
                history.back();
            }
        });
    </script>

@endsection
