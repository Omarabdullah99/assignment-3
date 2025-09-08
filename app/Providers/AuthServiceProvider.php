<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Policies\CategoryPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider; // ✅ ঠিক এটা লাগবে
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Category::class => CategoryPolicy::class, // <- Full namespace দিতে হবে
        Post::class => PostPolicy::class

    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerPolicies(); // ✅ এখন আর error আসবে না
    }
}
