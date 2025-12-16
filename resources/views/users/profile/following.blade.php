@extends('layouts.app')

@section('title', $user->name)

@section('content')
    @include('users.profile.header')

    {{-- Show all posts --}}
    <div style="margin-top: 100px">
        @if ($user->following->isNotEmpty())
            <div class="row">
                <h3 class="text-muted text-center">Following</h3>
                <div class="col-4 mx-auto">
                    @foreach ($user->following as $follow)
                        <div class="row align-items-center py-2">
                            <div class="col-auto">
                                <a href="{{ route('profile.show', $follow->following->id) }}">
                                    @if ($follow->following->avatar)
                                        <img src="{{ $follow->following->avatar }}" alt="{{ $follow->following->name }}"
                                            class="rounded-circle avatar-md">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                    @endif
                                </a>
                            </div>
                            <div class="col ps-0">
                                <a href="{{ route('profile.show', $follow->following->id) }}"
                                    class="text-decoration-none text-dark fw-bold">{{ $follow->following->name }}</a>
                            </div>
                            <div class="col text-end">
                                @if(Auth::user()->id !== $follow->following->id)
                                    @if ($follow->following->isFollowed())
                                        <form action="{{ route('follow.destroy', $follow->following->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-secondary btn-sm fw-bold">Following</button>
                                        </form>
                                    @else
                                        <form action="{{ route('follow.store', $follow->following->id) }}" method="post">
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
            <h3 class="text-muted text-center">No Following</h3>
        @endif
    </div>
@endsection