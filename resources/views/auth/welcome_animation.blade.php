{{-- resources/views/auth/welcome_animation.blade.php --}}
@extends('layouts.app')

@section('content')
<div id="welcome-overlay" style="
    position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: #ffffff; z-index: 9999; display: flex;
    justify-content: center; align-items: center;
">
    <div id="welcome-message" style="opacity: 0; transform: translateY(30px); transition: all 0.8s ease-out; text-align: center;">
        <h1 style="font-size: 4rem; font-weight: bold; color: #3490dc;">Hello!</h1>
        <p style="font-size: 1.5rem; color: #6c757d;">{{ Auth::user()->name }}</p>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const msg = document.getElementById('welcome-message');
    
    // 1. 少し遅れてふわっと表示
    setTimeout(() => {
        msg.style.opacity = '1';
        msg.style.transform = 'translateY(0)';
    }, 100);

    // 2. 2秒後にホーム画面へ移動
    setTimeout(() => {
        // フェードアウト演出
        document.getElementById('welcome-overlay').style.transition = 'opacity 0.5s';
        document.getElementById('welcome-overlay').style.opacity = '0';
        
        setTimeout(() => {
            // ここで本当のトップページに飛ばす
            window.location.href = "{{ url('/') }}"; 
        }, 500);
    }, 2000); 
});
</script>
@endsection