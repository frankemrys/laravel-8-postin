@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div>
                <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

                <p class="mb-2">{{ $post->body }}</p>
            </div>
            @can('delete', $post)
                <form action="{{ route('posts.destroy', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500">Delete</button>
                </form>
            @endcan

            <div class="flex items-center mb-4">
                @auth
                    @if(!$post->likedBy(auth()->user()))
                        <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                            @csrf
                            <button type="submit" class="text-blue-500">Like</button>
                        </form>
                    @else
                        <form action="{{ route('posts.likes', $post->id) }}" method="post" class="mr-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-blue-500">Unlike</button>
                        </form>
                    @endif
                @endauth

                <span><strong>{{ $post->likes->count() }}</strong> {{ Str::plural('like', $post->likes->count()) }}</span>
            </div>
        </div>
    </div>
@endsection