@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    /* 灰色の背景をなくし、画面全体を白ベースの清潔感あるトーンに */
    body {
        background-color: #ffffff;
    }

    .login-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ログインカード：影をより繊細にして浮遊感を出す */
    .login-card {
        border: none;
        border-radius: 30px;
        background-color: #ffffff;
        box-shadow: 0 15px 40px rgba(183, 156, 156, 0.12); /* ほんのりピンク系の繊細な影 */
        padding: 10px;
    }

    .card-header-cute {
        background: transparent;
        border: none;
        padding: 2rem 1rem 1rem 1rem;
        text-align: center;
    }

    .card-header-cute h5 {
        color: #F08FB3;
        font-weight: 700;
        letter-spacing: 1px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-bottom: 0;
    }

    .header-heart {
        width: 20px;
        height: 20px;
        fill: #BFEAF2;
    }

    /* 入力フォーム：枠線をより淡くして柔らかく */
    .form-control-cute {
        border-radius: 15px;
        border: 1.5px solid #f3ecec;
        padding: 12px 18px;
        background-color: #fffafb;
        transition: all 0.3s ease;
    }

    .form-control-cute:focus {
        border-color: #F08FB3;
        background-color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(240, 143, 179, 0.1);
        outline: none;
    }

    /* ログインボタン：水色×ピンク文字 */
    .btn-cute-primary {
        background-color: #BFEAF2 !important;
        color: #F08FB3 !important;
        border: none !important;
        border-radius: 25px;
        padding: 12px 35px;
        font-weight: 700;
        transition: all 0.3s ease;
    }

    .btn-cute-primary:hover {
        background-color: #C9ECF3 !important;
        color: #E46A9A !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(191, 234, 242, 0.4);
    }

    .form-label-cute {
        color: #a08f8f;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* バリデーションエラー時の調整 */
    .is-invalid {
        border-color: #ffb3b3 !important;
    }
</style>

<div class="login-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5"> {{-- 幅を少しスリムに --}}
                <div class="card login-card">
                    <div class="card-header-cute">
                        <h5>
                            <svg class="header-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z"/></svg>
                            {{ __('Login') }}
                            <svg class="header-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z"/></svg>
                        </h5>
                    </div>

                    <div class="card-body p-4 pt-0">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4"> {{-- レイアウトを縦並びにしてスッキリ --}}
                                <label for="email" class="form-label form-label-cute ms-2">{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control form-control-cute @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback ms-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-5">
                                <label for="password" class="form-label form-label-cute ms-2">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control form-control-cute @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback ms-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="text-center mb-3">
                                <button type="submit" class="btn btn-cute-primary shadow-sm w-100">
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