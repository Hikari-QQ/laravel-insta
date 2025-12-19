@extends('layouts.app')

@section('title', 'Add Story')

@section('content')
<style>
    /* 全体の背景：ホーム画面と調和する淡いグレーベージュのグラデーション */
    .custom-container {
        background: linear-gradient(135deg, #fdfbfb 0%, #ebedee 100%);
        min-height: 90vh;
        display: flex;
        align-items: center;
    }

    /* カード：柔らかい影と大きな角丸 */
    .story-card {
        border: none;
        border-radius: 25px;
        background-color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    }

    .card-header-cute {
        background: transparent;
        border-bottom: 1px solid #f3ecec;
        padding: 1.5rem;
        text-align: center;
    }

    .card-header-cute h5 {
        color: #F08FB3; /* ホーム画面と同じピンク */
        font-weight: 700;
        letter-spacing: 0.5px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }

    /* ハートアイコン（水色） */
    .header-heart {
        width: 18px;
        height: 18px;
        fill: #BFEAF2;
    }

    /* 入力エリアのラベル */
    .form-label-cute {
        color: #8d7d7d;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* ファイルアップロードエリア（点線） */
    .file-input-wrapper {
        border: 2px dashed #BFEAF2; /* 水色の点線 */
        border-radius: 20px;
        padding: 40px 20px;
        text-align: center;
        background-color: #fdfdfd;
        transition: all 0.3s ease;
    }

    .file-input-wrapper:hover {
        border-color: #F08FB3; /* ホバーでピンクに */
        background-color: #fff9fb;
    }

    /* メインボタン：水色背景 × ピンク文字 (ホーム画面のAdd Storyボタンと統一) */
    .btn-cute-post {
        background-color: #BFEAF2 !important;
        color: #F08FB3 !important;
        border: none !important;
        border-radius: 20px;
        padding: 12px;
        font-weight: 700;
        transition: all 0.3s;
    }

    .btn-cute-post:hover {
        background-color: #C9ECF3 !important;
        color: #E46A9A !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    /* 戻るボタン：文字ピンク・アンダーライン */
    .btn-cute-cancel {
        color: #F08FB3;
        font-size: 0.9rem;
        text-decoration: underline !important;
        font-weight: 500;
        transition: color 0.2s;
    }

    .btn-cute-cancel:hover {
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




