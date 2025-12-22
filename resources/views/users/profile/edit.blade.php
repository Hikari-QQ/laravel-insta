@extends('layouts.app')
 
@section('title', 'Edit Profile')
 
@section('content')

<style>
    /* 全体の背景 */
    .edit-profile-bg {
        background-color: #fff9fa00;
        min-height: 100vh;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    /* メインの白いカード */
    .cute-form-card {
        background: #ffffff;
        border-radius: 40px;
        border: 4px solid #fff;
        box-shadow: 0 10px 30px rgba(240, 143, 179, 0.15); /* ピンクの影 */
        padding: 40px;
    }

    /* タイトル */
    .page-title {
        color: #F08FB3;
        font-weight: 800;
        letter-spacing: 1px;
    }

    /* アバター画像 */
    .avatar-preview {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid #fff;
        box-shadow: 0 0 0 3px #BFEAF2; /* 水色のリング */
    }

    /* 入力フォームのデザイン */
    .cute-input {
        background-color: #FDFDFD;
        border: 2px solid #FBEFEF;
        border-radius: 20px;
        padding: 12px 20px;
        color: #555;
        transition: all 0.3s ease;
    }
    .cute-input:focus {
        background-color: #fff;
        border-color: #BFEAF2; /* フォーカス時は水色 */
        box-shadow: 0 0 0 4px rgba(191, 234, 242, 0.3);
        outline: none;
    }

    /* ラベル */
    .cute-label {
        color: #888;
        font-weight: bold;
        font-size: 0.9rem;
        margin-left: 10px;
        margin-bottom: 5px;
    }

    /* ファイル選択ボタン周り */
    .file-input-wrapper {
        font-size: 0.85rem;
        color: #aaa;
    }
    
    /* 保存ボタン */
    .btn-save-cute {
        background: linear-gradient(45deg, #F08FB3, #F4A4C0);
        color: white;
        border: none;
        border-radius: 50px;
        padding: 12px 0;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 5px 15px rgba(240, 143, 179, 0.4);
        transition: transform 0.2s;
        width: 100%;
    }
    .btn-save-cute:hover {
        transform: translateY(-2px);
        color: white;
        background: linear-gradient(45deg, #E46A9A, #F08FB3);
    }
</style>

<div class="edit-profile-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-8">
                
                <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data" class="cute-form-card">
                    @csrf
                    @method('PATCH')

                    <div class="text-center mb-5">
                        <h2 class="h3 page-title">
                            <i class="fa-solid fa-wand-magic-sparkles me-2"></i>Update Profile
                        </h2>
                    </div>

                    {{-- アバターセクション --}}
                    <div class="row mb-4 align-items-center">
                        <div class="col-auto">
                            @if ($user->avatar)
                                <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="avatar-preview">
                            @else
                                <div class="avatar-preview d-flex align-items-center justify-content-center bg-light text-pink">
                                    <i class="fa-solid fa-user" style="font-size: 3rem; color: #F08FB3;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <label for="avatar" class="form-label cute-label">Change Photo</label>
                            <input type="file" name="avatar" id="avatar" class="form-control form-control-sm cute-input" aria-describedby="avatar-info">
                            <div class="mt-2 file-input-wrapper">
                                <i class="fa-regular fa-image me-1"></i> JPG, PNG, GIF (Max 1MB)
                            </div>
                            @error('avatar')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Name --}}
                    <div class="mb-3">
                        <label for="name" class="cute-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control cute-input" value="{{ old('name', $user->name) }}" placeholder="Your cute name">
                        @error('name')
                            <div class="text-danger small mt-1 ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="cute-label">E-Mail Address</label>
                        <input type="text" name="email" id="email" class="form-control cute-input" value="{{ old('email', $user->email) }}" placeholder="name@example.com">
                        @error('email')
                            <div class="text-danger small mt-1 ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Introduction --}}
                    <div class="mb-4">
                        <label for="introduction" class="cute-label">Introduction</label>
                        <textarea name="introduction" id="introduction" rows="5" class="form-control cute-input" placeholder="Tell us about yourself... 💖">{{ old('introduction', $user->introduction) }}</textarea>
                        @error('introduction')
                            <div class="text-danger small mt-1 ps-2">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Button --}}
                    <div class="text-center mt-5">
                        <button type="submit" class="btn-save-cute">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection