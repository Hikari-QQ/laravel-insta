{{-- resources/views/auth/welcome_animation.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    /* 背景：ほんのりピンクから白へのグラデーション */
    #welcome-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle, #ffffff 0%, #fff5f7 100%);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    /* メッセージの装飾 */
    .welcome-content {
        text-align: center;
        opacity: 0;
        transform: translateY(30px);
        transition: all 1.0s cubic-bezier(0.22, 1, 0.36, 1);
    }

    /* Hello! の文字：水色とピンクのミックス */
    .welcome-title {
        font-size: 5rem;
        font-weight: 800;
        background: linear-gradient(45deg, #F08FB3, #BFEAF2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 0.5rem;
        letter-spacing: -2px;
    }

    /* ユーザー名：くすみブラウン */
    .welcome-name {
        font-size: 1.8rem;
        color: #8d7d7d;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    /* 装飾用のふわふわ浮くハート */
    .floating-heart {
        position: absolute;
        fill: #BFEAF2;
        opacity: 0.4;
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(10deg); }
    }
</style>

<div id="welcome-overlay">
    <svg class="floating-heart" style="top: 20%; left: 15%; width: 40px;" viewBox="0 0 640 640"><path d="M320 544c-15.5 0-30.7-4.7-43.1-14.1C203.9 474.2 64 343.9 64 231.7 64 155.6 123.6 96 197.1 96c42.7 0 82.9 20.5 107.9 55.1L320 171.8l15.1-20.7C360 116.5 400.2 96 442.9 96 516.4 96 576 155.6 576 229.1c0 112.2-139.9 242.4-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1z"/></svg>
    <svg class="floating-heart" style="bottom: 25%; right: 20%; width: 60px; fill: #F08FB3; animation-delay: 1s;" viewBox="0 0 640 640"><path d="M320 544c-15.5 0-30.7-4.7-43.1-14.1C203.9 474.2 64 343.9 64 231.7 64 155.6 123.6 96 197.1 96c42.7 0 82.9 20.5 107.9 55.1L320 171.8l15.1-20.7C360 116.5 400.2 96 442.9 96 516.4 96 576 155.6 576 229.1c0 112.2-139.9 242.4-212.9 298.2-12.4 9.4-27.6 14.1-43.1 14.1z"/></svg>

    <div id="welcome-message" class="welcome-content">
        <h1 class="welcome-title">Hello!</h1>
        <p class="welcome-name">
            <span style="color: #BFEAF2;">♡</span>
            {{ Auth::user()->name }}
            <span style="color: #F08FB3;">♡</span>
        </p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const msg = document.getElementById('welcome-message');
    
    // 1. 少し遅れてふわっと表示
    setTimeout(() => {
        msg.style.opacity = '1';
        msg.style.transform = 'translateY(0)';
    }, 200);

    // 2. 2.5秒後にホーム画面へ移動（少しだけ余韻を持たせました）
    setTimeout(() => {
        const overlay = document.getElementById('welcome-overlay');
        overlay.style.transition = 'opacity 0.8s ease';
        overlay.style.opacity = '0';
        
        setTimeout(() => {
            window.location.href = "{{ url('/') }}"; 
        }, 800);
    }, 2500); 
});
</script>
@endsection