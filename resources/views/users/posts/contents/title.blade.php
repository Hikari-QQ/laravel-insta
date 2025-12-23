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

            <div class="dropdown-menu piki-dropdown-menu">
                @if (Auth::user()->id === $post->user->id)
                    <a href="{{ route('post.edit', $post->id) }}" class="piki-dropdown-item">
                        <i class="fa-regular fa-pen-to-square"></i> Edit
                    </a>

                    <button class="piki-dropdown-item" data-bs-toggle="modal"
                        data-bs-target="#delete-post-{{ $post->id }}">
                        <i class="fa-regular fa-trash-can"></i> Delete
                    </button>
                @else
                    <form action="{{ route('follow.destroy', $post->user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="piki-dropdown-item">Unfollow</button>
                    </form>
                @endif
            </div>
        </div>
        @include('users.posts.contents.modals.delete')
        <style>
            .avatar-lg-custom {
                width: 40px;
                height: 40px;
                font-size: 40px;
                /* アイコン（fa-circle-user）用 */
                object-fit: cover;
            }

            .post-header-name {
                color: #37353E !important;
                font-weight: 500;
            }

            /* 追加するスタイル */
            .piki-dropdown-menu {
                background-color: #ffffff !important;
                border-radius: 14px !important;
                box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08) !important;
                border: none !important;
                padding: 8px 0 !important;
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
                /* 薄いピンク背景 */
                color: #F08FB3 !important;
                /* 濃いピンク文字 */
            }

            .piki-dropdown-item:hover i {
                color: #F08FB3 !important;
                /* アイコンもピンクに */
            }
        </style>

    </div>
