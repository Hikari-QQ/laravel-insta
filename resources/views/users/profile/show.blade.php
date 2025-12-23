@extends('layouts.app')

@section('title', $user->name)

@section('content')

<style>
/* 手描き風パステル枠のスタイル */
.grid-img-container {
    position: relative;
    padding: 10px;
}

.grid-img {
    width: 100%;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    border-radius: 25px;
    transition: all 0.3s ease;
    box-shadow: 
        5px 5px 0px 0px #FBEFEF,
        8px 8px 10px rgba(0,0,0,0.1);
}

.grid-img:hover {
    transform: scale(1.03) rotate(-2deg);
    border-color: #f983ff;
    outline-color: #66fff5;
    box-shadow: 
        7px 7px 0px 0px #DFF4F8,
        15px 15px 20px rgba(240, 143, 179, 0.2);
    cursor: pointer;
}

.no-posts-container {
    margin-top: 100px;
    text-align: center;
    color: #F08FB3;
}
.no-posts-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    display: inline-block;
    animation: float 3s ease-in-out infinite;
}


@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.animated-item {
    position: fixed;
    top: 100vh;
    background-size: contain;
    background-repeat: no-repeat;
    animation: floatAnim var(--duration) linear infinite;
    opacity: 0.8;
    pointer-events: none;
    z-index: -1;
}

@keyframes floatAnim {
    0% { transform: translateY(0) rotate(0deg) scale(0.8); opacity: 0.8; }
    50% { opacity: 1; }
    100% { transform: translateY(-100vh) rotate(360deg) scale(1.2); opacity: 0; }
}

.heart {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'%3E%3Cpath fill='%23C2E2FA' d='M442.9 144C415.6 144 389.9 157.1 373.9 179.2L339.5 226.8C335 233 327.8 236.7 320.1 236.7C312.4 236.7 305.2 233 300.7 226.8L266.3 179.2C250.3 157.1 224.6 144 197.3 144C150.3 144 112.2 182.1 112.2 229.1C112.2 279 144.2 327.5 180.3 371.4C221.4 421.4 271.7 465.4 306.2 491.7C309.4 494.1 314.1 495.9 320.2 495.9C326.3 495.9 331 494.1 334.2 491.7C368.7 465.4 419 421.3 460.1 371.4C496.3 327.5 528.2 279 528.2 229.1C528.2 182.1 490.1 144 443.1 144z'/%3E%3C/svg%3E");
}

.cloud {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 640 640'%3E%3Cpath fill='%23E5D9F2' d='M112 256C112 167.6 183.6 96 272 96C319.1 96 361.4 116.4 390.7 148.7C401.3 145.6 412.5 144 424 144C490.3 144 544 197.7 544 264C544 277.2 541.9 289.9 537.9 301.8C579.5 322.9 608 366.1 608 416C608 486.7 550.7 544 480 544L176 544C96.5 544 32 479.5 32 400C32 343.2 64.9 294.1 112.7 270.6C112.3 265.8 112 260.9 112 256z'/%3E%3C/svg%3E");
}

.posts-title{
    color: #F08FB3;
    font-weight: bold;
    margin-bottom: 30px;
    text-shadow: 1px 1px 0px #fff;
}
</style>

@include('users.profile.header')

<div style="margin-top: 100px">
    @if ($user->posts->isNotEmpty())
        <div class="row">
            @foreach ($user->posts as $post)
                <div class="col-lg-4 cold-md-6 mb-4">
                    <a href="{{ route('post.show', $post->id) }}">
                        <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="grid-img">
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <h3 class="text-center posts-title" style="margin-top: 100px;">☁️ No Posts Yet ☁️</h3>
    @endif
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const itemCount = 20;
    const itemClasses = ['heart', 'cloud'];
    const minDuration = 6;
    const maxDuration = 12;
    const minSize = 40;
    const maxSize = 80;

    for (let i = 0; i < itemCount; i++) {
        const item = document.createElement("div");
        item.classList.add("animated-item", itemClasses[Math.floor(Math.random() * itemClasses.length)]);
        item.style.left = Math.random() * 100 + "vw";
        item.style.setProperty('--duration', (minDuration + Math.random() * (maxDuration - minDuration)) + "s");
        const size = minSize + Math.random() * (maxSize - minSize);
        item.style.width = size + "px";
        item.style.height = size + "px";
        item.style.animationDelay = Math.random() * maxDuration + "s";
        document.body.appendChild(item);
    }
});
</script>

@endsection
