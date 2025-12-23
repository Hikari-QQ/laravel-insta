@extends('layouts.app')

@section('title', 'Show')

@section('content')
    <style>
        .show-card {
            background-color: #fff;
            border-radius: 15px;
            overflow: hidden;
        }

        .avatar-sm {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-name {
            color: #C9B3E0;
            font-weight: bold;
            text-decoration: none;
        }

        .user-name:hover {
            color: #b399cc;
        }

        .post-image {
            width: 100%;
            display: block;
            height: auto;
            object-fit: cover;
        }

        .heart-btn i {
            color: #ff85a2;
            font-size: 1.2rem;
        }

        .heart-btn:hover i {
            transform: scale(1.2);
            transition: transform 0.2s;
        }

        .like-count {
            font-weight: 500;
            vertical-align: middle;
            color: #6f6f6f;
        }

        .badge.rounded-pill {
            border-radius: 50px !important;
            font-size: 0.75rem;
            padding: 5px 12px;
        }

        .comment-input {
            background-color: #DFF4F8;
            border: none;
            border-radius: 15px;
            padding: 8px 45px 8px 15px;
            color: #5f5f5f;
        }

        .comment-input::placeholder {
            color: #ff85a2;
            opacity: 0.7;
        }

        .comment-input:focus {
            box-shadow: none;
            background-color: #d2f0f5;
        }

        .comment-send-btn i {
            color: #C8A2FF;
            font-size: 1.1rem;
        }

        .scroll-area {
            max-height: 600px;
            overflow-y: auto;
        }

        .scroll-area::-webkit-scrollbar {
            width: 5px;
        }

        .scroll-area::-webkit-scrollbar-thumb {
            background: #E5D9F2;
            border-radius: 10px;
        }

        .piki-dropdown-menu {
            background-color: #ffffff !important;
            border-radius: 14px !important;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
            border: none !important;
            padding: 8px 0 !important;
            min-width: 120px !important;
        }

        .piki-dropdown-item {
            display: block;
            width: 100%;
            padding: 10px 20px;
            font-size: 0.9rem;
            color: #7a7a7a !important;
            text-align: left;
            text-decoration: none;
            background: none;
            border: none;
            transition: all 0.2s ease;
        }

        .piki-dropdown-item:hover {
            background-color: #FBEFEF !important;
            color: #F08FB3 !important;
        }

        .piki-dropdown-item:hover i {
            color: #F08FB3 !important;
        }
    </style>

    <div class="row show-card shadow-sm mx-auto">
        <div class="col-lg-8 p-0 border-end bg-light d-flex align-items-center">
            <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="post-image">
        </div>

        <div class="col-lg-4 d-flex flex-column bg-white p-0">
            <div class="p-3 border-bottom">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <a href="{{ route('profile.show', $post->user->id) }}">
                            @if ($post->user->avatar)
                                <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary fa-2x"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0">
                        <a href="{{ route('profile.show', $post->user->id) }}" class="user-name">{{ $post->user->name }}</a>
                    </div>
                    <div class="col-auto">
                        @if (Auth::user()->id === $post->user->id)
                            <div class="dropdown">
                                <button class="btn btn-sm shadow-none border-0 p-0" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis" style="color: #bdbdbd; font-size: 1.2rem;"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end piki-dropdown-menu">
                                    <a href="{{ route('post.edit', $post->id) }}" class="piki-dropdown-item">
                                        <i class="fa-regular fa-pen-to-square me-2"></i>Edit
                                    </a>
                                    <button type="button" class="piki-dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#delete-post-{{ $post->id }}">
                                        <i class="fa-regular fa-trash-can me-2"></i>Delete
                                    </button>
                                </div>
                                @include('users.posts.contents.modals.delete')
                            </div>
                        @else
                            @if ($post->user->isFollowed())
                                <form action="{{ route('follow.destroy', $post->user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm text-secondary fw-bold p-0">Following</button>
                                </form>
                            @else
                                <form action="{{ route('follow.store', $post->user->id) }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-sm text-primary fw-bold p-0">Follow</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex-grow-1 scroll-area p-3">
                <div class="d-flex align-items-center mb-3">
                    <div class="d-flex align-items-center">
                        @livewire('like-button', ['post' => $post], key('like-'.$post->id))
                    </div>
                    <div class="me-3">
                        <span class="like-count">{{ $post->likes->count() }}</span>
                    </div>
                    <div class="ms-auto">
                        @if ($post->categoryPost->count() != 0)
                            @foreach ($post->categoryPost as $category_post)
                                <span class="category-badge me-1">
                                    {{ $category_post->category->name }}
                                </span>
                            @endforeach
                        @else
                            <span class="category-badge">Uncategorized</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <a href="{{ route('profile.show', $post->user->id) }}"
                        class="user-name me-2">{{ $post->user->name }}</a>
                    <span class="fw-light text-dark">{{ $post->description }}</span>
                    <p class="text-uppercase text-muted xsmall mt-1 mb-0">
                        {{ date('M d, Y', strtotime($post->created_at)) }}</p>
                </div>

                <hr class="my-3 opacity-25">

                @if ($post->comments->isNotEmpty())
                    <ul class="list-group list-group-flush">
                        @foreach ($post->comments as $comment)
                            <li class="list-group-item border-0 p-0 mb-3 bg-transparent">
                                <a href="{{ route('profile.show', $comment->user->id) }}"
                                    class="text-decoration-none text-dark fw-bold small">{{ $comment->user->name }}</a>
                                <p class="d-inline fw-light small mb-1"> {{ $comment->body }}</p>
                                <div class="xsmall">
                                    <span class="text-muted">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>
                                    @if (Auth::user()->id === $comment->user->id)
                                        &middot;
                                        <form action="{{ route('comment.destroy', $comment->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                                        </form>
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="p-3 border-top bg-white">
                <form action="{{ route('comment.store', $post->id) }}" method="post">
                    @csrf
                    <div class="position-relative">
                        <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm comment-input"
                            placeholder="Add a comment…♡">{{ old('comment_body' . $post->id) }}</textarea>
                        <button type="submit"
                            class="btn btn-sm comment-send-btn position-absolute top-50 end-0 translate-middle-y pe-3">
                            <i class="fa-regular fa-paper-plane"></i>
                        </button>
                    </div>
                    @error('comment_body' . $post->id)
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </form>
            </div>
        </div>
    </div>
@endsection