@extends('layouts.app')

@section('title', $user->name)

@section('content')
    @include('users.profile.header')

    {{-- Show all posts --}}
    <div style="margin-top: 100px">
        @if ($user->followers->isNotEmpty())
            <div class="row">
                <h3 class="text-muted text-center">Followers</h3>
                <div class="col-4 mx-auto">
                    @foreach ($user->followers as $follow)
                        <div class="row align-items-center py-2">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $follow->follower->id) }}">
                                    @if ($follow->follower->avatar)
                                        <img src="{{ $follow->follower->avatar }}" alt="{{ $follow->follower->name }}"
                                            class="rounded-circle avatar-md">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0">
                                <a href="{{ route('profile.show', $follow->follower->id) }}"
                                    class="text-decoration-none text-dark fw-bold">{{ $follow->follower->name }}</a>
                            </div>
                            <div class="col text-end">
                                @if(Auth::user()->id !== $follow->follower->id)
                                    @if ($follow->follower->isFollowed())
                                        <form action="{{ route('follow.destroy', $follow->follower->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow.store', $follow->follower->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-secondary btn-sm fw-bold">Follow</button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @else
            <h3 class="text-muted text-center">No Followers</h3>
        @endif
    </div>
@endsection