@extends('layouts.app')

@section('title', 'Register')

@section('content')
<style>
    /* 全体の背景 */
    body {
        background-color: #FFE4E8 !important; 
    }

    .register-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px 0;
    }

    /* メインカード */
    .register-card {
        background-color: rgba(255, 255, 255, 0.6) !important;
        backdrop-filter: blur(5px);
        border-radius: 20px;
        border: none;
        padding: 40px;
    }

    .register-header-text {
        color: #ff85a2;
        font-weight: bold;
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-label-cute {
        color: #C9B3E0;
        font-weight: bold;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* 【ここが重要】背景色を「透ける白」に強制固定 */
    .form-control-cute {
        background-color: rgba(255, 255, 255, 0.4) !important; /* !importantを追加 */
        border: none !important;
        border-radius: 10px;
        padding: 12px 18px;
        color: #5f5f5f;
        transition: all 0.3s;
    }

    .form-control-cute:focus {
        background-color: rgba(255, 255, 255, 0.8) !important; /* フォーカス時も白 */
        box-shadow: none !important;
        outline: none;
    }

    /* ボタンの色をCreate Postの btn-post と統一（ここも白に近い水色から水色に変更） */
    .btn-register {
        background-color: #DFF4F8 !important;
        color: #4A4A4A !important;
        border: none !important;
        border-radius: 50px;
        padding: 12px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .btn-register:hover {
        background-color: #9cd4f8 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
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