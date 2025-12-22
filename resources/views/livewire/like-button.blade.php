<div class="d-inline">
    @if ($post->isLiked())
        {{-- いいね済み：赤いハート --}}
        <button wire:click="toggleLike" class="btn btn-sm shadow-none ps-0">
            <i class="fa-solid fa-heart text-danger"></i>
        </button>
    @else
        {{-- 未いいね：空のハート --}}
        <button wire:click="toggleLike" class="btn btn-sm shadow-none ps-0">
            <i class="fa-regular fa-heart"></i>
        </button>
    @endif

    {{-- 数字の部分 --}}
    <span class="fw-bold">{{ $post->likes->count() }}</span>

    {{-- ユーザー名の表示エリア --}}
    @if($post->likes->count() > 0)
        <small class="text-muted">
            @foreach($post->likes->take(2) as $like)
                {{ $like->user->name }}{{ !$loop->last ? ',' : '' }}
            @endforeach

            @if($post->likes->count() === 1)
                likes
            @elseif($post->likes->count() === 2)
                like
            @else
                and others like
            @endif
        </small>
    @endif
</div>