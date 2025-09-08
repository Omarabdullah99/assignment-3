<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-500 dark:text-gray-200 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="p-3 bg-green-100 border mb-4">{{ session('status') }}</div>
            @endif
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">Posts</h1>
                @can('create', App\Models\Post::class)
                    <a class="underline" href="{{ route('post.create') }}">+ New Post</a>
                @endcan


            </div>
            @forelse($posts as $post)
                <div class="border p-4">

                    <h2 class="font-semibold">
                        <a href="{{ route('post.show', $post) }}">{{ $post->title }}</a>
                        @unless ($post->is_published)
                            <span class="text-sm text-orange-600">(draft)</span>
                        @endunless
                    </h2>
                    <p class="text-sm text-gray-600">by {{ $post->user->name }}</p>

                    <div class="mt-2 flex gap-3 text-sm">

                        @can('update', $post)
                            <a class="underline" href="{{ route('post.edit', $post) }}">Edit</a>
                        @endcan

                        @can('delete', $post)
                            <form method="POST" action="{{ route('post.destroy', $post) }}">
                                @csrf @method('DELETE')
                                <button class="underline" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        @endcan

                        @can('publish', $post)
                            @if (!$post->is_published)
                                <form method="POST" action="{{ route('post.publish', $post) }}">
                                    @csrf
                                    <button class="underline">Publish</button>
                                </form>
                            @endif
                        @endcan


                    </div>
                </div>
            @empty
                <p>No posts.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
