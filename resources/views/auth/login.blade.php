@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    /* 全体の背景 */
    body {
        background-color: #FFE4E8 !important; 
    }

    .login-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* メインカード */
    .login-card {
        background-color: rgba(255, 255, 255, 0.6) !important;
        border: none;
        border-radius: 20px;
        padding: 30px;
        backdrop-filter: blur(5px);
    }

    .login-header-text {
        color: #ff85a2; 
        font-weight: bold;
        text-align: center;
        margin-bottom: 2rem;
    }

    .form-label-cute {
        color: #C9B3E0; 
        font-weight: bold;
    }

    /* 入力フォームの設定 */
    .form-control-cute {
        background-color: rgba(255, 255, 255, 0.4) !important; /* 透ける白 */
        border: none !important;
        border-radius: 10px;
        padding: 12px 18px;
        color: #5f5f5f !important;
        transition: all 0.3s;
    }

    /* 【重要】ブラウザの自動入力(黄色や青)を上書きして白くする設定 */
    .form-control-cute:-webkit-autofill,
    .form-control-cute:-webkit-autofill:hover, 
    .form-control-cute:-webkit-autofill:focus {
        -webkit-text-fill-color: #5f5f5f !important;
        -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.9) inset !important; /* 内側に白い影を塗って色を隠す */
        transition: background-color 5000s ease-in-out 0s;
    }

    .form-control-cute:focus {
        background-color: rgba(255, 255, 255, 0.8) !important; 
        box-shadow: none !important;
        outline: none;
    }

    /* ログインボタン：水色 */
    .btn-login {
        background-color: #DFF4F8 !important;
        color: #4A4A4A !important;
        border: none !important;
        border-radius: 50px;
        padding: 12px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .btn-login:hover {
        background-color: #9cd4f8 !important; 
        transform: translateY(-2px);
    }

    .heart {
        color: #ff85a2;
    }
</style>

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card shadow-sm">
                    <div class="card-body">

                        <h2 class="h4 login-header-text">
                            <i class="fa-solid fa-heart heart me-2"></i>
                            {{ __('Login') }}
                            <i class="fa-solid fa-heart heart ms-2"></i>
                        </h2>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="email" class="form-label form-label-cute">{{ __('Email Address') }}</label>
                                <input id="email" type="email"
                                    class="form-control form-control-cute @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autofocus autocomplete="off">
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="password" class="form-label form-label-cute">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control form-control-cute @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-login w-100 shadow-sm">
                                    {{ __('Login') }}
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