@extends('layouts.app')

@section('title', 'Admin: Posts')

@section('content')
    <table class="table table-hover align-middle bg-white text-secondary">
        <thead class="small table-primary text-secondary">
            <tr>
                <th></th>
                <th></th>
                <th>CATEGORY</th>
                <th>OWNER</th>
                <th>CREATED AT</th>
                <th>STATUS</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($all_posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>
                        <a href="{{ route('post.show', $post->id) }}">
                            <img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="d-block mx-auto avatar-lg">
                        </a>
                    </td>
                    <td>
                        @if ($post->categoryPost->count() != 0)
                            @foreach ($post->categoryPost as $category_post)
                                <div class="badge bg-secondary bg-opacity-50">
                                    {{ $category_post->category->name }}
                                </div>
                            @endforeach
                        @else
                            <div class="badge bg-opacity-50" style="background-color: black;">Uncategorized</div>
                        @endif

                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        @if ($post->trashed())
                            <i class="fa-solid fa-circle-minus text-secondary"></i>&nbsp; Hidden
                        @else
                            <i class="fa-solid fa-circle text-primary"></i>&nbsp; Visible
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-sm" data-bs-toggle="dropdown">
                                <i class="fa-solid fa-ellipsis"></i>
                            </button>

                            <div class="dropdown-menu">
                                @if ($post->trashed())
                                    <button class="dropdown-item" data-bs-toggle="modal"
                                        data-bs-target="#visible-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye"></i> Unhide Post {{ $post->id }}
                                    </button>
                                @else
                                    <button class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#hidden-post-{{ $post->id }}">
                                        <i class="fa-solid fa-eye-slash"></i> Hide Post {{ $post->id }}
                                    </button>
                                @endif
                            </div>
                        </div>
                        {{-- Include modal here --}}
                        @include('admin.posts.modals.status')
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- <div class="d-flex justify-content-center">
        {{ $all_users->links() }}
    </div> --}}
@endsection