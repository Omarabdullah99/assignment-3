<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-blue-500 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($errors->any())
                        <div class="p-3 bg-red-100 border mb-4">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="max-w-sm mx-auto" action="{{ route('post.update', $post) }}" method="POST">
                        @csrf @method('PATCH')
                        <div class="mb-5">
                            <label class="block">Title</label>
                            <input name="title" class="border p-2 w-full" value="{{ old('title', $post->title) }}">
                        </div>

                        <div class="mb-5">
                            <label class="block">Body</label>
                            <textarea name="body" class="border p-2 w-full" rows="6">{{ old('body', $post->body) }}</textarea>

                        </div>

                        <div class="mb-5">


                            <label for="category_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categories</label>

                            <select
                                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 dark:focus:border-indigo-600 dark:focus:ring-indigo-600"
                                id="category_id" name="category_id" required>
                                <option selected>Choose a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected(old('category_id', $post->category->id) == $category->id)>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>

                        </div>

                        <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
