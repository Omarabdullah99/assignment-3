<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use AuthorizesRequests; // Trait ব্যবহার করুন ✅
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user();

        $posts = Post::query()
            ->when($user->role !== 'editor' && $user->role !== 'admin', function ($q) use ($user) {
                $q->where(function ($qq) use ($user) {
                    $qq->where('is_published', true)
                        ->orWhere('user_id', $user->id);
                });
            })->get();

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $this->authorize('create', Post::class);
        return view('posts.create', [
            'categories' => Category::latest()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create', Post::class);
        $data = $request->validate([
            'title' => 'required|string|max:30',
            'body' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
        ]);

        auth()->user()->posts()->create($data + ['is_published' => false]);

        return redirect()->route('post.index')->with('status', 'Post created (draft)');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $this->authorize('view', $post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', [
            'post' => $post->load('user', 'category'),
            'categories' => Category::latest()->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = $request->validate([
            'title' => 'required|string|max:30',
            'body' => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update($data);

        return redirect()->route('post.index')->with('status', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        return redirect()->route('post.index')->with('status', 'Deleted');
    }

    public function publish(Post $post)
    {
        $this->authorize('publish', $post);
        $post->update(['is_published' => true]);

        return redirect()->route('post.index')->with('status', 'Published');
    }
}
