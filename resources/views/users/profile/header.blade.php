<style>
    /* 既存のスタイル */
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

    /* 水色×黒文字の四角いボタン設定（Follow / Edit Profile 共通） */
    .btn-custom-square {
        background-color: #DFF4F8 !important; /* 水色 */
        color: #37353E !important;           /* 黒っぽい文字色 */
        border: none !important;
        border-radius: 4px !important;       /* 四角 */
        font-weight: bold;
        padding: 5px 15px !important;
        font-size: 0.8rem;
        transition: 0.3s;
        display: inline-block;
        text-decoration: none;
    }
    
    .btn-custom-square:hover {
        background-color: #BFEAF2 !important;
        transform: translateY(-1px);
        color: #37353E !important;
    }

    /* Following（解除）ボタンだけは区別のためグレーのまま */
    .btn-custom-gray {
        background-color: #f8f9fa !important;
        color: #adb5bd !important;
        border: 1px solid #dee2e6 !important;
        border-radius: 4px !important;
        font-weight: bold;
        padding: 5px 15px !important;
        font-size: 0.8rem;
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
            <i class="fa-solid fa-circle-user d-block text-center" style="font-size: 150px; color: #F08FB3;"></i>
        @endif
    </div>
    <div class="col-8">
        <div class="row mb-3">
            <div class="col-auto">
                <h2 class="display-6 mb-0">{{ $user->name }}</h2>
            </div>
            <div class="col-auto p-2">
                @if (Auth::user()->id === $user->id)
                    {{-- Edit Profile も Follow と同じ水色ボタンに変更 --}}
                    <a href="{{ route('profile.edit') }}" class="btn btn-custom-square fw-bold">Edit Profile</a>
                @else
                    @if ($user->isFollowed())
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-custom-gray fw-bold">Following</button>
                        </form>
                    @else
                        <form action="{{ route('follow.store', $user->id) }}" method="post">
                            @csrf
                            <button type="submit" class="btn btn-custom-square fw-bold">Follow</button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
        
        {{-- 以下、投稿数・フォロワー数などの部分は変更なし --}}
        <div class="row mb-3">
            <div class="col-auto">
                <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                    <strong style="color: #ff7fbb;">{{ $user->posts->count() }}</strong>
                    @if ($user->posts->count() == 1) post @else posts @endif
                </a>
            </div>
            <div class="col-auto">
                <a href="{{ route('profile.followers', $user->id) }}" class="text-decoration-none text-dark">
                    <strong style="color: #ff7fbb;">{{ $user->followers->count() }}</strong>
                    @if ($user->followers->count() == 1) follower @else followers @endif
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