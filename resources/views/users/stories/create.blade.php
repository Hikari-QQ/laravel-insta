@extends('layouts.app')

@section('title', 'Add Story')

@section('content')
<style>
    /* 1. 外部の背景やグラデーションを完全に上書きして白くする */
    body, #app, main {
        background-color: #ffffff !important;
        background: #ffffff !important;
    }

    /* 2. 画面中央に配置するためのラッパー（背景は白） */
    .story-page-wrapper {
        background-color: #ffffff;
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    /* 3. カードのデザイン：影を繊細にして浮遊感を出す */
    .story-card {
        border: none;
        border-radius: 30px;
        background-color: #ffffff;
        box-shadow: 0 15px 40px rgba(183, 156, 156, 0.12); /* ほんのりピンク系の繊細な影 */
        overflow: hidden;
    }

    .card-header-cute {
        background: transparent;
        border: none;
        padding: 2.5rem 1rem 1rem 1rem;
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
        margin: 0;
    }

    .header-heart {
        width: 20px;
        height: 20px;
        fill: #BFEAF2;
    }

    /* 4. アップロードエリア */
    .file-input-wrapper {
        border: 2px dashed #BFEAF2;
        border-radius: 20px;
        padding: 30px 15px;
        text-align: center;
        background-color: #fffafb;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .file-input-wrapper:hover {
        border-color: #F08FB3;
        background-color: #ffffff;
        transform: scale(1.02);
    }

    .form-label-cute {
        color: #a08f8f;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* 5. 投稿ボタン */
    .btn-cute-post {
        background-color: #BFEAF2 !important;
        color: #F08FB3 !important;
        border: none !important;
        border-radius: 25px;
        padding: 12px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .btn-cute-post:hover {
        background-color: #C9ECF3 !important;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(191, 234, 242, 0.4);
    }

    /* 6. 戻るリンク */
    .btn-cute-cancel {
        color: #F08FB3;
        font-size: 0.9rem;
        text-decoration: none !important;
        font-weight: 500;
        opacity: 0.7;
    }

    .btn-cute-cancel:hover {
        opacity: 1;
        color: #E46A9A;
    }
</style>
<div class="custom-container py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card story-card">
                    <div class="card-header-cute">
                        <h5 class="mb-0">
                            <svg class="header-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z"/></svg>
                            Create New Story
                            <svg class="header-heart" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640"><path d="M305 151.1L320 171.8L335 151.1C360 116.5 400.2 96 442.9 96C516.4 96 576 155.6 576 229.1L576 231.7C576 343.9 436.1 474.2 363.1 529.9C350.7 539.3 335.5 544 320 544C304.5 544 289.2 539.4 276.9 529.9C203.9 474.2 64 343.9 64 231.7L64 229.1C64 155.6 123.6 96 197.1 96C239.8 96 280 116.5 305 151.1z"/></svg>
                        </h5>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-4 text-center">
                                <label for="story_image" class="form-label-cute mb-3">Pick your favorite moment</label>
                                <div class="file-input-wrapper">
                                    <input class="form-control border-0 bg-transparent" type="file" id="story_image" name="story_image" required>
                                    <div class="form-text mt-3" style="color: #c0b3b3; font-size: 0.8rem;">
                                        JPG, PNG or GIF (Max 5MB)
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-grid gap-3">
                                <button type="submit" class="btn btn-cute-post">Post My Story</button>
                                <a href="{{ url()->previous() }}" class="btn btn-link btn-cute-cancel text-center">Back to Feed</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection





