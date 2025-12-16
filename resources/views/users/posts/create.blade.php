@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="category" class="form-label">Category <span class="text-secondary">(up to 3)</span></label>
        </div>
        <div class="mb-3">
            @foreach ($all_categories as $category)
                <div class="form-check form-check-inline">
                    <input type="checkbox" name="category[]" id="category{{ $category->id }}" class="form-check-input" value="{{ $category->id }}">
                    <label for="category{{ $category->id }}" class="form-check-label">{{ $category->name }}</label>
                </div>
            @endforeach
            <!-- Error -->
            @error('category')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" rows="5" class="form-control"
                placeholder="What's on your mind?">{{ old('description') }}</textarea>
            <!-- Error -->
            @error('description')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" aria-describedly="image-info">
            <div class="form-text" id="image-info">
                The acceptable formats are jpeg, jpg, png, gif only<br>
                Max file size is 1048kb.
            </div>
            <!-- Error -->
            @error('image')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary px-5">Post</button>

    </form>

@endsection