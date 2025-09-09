<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>


                <div class="flex gap-2 p-3">
                    <a href="{{ route('post.index') }}"
                        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Total Posts</h5>
                        <p class="text-xl font-bold text-blue-500  dark:text-gray-400">{{ $totalPosts }}</p>
                    </a>

                    <a href="{{ route('users.index') }}"
                        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Total Users</h5>
                        <p class="text-xl font-bold text-blue-500  dark:text-gray-400">{{ $totalUsers }}</p>
                    </a>

                    <a href="{{ route('category.index') }}"
                        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Total Categories</h5>
                        <p class="text-xl font-bold text-blue-500  dark:text-gray-400">{{ $totalCategories }}</p>
                    </a>


                </div>

            </div>
        </div>
    </div>
</x-app-layout>
