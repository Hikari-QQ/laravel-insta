@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
body {
    background-color: #FFE4E8; /* 統一ピンク */
}

.login-wrapper {
    min-height: 80vh;
    display: flex;
    align-items: center;
    justify-content: center;
}

.login-card {
    background-color: rgba(255, 255, 255, 0.6);
    border: none;
    border-radius: 20px;
    padding: 30px;
    backdrop-filter: blur(5px);
}

.login-header-text {
    color: #ff85a2; /* ハートとタイトルのピンク */
    font-weight: bold;
    text-align: center;
    margin-bottom: 2rem;
}

.form-label-cute {
    color: #C9B3E0; /* ラベル紫 */
    font-weight: bold;
}

.form-control-cute {
    background-color: #DFF4F8; /* 水色統一 */
    border: none;
    border-radius: 10px;
    padding: 12px 18px;
    color: #5f5f5f;
}

.form-control-cute:focus {
    background-color: #d2f0f5; /* 水色フォーカス */
    box-shadow: none;
    outline: none;
}

.btn-login {
    background-color: #AEDEFC; /* ボタン水色 */
    color: #4A4A4A;
    border: none;
    border-radius: 50px;
    padding: 12px;
    font-weight: bold;
    transition: all 0.3s;
}

.btn-login:hover {
    background-color: #9cd4f8; /* ホバー水色 */
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
                                    name="email" value="{{ old('email') }}" required autofocus>
                                @error('email')
                                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="password" class="form-label form-label-cute">{{ __('Password') }}</label>
                                <input id="password" type="password"
                                    class="form-control form-control-cute @error('password') is-invalid @enderror"
                                    name="password" required>
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
