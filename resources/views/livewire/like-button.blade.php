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
</div>