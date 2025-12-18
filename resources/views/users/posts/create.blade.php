@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<style>
    .create-container {
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 20px;
        padding: 40px;
        backdrop-filter: blur(5px);
        color: var(--piki-gray-main);
    }

    .form-label {
        color: #C9B3E0;
        font-weight: bold;
        margin-bottom: 0.5rem;
    }

    /* 入力フィールドのデザイン */
    .form-control, .form-check-input {
        border: none;
        background-color: #DFF4F8; /* 水色の背景 */
        border-radius: 10px;
        color: #5f5f5f;
    }

    .form-control:focus {
        background-color: #d2f0f5;
        box-shadow: none;
        outline: none;
    }

    /* チェックボックスの色を紫に */
    .form-check-input:checked {
        background-color: #C8A2FF;
        border-color: #C8A2FF;
    }

    /* 投稿ボタン（水色） */
    .btn-post {
        background-color: #AEDEFC;
        color: #4A4A4A;
        border: none;
        border-radius: 50px;
        padding: 10px 40px;
        font-weight: bold;
        transition: all 0.3s;
    }

    .btn-post:hover {
        background-color: #9cd4f8;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .image-info-text {
        font-size: 0.75rem;
        color: var(--piki-gray-soft);
        margin-top: 5px;
    }

    .category-badge-label {
        font-size: 0.9rem;
        color: #6f6f6f;
        cursor: pointer;
    }
</style>

<div class="row justify-content-center">
    <div class="col-8 create-container shadow-sm">
        <h2 class="h4 mb-4 text-center fw-bold" style="color: #ff85a2;">Create New Post</h2>

        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="form-label">Category <span class="fw-light small text-muted">(up to 3)</span></label>
                <div class="p-3 border-0 rounded" style="background-color: rgba(255,255,255,0.4);">
                    @foreach ($all_categories as $category)
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="category[]" id="category{{ $category->id }}" class="form-check-input shadow-none" value="{{ $category->id }}">
                            <label for="category{{ $category->id }}" class="form-check-label category-badge-label">{{ $category->name }}</label>
                        </div>
                    @endforeach
                </div>
                @error('category')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" rows="5" class="form-control"
                    placeholder="What's on your mind?">{{ old('description') }}</textarea>
                @error('description')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" id="image" class="form-control" aria-describedby="image-info">
                <div class="image-info-text" id="image-info">
                    <i class="fa-solid fa-circle-info me-1" style="color: #AEDEFC;"></i>
                    Formats: jpeg, jpg, png, gif only (Max: 1048kb)
                </div>
                @error('image')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-post px-5 shadow-sm">
                    <i class="fa-solid fa-paper-plane me-2"></i>Post
                </button>
            </div>
        </form>
    </div>
</div>

@endsection