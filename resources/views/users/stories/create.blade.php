@extends('layouts.app')

@section('title', 'Add Story')

@section('content')
<style>
    /* 全体の背景をLogin/Post作成画面と統一 */
    body {
        background-color: #FFE4E8;
    }

    .story-container {
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 20px;
        padding: 40px;
        backdrop-filter: blur(5px);
        margin-top: 2rem;
    }

    /* ラベルの色（Post作成画面の紫に統一） */
    .form-label-cute {
        color: #C9B3E0;
        font-weight: bold;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* 入力フィールドのデザイン（Post作成画面の水色に統一） */
    .form-control-cute {
        border: none;
        background-color: #DFF4F8;
        border-radius: 10px;
        padding: 12px 18px;
        color: #5f5f5f;
    }

    .form-control-cute:focus {
        background-color: #d2f0f5;
        box-shadow: none;
        outline: none;
    }

    /* アップロードエリアの点線枠 */
    .file-input-wrapper {
        border: 2px dashed #AEDEFC;
        border-radius: 20px;
        padding: 30px 15px;
        text-align: center;
        background-color: rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }

    .file-input-wrapper:hover {
        border-color: #ff85a2;
        background-color: rgba(255, 255, 255, 0.8);
    }

    /* 投稿ボタン（Post作成画面のスタイルに統一） */
    .btn-post {
        background-color: #DFF4F8;
        color: #4A4A4A;
        border: none;
        border-radius: 50px;
        padding: 12px 40px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .btn-post:hover {
        background-color: #9cd4f8;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    /* 戻るリンク */
    .btn-cancel {
        color: #ff85a2;
        text-decoration: none;
        font-weight: bold;
        font-size: 0.9rem;
        transition: 0.3s;
    }

    .btn-cancel:hover {
        color: #E46A9A;
    }

    .heart {
        color: #ff85a2;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5 story-container shadow-sm">
            <h2 class="h4 mb-4 text-center fw-bold" style="color: #ff85a2;">
                <i class="fa-solid fa-heart heart me-2"></i>
                Create New Story
                <i class="fa-solid fa-heart heart ms-2"></i>
            </h2>

            <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-4">
                    <label for="story_image" class="form-label-cute text-center">Pick your favorite moment</label>
                    <div class="file-input-wrapper">
                        <input class="form-control form-control-cute border-0 bg-transparent" type="file" id="story_image" name="story_image" required>
                        <div class="form-text mt-3" style="color: #a08f8f; font-size: 0.8rem;">
                            <i class="fa-solid fa-circle-info me-1" style="color: #DFF4F8;"></i>
                            JPG, PNG or GIF (Max 5MB)
                        </div>
                    </div>
                    @error('story_image')
                        <div class="text-danger small mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-center d-grid gap-3">
                    <button type="submit" class="btn btn-post shadow-sm">
                        <i class="fa-solid fa-paper-plane me-2"></i>Post My Story
                    </button>
                    <a href="{{ url()->previous() }}" class="btn-cancel">
                        <i class="fa-solid fa-arrow-left me-1"></i> Back to Feed
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection