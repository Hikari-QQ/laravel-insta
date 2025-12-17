@extends('layouts.app')
 
@section('title', 'Story add')
 
@section('content')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Create Story</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('stories.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="story_image" class="form-label">Select Image</label>
                            <input class="form-control" type="file" id="story_image" name="story_image" required>
                            <div class="form-text">Choose a photo for your story.</div>
                        </div>

                        {{-- 有効期限（5分後）を隠しフィールドで送信 --}}
                        <input type="hidden" name="expires_at" value="{{ now()->addMinutes(5)->format('Y-m-d H:i:s') }}">

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Post Story</button>
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
 




