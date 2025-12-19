<style>
    .avatar-lg {
        width: 150px;
        height: 150px;
        padding: 5px;
        background: linear-gradient(45deg, #f983ff, #66fff5);
        border-radius: 50%;
        display: inline-block;
    }

    .object-fit-cover {
        object-fit: cover;
    }
</style>

<div class="row">
    <div class="col-4">
        @if ($user->avatar)
            <a href="#">
                <img src="{{ $user->avatar }}" alt="{{ $user->name }}"
                    class="img-thumbnail rounded-circle d-block mx-auto avatar-lg object-fit-cover">
            </a>
        @else
            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg"></i>
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>
            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm fw-bold">Edit
                        Profile</a>
                @else
                    @if ($user->isFollowed())
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                        </form>
                    @else
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn text-white btn-secondary btn-sm fw-bold">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <strong style="color: #ff7fbb;">{{ $user->posts->count() }}</strong>
                    @if ($user->posts->count() == 1)
                        post
                    @else
                        posts
                    @endif
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
                    <strong style="color: #ff7fbb;">{{ $user->followers->count() }}</strong>
                    @if ($user->followers->count() == 1)
                        follower
                    @else
                        followers
                    @endif
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.following', $user->id) }}" class="text-decoration-none text-dark">
                    <strong style="color: #ff7fbb;">{{ $user->following->count() }}</strong> following
                </a>
            </div>
        </div>
        <p class="fw-bold">{{ $user->introduction }}</p>
    </div>
</div>
