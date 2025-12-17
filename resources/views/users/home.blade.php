@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="row">
    <button class="btn btn-primary"
        data-bs-toggle="modal"
        data-bs-target="#create-story-{{ Auth::user()->id }}">
        Add Story
    </button>
</div>

    {{-- stories --}}
    <div class="row mb-3">
    <div class="col text-start">
        <div class="story-bar d-flex overflow-auto p-2">
            @foreach ($home_stories as $story)
                <div class="story-item text-center mx-2">
                    <img src="{{ $story->user->avatar }}" alt="Story" class="rounded-circle" width="70" height="70"
                        data-bs-toggle="modal" data-bs-target="#showStoryModal-{{ $story->id }}">
                    <p class="small">{{ $story->user->name }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>
    {{-- main --}}
    <div class="row gx-5">
        <div class="col-8">
            @forelse ($home_posts as $post)
                <div class="card mb-4">
                    {{-- title --}}
                    @include('users.posts.contents.title')
                    {{-- body --}}
                    @include('users.posts.contents.body')
                </div>
            @empty
                {{-- If the site douesn't have any post yet. --}}
                <div class="text-center">
                    <h2>Share Photos</h2>
                    <p class="text-secondary">When you share photos, they'll aapear on your profile.</p>
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
                            <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
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
          {{-- Suggestions --}}
@if ($suggested_users)
<div class="suggestion-box">
    <div class="row mb-3">
        <div class="col-auto">
            <p class="fw-bold">Suggestion For You</p>
        </div>
        <div class="col text-end">
            <a href="#" class="fw-bold text-decoration-none">See all</a>
        </div>
    </div>

    @foreach ($suggested_users as $user)
        <div class="row align-items-center suggestion-item">

                  
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $user->id) }}">
                                @if ($user->avatar)
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                                        class="rounded-circle avatar-sm">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icom-sm"></i>
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
                                <button type="submit" class="border-0 bg-transparent p-0 text-primary">Follow</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
