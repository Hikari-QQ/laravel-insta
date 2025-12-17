@extends('layouts.app')
 
@section('title', 'Story Home')
 
@section('content')

<div class="story-bar d-flex overflow-auto p-2">
    @foreach ($home_stories as $story)
        <a href="{{ route('stories.show', $story->id) }}"
           class="story-item text-center mx-2 text-decoration-none text-dark">

            <img src="{{ $story->user->avatar }}"
                 class="rounded-circle"
                 width="70"
                 height="70">

            <p class="small">{{ $story->user->name }}</p>
        </a>
    @endforeach
</div>
    
@endsection
 
