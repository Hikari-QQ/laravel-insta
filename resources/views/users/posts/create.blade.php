@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<style>
    /* 全体の背景 */
    body {
        background-color: #FBEFEF;
    }

    .create-container {
        background-color: rgba(255, 255, 255, 0.6);
        border-radius: 20px;
        padding: 40px;
        backdrop-filter: blur(5px);
        margin-top: 2rem;
    }

    /* ラベルの色 */
    .form-label-cute {
        color: #C9B3E0;
        font-weight: bold;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* フォームのデザインをカテゴリー欄と同じ「透ける白」に統一 */
    .form-control-cute {
        border: none;
        background-color: rgba(255, 255, 255, 0.4); /* カテゴリー欄と同じ色 */
        border-radius: 10px;
        padding: 12px 18px;
        color: #5f5f5f;
        transition: all 0.3s;
    }

    .form-control-cute:focus {
        background-color: rgba(255, 255, 255, 0.8); /* フォーカス時は少し白く */
        box-shadow: none;
        outline: none;
    }

    /* チェックボックスのデザイン */
    .form-check-input {
        background-color: #DFF4F8; /* ここだけアクセントで水色残し */
        border: none;
        cursor: pointer;
    }

    .form-check-input:checked {
        background-color: #C8A2FF;
        border-color: #C8A2FF;
    }

    /* カテゴリーエリアの背景（これと同じ色を他に適用しました） */
    .category-box {
        background-color: rgba(255, 255, 255, 0.4);
        border-radius: 15px;
        padding: 15px;
    }

    .category-badge-label {
        font-size: 0.9rem;
        cursor: pointer;
        font-weight: 500;
    }

    /* 投稿ボタン */
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

    .image-info-text {
        font-size: 0.75rem;
        color: #4A4A4A;
        margin-top: 8px;
    }

    .heart {
        color: #BFEAF2;
    }
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7 create-container shadow-sm">
            <h2 class="h4 mb-4 text-center fw-bold" style="color: #ff85a2;">
                <i class="fa-solid fa-heart heart me-2"></i>
                @translate('Create New Post')
                <i class="fa-solid fa-heart heart ms-2"></i>
            </h2>

            <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                
                {{-- Category Area --}}
                <div class="mb-4">
                    <label class="form-label-cute">
                        @translate('Category ')<span class="fw-light small text-muted">(@translate('up to 3'))</span>
                    </label>
                    <div class="category-box">
                        @foreach ($all_categories as $category)
                            <div class="form-check form-check-inline">
                                <input type="checkbox" name="category[]" id="category{{ $category->id }}" 
                                    class="form-check-input shadow-none" value="{{ $category->id }}">
                                <label for="category{{ $category->id }}" class="form-check-label category-badge-label">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    @error('category')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Description Area --}}
                <div class="mb-4">
                    <label for="description" class="form-label-cute">@translate('Description')</label>
                    <textarea name="description" id="description" rows="5" 
                        class="form-control form-control-cute"
                        placeholder="@translate('What\'s on your mind?')">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Image Area --}}
                <div class="mb-5">
                    <label for="image" class="form-label-cute">@translate('Image')</label>
                    <input type="file" name="image" id="image" class="form-control form-control-cute" aria-describedby="image-info">
                    <div class="image-info-text" id="image-info">
                        <i class="fa-solid fa-circle-info me-1" style="color: #DFF4F8;"></i>
                        Formats: jpeg, jpg, png, gif only (Max: 1048kb)
                    </div>
                    @error('image')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <div class="text-center">
                    <button type="submit" class="btn btn-post shadow-sm">
                        <i class="fa-solid fa-paper-plane me-2"></i>@translate('Post')
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection