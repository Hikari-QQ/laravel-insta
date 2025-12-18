<a href="{{ route('post.show', $post->id) }}">
        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="w-100 post-image">
    </a>

    <div class="card-body p-3">
        <div class="d-flex align-items-center mb-2">
            <div class="me-2">
                @if ($post->isLiked())
                    <form action="{{ route('like.destroy', $post->id) }}" method="post" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm shadow-none p-0 rounded-circle heart-btn">
                            <i class="fa-solid fa-heart"></i>
                        </button>
                    </form>
                @else
                    <form action="{{ route('like.store', $post->id) }}" method="post" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-sm shadow-none p-0 rounded-circle heart-btn">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                    </form>
                @endif
            </div>
            <div>
                <span class="like-count">{{ $post->likes->count() }}</span>
            </div>
            <div class="ms-auto text-end">
                @if ($post->categoryPost->count() != 0)
                    @foreach ($post->categoryPost as $category_post)
                        <span class="badge bg-secondary bg-opacity-50 rounded-pill me-1">
                            {{ $category_post->category->name }}
                        </span>
                    @endforeach
                @else
                    <span class="badge bg-dark text-white rounded-pill">Uncategorized</span>
                @endif
            </div>
        </div>

        <p class="mb-1"><span class="fw-bold user-name">{{ $post->user->name }}</span> @translate($post->description)</p>

        <p class="text-uppercase text-muted xsmall mb-0">{{ date('M d, Y', strtotime($post->created_at)) }}</p>

        @include('users.posts.contents.comments')
    </div>
    <style>


.avatar-sm {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
}

/* ユーザー名をmurasakiに設定 */
.user-name {
    color: #C9B3E0;
}

.post-image {
    width: 100%;
    display: block;
    height: auto;
}

/* ハートアイコンをピンクに設定 */
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
}

.badge.rounded-pill {
    border-radius: 50px !important;
    font-size: 0.75rem;
}
</style>
</div>