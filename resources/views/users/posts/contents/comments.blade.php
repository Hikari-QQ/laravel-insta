<style>
    .comment-input {
        background-color: #DFF4F8;
        border: none;
        border-radius: 15px;
        padding: 6px 12px;
        color: #5f5f5f;
        /* 文字色 */
    }

    .comment-input::placeholder {
        color: #ff85a2;
        /* ピンクの文字 */
        opacity: 1;
    }

    .comment-input:focus {
        box-shadow: none;
        outline: none;
    }

    .comment-send-btn i {

        color: #C9B3E0;
    }

    .comment-input {
        background-color: #DFF4F8;
        /* 水色のまま */
        border: none;
        border-radius: 15px;
        padding: 6px 12px;
        color: #5f5f5f;
        /* 文字色 */
        transition: background-color 0.2s ease, border 0.2s ease;
    }

    .comment-input::placeholder {
        color: #ff85a2;
        opacity: 1;
    }

    .comment-input:hover {
        background-color: #FBEFEF;
        /* hover時は薄いピンク */
    }

    .comment-input:focus {
        background-color: #FBEFEF;
        /* フォーカス時も薄いピンク */
        outline: none;
        box-shadow: none;
    }

    .comment-send-btn i {
        color: #C9B3E0;
        transition: color 0.2s ease, transform 0.2s ease;
    }

    .comment-send-btn:hover i {
        color: #F08FB3 !important;
        /* 薄いピンク */
        transform: scale(1.1);
    }
</style>


<div class="mt-3">
    {{-- Show all comments here --}}
    @if ($post->comments->isNotEmpty())
        <hr>
        <ul class="list-group">
            @foreach ($post->comments->take(3) as $comment)
                <li class="list-group item border-0 p-0 mb-2">
                    <a href="{{ route('profile.show', $comment->user->id) }}"
                        class="text-decoration-none text-dark fw-bold">{{ $comment->user->name }}</a>
                    <p class="d-inline fw-light">{{ $comment->body }}</p>

                    <form action="{{ route('comment.destroy', $comment->id) }}" method="post">
                        @csrf
                        @method('DELETE')

                        <span
                            class="text-uppercase text-muted xsmall">{{ date('M d, Y', strtotime($comment->created_at)) }}</span>

                        {{-- If the auth user is the owner of the comment, show delete btn --}}
                        @if (Auth::user()->id === $comment->user->id)
                            &middot;<button type="submit"
                                class="border-0 bg-transparent text-danger p-0 xsmall">Delete</button>
                        @endif
                    </form>
                </li>
            @endforeach
            @if ($post->comments->count() > 3)
                <li class="list-group-item border-0 px-0 pt-0">
                    <a href="{{ route('post.show', $post->id) }}" class="text-decoration-none small">View all
                        {{ $post->comments->count() }} comments</a>
                </li>
            @endif
        </ul>
    @endif

    <form action="{{ route('comment.store', $post->id) }}" method="post">
        @csrf

        <div class="position-relative">
            <textarea name="comment_body{{ $post->id }}" rows="1" class="form-control form-control-sm comment-input pe-5"
                placeholder="Add a comment…♡">{{ old('comment_body' . $post->id) }}</textarea>

            <button type="submit" class="btn btn-sm comment-send-btn position-absolute top-50 end-0 translate-middle-y"
                title="Post">
                <i class="fa-regular fa-paper-plane" style="color: #C8A2FF;"></i>
            </button>
        </div>

        @error('comment_body' . $post->id)
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </form>




</div>
