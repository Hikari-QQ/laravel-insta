@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
/* 背景色はLoginと統一 */
body {
    background-color: #FFE4E8; 
}

.register-wrapper {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 0;
}

.register-card {
    background-color: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(5px);
    border-radius: 20px;
    border: none;
    padding: 30px;
}

.register-header-text {
    color: #ff85a2; /* ハートとタイトルのピンク */
    font-weight: bold;
    text-align: center;
    margin-bottom: 2rem;
}

.form-label-cute {
    color: #C9B3E0; /* ラベルの紫 */
    font-weight: bold;
}

/* フォームの色をLoginの #DFF4F8 に統一 */
.form-control-cute {
    background-color: #DFF4F8; 
    border: none;
    border-radius: 10px;
    padding: 12px 18px;
    color: #5f5f5f;
}

.form-control-cute:focus {
    background-color: #d2f0f5; /* フォーカス時の色 */
    box-shadow: none;
    outline: none;
}

/* ボタンの色をLoginの #AEDEFC に統一 */
.btn-register {
    background-color: #AEDEFC;
    color: #4A4A4A;
    border: none;
    border-radius: 50px;
    padding: 12px;
    font-weight: bold;
    transition: all 0.3s;
}

.btn-register:hover {
    background-color: #9cd4f8;
    transform: translateY(-2px);
}

.heart {
    color: #ff85a2;
}
</style>

<div class="register-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card register-card shadow-sm">
                    <div class="card-body">

                        <h2 class="h4 register-header-text">
                            <i class="fa-solid fa-heart heart me-2"></i>
                            {{ __('Register') }}
                            <i class="fa-solid fa-heart heart ms-2"></i>
                        </h2>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-4">
                                <label for="name" class="form-label form-label-cute">{{ __('Name') }}</label>
                                <input id="name" type="text"
                                    class="form-control form-control-cute @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="mb-4">
                                <label for="email" class="form-label form-label-cute">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control form-control-cute @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="mb-4">
                                <label for="password" class="form-label form-label-cute">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control form-control-cute @error('password') is-invalid @enderror"
                                    name="password" required>
                                @error('password')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            {{-- Confirm Password (修正箇所: classをform-control-cuteに変更) --}}
                            <div class="mb-5">
                                <label for="password-confirm" class="form-label form-label-cute">
                                    {{ __('Confirm Password') }}
                                </label>
                                <input id="password-confirm" type="password"
                                    class="form-control form-control-cute"
                                    name="password_confirmation" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-register w-100 shadow-sm">
                                    {{ __('Register') }}
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection