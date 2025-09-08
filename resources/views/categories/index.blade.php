<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-500 dark:text-gray-200 leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="bg-white max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="p-3 bg-green-100 border mb-4">{{ session('status') }}</div>
            @endif
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-bold">Categories</h1>
                @can('create', App\Models\Category::class)
                    <a class="underline" href="{{ route('category.create') }}">+ New Category</a>
                @endcan
            </div>
            @forelse($categories as $category)
                <div class="border p-4">

                    <p class="text-sm text-gray-600"> {{ $category->name }}</p>

                    <div class="mt-2 flex gap-3 text-sm">
                        @can('update', $category)
                            <a class="underline" href="{{ route('category.edit', $category) }}">Edit</a>
                        @endcan

                        @can('delete', $category)
                            <form method="POST" action="{{ route('category.destroy', $category) }}">
                                @csrf @method('DELETE')
                                <button class="underline" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        @endcan


                    </div>
                </div>
            @empty
                <p>No posts.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
