@extends('layouts.app')

@section('title', 'Show')

@section('content')
<style>
    /* カード全体のスタイル */
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

    /* ユーザー名：ホバーで色変更 */
    .user-name {
        color: #C9B3E0;
        font-weight: bold;
        text-decoration: none;
        transition: color 0.2s ease;
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

    /* いいねボタン */
    .heart-btn i {
        color: #ff85a2;
        font-size: 1.2rem;
    }

    .heart-btn:hover i {
        transform: scale(1.2);
        transition: transform 0.2s;
    }

    /* コメント入力欄 */
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
        outline: none;
    }

    .comment-send-btn i {
        color: #C8A2FF;
        font-size: 1.1rem;
    }

    /* スクロールエリア */
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

    /* --- 追加・修正したピンクホバーのスタイル --- */

    /* ドロップダウンメニュー */
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
    

    /* コメント欄のDeleteボタン専用 */
    .piki-delete-btn {
        border: none;
        background: transparent;
        color: #bdbdbd; /* 初期色はグレー */
        font-size: 0.75rem;
        padding: 0;
        transition: color 0.2s ease;
    }

    .piki-delete-btn:hover {
        color: #F08FB3 !important; /* ホバーでピンク */
    }

    /* 「View all comments」のホバー */
    .view-all-link {
        color: #C9B3E0;
        text-decoration: none;
        transition: color 0.2s ease;
    }
//* コメント入力欄：フォーカス時にドロップダウンと同じ色 */
.comment-input:focus {
    box-shadow: none;
    background-color: #ffffff; /* ドロップダウンと同じ背景色 */
    outline: none;
    border: 1px solid #C9B3E0; /* optional: 少し縁をつける */
}

/* コメント送信ボタンのhover時 */
.comment-send-btn:hover i {
    color: #F08FB3 !important; /* Edit/Deleteと同じ薄いピンク */
    transform: scale(1.1);
    transition: all 0.2s ease;
}

/* コメント入力欄のhover時も薄いピンク */
.comment-input:hover {
    background-color: #FBEFEF; /* 薄いピンクに変化 */
    transition: background-color 0.2s ease;
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
                <div class="ms-auto">
                    @forelse ($post->categoryPost as $category_post)
                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill me-1">
                            {{ $category_post->category->name }}
                        </span>
                    @empty
                        <span class="badge bg-secondary bg-opacity-10 text-secondary rounded-pill">Uncategorized</span>
                    @endforelse
                </div>
            </div>

            <div class="mb-3">
                <a href="{{ route('profile.show', $post->user->id) }}" class="user-name me-2">{{ $post->user->name }}</a>
                <span class="fw-light text-dark">{{ $post->description }}</span>
                <p class="text-uppercase text-muted xsmall mt-1 mb-0">{{ date('M d, Y', strtotime($post->created_at)) }}</p>
            </div>

            <hr class="my-3 opacity-25">

            @if ($post->comments->isNotEmpty())
                <ul class="list-group list-group-flush">
                    @foreach ($post->comments as $comment)
                        <li class="list-group-item border-0 p-0 mb-3 bg-transparent">
                            <a href="{{ route('profile.show', $comment->user->id) }}"
                                class="text-decoration-none text-dark fw-bold small">{{ $comment->user->name }}</a>
                            <p class="d-inline fw-light small mb-1"> {{ $comment->body }}</p>
                            
                            <div class="xsmall d-flex align-items-center">
                                <span class="text-muted">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>
                                
                                @if (Auth::user()->id === $comment->user->id)
                                    <span class="text-muted mx-1">&middot;</span>
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="piki-delete-btn">Delete</button>
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
                    <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm comment-input pe-5"
                        placeholder="Add a comment…♡">{{ old('comment_body' . $post->id) }}</textarea>
                    <button type="submit" class="btn btn-sm comment-send-btn position-absolute top-50 end-0 translate-middle-y pe-3">
                        <i class="fa-regular fa-paper-plane"></i>
                    </button>
                </div>
                @error('comment_body' . $post->id)
                    <div class="text-danger xsmall mt-1">{{ $message }}</div>
                @enderror
            </form>
        </div>
    </div>
</div>
@endsection