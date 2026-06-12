<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::whereNull('parent_id')->with('children')->get();
        return view('admin.category.index', ['data' => $data]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.category.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|boolean',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only(['parent_id', 'title', 'keywords', 'description', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category = Category::create($data);

        return redirect()->route('admin.category.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.category.show', ['category' => $category]);
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('admin.category.edit', [
            'category' => $category,
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'keywords' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|boolean',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $data = $request->only(['parent_id', 'title', 'keywords', 'description', 'status']);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->route('admin.category.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
