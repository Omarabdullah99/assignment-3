<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalPosts = Post::count();
        $totalCategories = Category::count();

        return view('dashboard', compact('totalUsers', 'totalPosts', 'totalCategories'));
    }
}
