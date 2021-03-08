@props(['post'=> $post])

<div class="mb-4">
    <a href="{{ route('user.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a>
    <span class="text-gray-600 text-sm">{{ $post->created_at->diffForhumans() }}</span>
    <p class="mb-2">{{ $post->body }}</p>


    @can('delete', $post)


        <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf
            <input type="submit" value="delete" class="text-blue-500 bg-white">
            @method('DELETE')
        </form>
    @endcan


    <div class="flex items-center">
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf
                    <input type="submit" value="Like" class="text-blue-500 bg-white">
                </form>
            @else
                <form action="{{ route('posts.likes', $post) }}" method="post" class="mr-1">
                    @csrf

                    <input type="submit" value="Unlike" class="text-blue-500 bg-white">
                    @method('DELETE')
                </form>

            @endif

        @endauth
        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
    </div>
</div>
