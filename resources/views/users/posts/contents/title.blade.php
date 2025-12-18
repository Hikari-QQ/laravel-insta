<div class="post-card mb-3">
    <div class="d-flex align-items-center p-3">
        <div class="d-flex align-items-center me-auto">
            <a href="{{ route('profile.show', $post->user->id) }}">
                @if ($post->user->avatar)
                    <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}"
                        class="rounded-circle avatar-lg-custom me-3">
                @else
                    <i class="fa-solid fa-circle-user avatar-lg-custom me-3" style="color: #ff85a2"></i>
                @endif
            </a>
            <a href="{{ route('profile.show', $post->user->id) }}"
                class="text-decoration-none text-dark fw-bold post-header-name">
                {{ $post->user->name }}
            </a>
        </div>

        <div class="dropdown">
            <button class="btn btn-sm shadow-none" data-bs-toggle="dropdown">
                <i class="fa-solid fa-ellipsis"></i>
            </button>
            <div class="dropdown-menu">
                @if (Auth::user()->id === $post->user->id)
                    <a href="{{ route('post.edit', $post->id) }}" class="dropdown-item">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                    </a>
                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                        data-bs-target="#delete-post-{{ $post->id }}">
                        <i class="fa-regular fa-trash-can"></i> Delete
                    </button>
                    @include('users.posts.contents.modals.delete')
                @else
                    <form action="{{ route('follow.destroy', $post->user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item text-danger">Unfollow</button>
                    </form>
                @endif
            </div>
        </div>
        <style>
            .post-header-name {
                color: #C8A2FF !important;
                font-weight: 500;
            }
        </style>
    </div>
