<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests; // ✅ এই line টি add করুন

class CategoryController extends Controller
{

    use AuthorizesRequests; // Trait ব্যবহার করুন ✅
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $this->authorize('view', Category::class); // ✅ সঠিক policy method call
        return view('categories.index', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Category::class);
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->authorize('create', Category::class);
        $data = $request->validate([
            'name' => 'required|string|min:3'

        ]);

        auth()->user()->categories()->create($data);

        return redirect()->route('category.index')->with('status', 'Post created (draft)');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);

        $data = $request->validate([
            'name' => 'required|string|min:3'

        ]);

        $category->update($data);

       return redirect()->route('category.index')->with('status', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();

        return redirect()->route('category.index')->with('status', 'Deleted');
    }
}
