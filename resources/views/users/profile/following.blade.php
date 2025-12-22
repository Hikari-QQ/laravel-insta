@extends('layouts.app')

@section('title', 'Following')

@section('content')
<style>
 
    body, #app, main { background-color: #FBEFEF !important; }
    .suggestion-title-text { color: #F08FB3; font-weight: bold; text-decoration: none !important; display: flex; align-items: center; justify-content: center; gap: 10px; margin-bottom: 25px; font-size: 1.5rem; }
    .icon-blue-light { color: #BFEAF2; }
    .follow-list-card-square { background: #ffffff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); border: 1px solid #eee; }
    .follow-item { transition: all 0.2s ease; border-radius: 4px; padding: 10px; }
    .follow-item:hover { background-color: #FBEFEF; }
    .btn-follow-square { background-color: #DFF4F8 !important; color: #37353E !important; border: none !important; border-radius: 4px !important; font-weight: bold; font-size: 0.75rem; padding: 5px 15px !important; transition: 0.3s; }
    .btn-following-square { background-color: #f8f9fa !important; color: #adb5bd !important; border: 1px solid #dee2e6 !important; border-radius: 4px !important; font-weight: bold; font-size: 0.75rem; padding: 5px 15px !important; }
    .text-pink { color: #F08FB3; }
</style>

@include('users.profile.header')

<div class="container" style="margin-top: 60px">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            {{-- タイトル：下線なし・水色のハート --}}
            <div class="suggestion-title-text">
                <i class="fa-solid fa-heart icon-blue-light"></i>
                Following
                <i class="fa-solid fa-heart icon-blue-light"></i>
            </div>

            <div class="follow-list-card-square">
                @forelse ($user->following as $follow)
                    <div class="row align-items-center mb-2 follow-item">
                        <div class="col-auto">
                            <a href="{{ route('profile.show', $follow->following->id) }}">
                                @if ($follow->following->avatar)
                                    <img src="{{ $follow->following->avatar }}" class="rounded-circle" width="45" height="45" style="object-fit: cover;">
                                @else
                                    <i class="fa-solid fa-circle-user text-pink" style="font-size: 45px;"></i>
                                @endif
                            </a>
                        </div>
                        <div class="col ps-2 text-truncate">
                            <a href="{{ route('profile.show', $follow->following->id) }}" class="text-decoration-none text-dark fw-bold" style="font-size: 0.9rem;">
                                {{ $follow->following->name }}
                            </a>
                        </div>
                        <div class="col-auto text-end">
                            @if(Auth::id() !== $follow->following->id)
                                @if ($follow->following->isFollowed())
                                    <form action="{{ route('follow.destroy', $follow->following->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-following-square">Following</button>
                                    </form>
                                @else
                                    <form action="{{ route('follow.store', $follow->following->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-follow-square">Follow</button>
                                    </form>
                                @endif
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted mb-0 py-3">Not following anyone yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection