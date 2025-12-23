@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<style>
    /* 全体の背景：Registerと同じ薄いピンク */
    body {
        background-color: #FBEFEF !important; 
    }

    .edit-post-wrapper {
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

    /* タイトルの文字色（ピンク） */
    .page-title {
        color: #ff85a2;
        font-weight: bold;
        text-align: center;
        margin-bottom: 2rem;
    }

    /* ハートの色だけ水色に指定 */
    .heart-blue {
        color: #BFEAF2; /* 水色 */
    }

    /* 入力フォーム：Registerと同じスタイル */
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

    /* ラベル */
    .cute-label {
        color: #C9B3E0;
        font-weight: bold;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* 保存ボタン：水色背景 #DFF4F8 × 黒文字 #37353E × 四角 */
    .btn-save-post {
        background-color: #DFF4F8 !important; 
        color: #37353E !important;           
        border: none !important;
        border-radius: 4px !important;
        padding: 12px 50px;
        font-weight: bold;
        transition: all 0.3s;
        cursor: pointer;
    }

    .btn-save-post:hover {
        background-color: #BFEAF2 !important;
        transform: translateY(-2px);
    }

    /* プレビュー画像 */
    .current-post-img {
        border-radius: 15px;
        border: 4px solid #fff;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
</style>

<div class="edit-post-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-8">
                
                <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data" class="cute-form-card">
                    @csrf
                    @method('PATCH')

                    <div class="text-center mb-5">
                        <h2 class="h4 page-title">
                            {{-- ハートに heart-blue クラスを適用 --}}
                            <i class="fa-solid fa-heart heart-blue me-2"></i>
                            Edit Post
                            <i class="fa-solid fa-heart heart-blue ms-2"></i>
                        </h2>
                    </div>

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="cute-label">Category <span class="text-muted small fw-normal">(up to 3)</span></label>
                        <div class="p-3 rounded" style="background: rgba(255,255,255,0.3);">
                            @foreach ($all_categories as $category)
                                <div class="form-check form-check-inline">
                                    <input type="checkbox" name="category[]" id="category{{ $category->id }}" class="form-check-input"
                                           value="{{ $category->id }}" {{ in_array($category->id, $selected_categories) ? 'checked' : '' }}>
                                    <label for="category{{ $category->id }}" class="form-check-label text-secondary">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                        @error('category')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label for="description" class="cute-label">Description</label>
                        <textarea name="description" id="description" rows="5" class="form-control cute-input"
                            placeholder="What's on your mind?">{{ old('description', $post->description) }}</textarea>
                        @error('description')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Image --}}
                    <div class="row mb-5">
                        <div class="col-lg-6">
                            <label class="cute-label">Current Image</label>
                            <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="img-fluid current-post-img mb-3">
                        </div>
                        <div class="col-lg-6">
                            <label for="image" class="cute-label">Upload New Image</label>
                            <input type="file" name="image" id="image" class="form-control cute-input">
                            <div class="mt-2 small text-muted">
                                <i class="fa-regular fa-image me-1"></i> jpeg, jpg, png, gif (Max 1MB)
                            </div>
                            @error('image')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Button --}}
                    <div class="text-center">
                        <button type="submit" class="btn-save-post shadow-sm">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection