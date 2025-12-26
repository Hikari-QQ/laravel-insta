@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<style>
    /* 全体の背景：Registerと同じ薄いピンク */
    body {
        background-color: #FFE4E8 !important; 
    }

    .edit-profile-wrapper {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 0;
    }

    /* メインカード：Registerと同じ透ける白 */
    .cute-form-card {
        background-color: rgba(255, 255, 255, 0.6) !important;
        backdrop-filter: blur(5px);
        border-radius: 20px;
        border: none;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    /* タイトル */
    .page-title {
        color: #ff85a2;
        font-weight: bold;
        text-align: center;
        margin-bottom: 2rem;
    }

    /* ハートだけ水色 */
    .heart-blue {
        color: #BFEAF2;
    }

    /* アバター画像 */
    .avatar-preview {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid rgba(255, 255, 255, 0.8);
    }

    /* 入力フォーム：Registerのform-control-cuteと同じ（透ける白） */
    .cute-input {
        background-color: rgba(255, 255, 255, 0.4) !important;
        border: none !important;
        border-radius: 10px;
        padding: 12px 18px;
        color: #5f5f5f;
        transition: all 0.3s;
    }

    .cute-input:focus {
        background-color: rgba(255, 255, 255, 0.8) !important;
        box-shadow: none !important;
        outline: none;
    }

    /* ラベル：Registerと同じ薄紫色 */
    .cute-label {
        color: #C9B3E0;
        font-weight: bold;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* 保存ボタン：水色背景 #DFF4F8 × 黒文字 #37353E × 四角 */
    .btn-save-cute {
        background-color: #DFF4F8 !important; 
        color: #37353E !important;           
        border: none !important;
        border-radius: 4px !important; /* 四角いボタン */
        padding: 12px 0;
        font-weight: bold;
        transition: all 0.3s;
        width: 100%;
        cursor: pointer;
    }

    .btn-save-cute:hover {
        background-color: #BFEAF2 !important;
        transform: translateY(-2px);
    }
</style>

<div class="edit-profile-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="cute-form-card">
                    @csrf
                    @method('PATCH')

                    <div class="text-center mb-5">
                        <h2 class="h4 page-title">
                            <i class="fa-solid fa-heart heart-blue me-2"></i>
                            @translate('Update Profile')
                            <i class="fa-solid fa-heart heart-blue ms-2"></i>
                        </h2>
                    </div>

                    {{-- アバターセクション --}}
                    <div class="row mb-4 align-items-center justify-content-center">
                        <div class="col-auto text-center">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar-preview mb-3">
                            @else
                                <div class="avatar-preview d-flex align-items-center justify-content-center bg-white bg-opacity-50 mb-3 mx-auto">
                                    <i class="fa-solid fa-user" style="font-size: 3.5rem; color: #F08FB3;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-7">
                            <label for="avatar" class="cute-label">@translate('Change Photo')</label>
                            <input type="file" name="avatar" id="avatar" class="form-control form-control-sm cute-input">
                            @error('avatar')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="mb-4">
                        <label for="name" class="cute-label">@translate('Name')</label>
                        <input type="text" name="name" id="name" class="form-control cute-input" value="{{ old('name', $user->name) }}" placeholder="@translate('Your cute name')">
                        @error('name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label for="email" class="cute-label">@translate('E-Mail Address')</label>
                        <input type="text" name="email" id="email" class="form-control cute-input" value="{{ old('email', $user->email) }}" placeholder="name@example.com">
                        @error('email')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Introduction --}}
                    <div class="mb-4">
                        <label for="introduction" class="cute-label">@translate('Introduction')</label>
                        <textarea name="introduction" id="introduction" rows="4" class="form-control cute-input" placeholder="@translate('Tell us about yourself')... 💖">{{ old('introduction', $user->introduction) }}</textarea>
                        @error('introduction')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <div class="text-center mt-5">
                        <button type="submit" class="btn-save-cute shadow-sm">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection