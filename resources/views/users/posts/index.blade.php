@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                <p><span class="text-blue-500">Published:</span> {{ $posts->count() }} {{ Str::plural('Post', $posts->count()) }} | <span class="text-blue-500">Received:</span> {{ $user->receivedLikes->count() }} {{ Str::plural('Like', $user->receivedLikes->count()) }}</p>
            </div>
            <div class="bg-white p-6 rounded-lg">
                @if($posts->count())
                @foreach($posts as $post)
                    <div>
                        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>

                        <p class="mb-2"><a href="{{ route('posts.show', $post) }}">{{ $post->body }}</a></p>
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
                @endforeach

            {{ $posts->links() }}
            @else
            <p>You have no post yet.</p>
            @endif
            </div>
        </div>
    </div>
@endsection