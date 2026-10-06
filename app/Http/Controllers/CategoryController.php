<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    // Browse
    public function index()
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    // Add (form)
    public function create()
    {
        return view('categories.create');
    }

    // Add (store)
    public function store(StoreCategoryRequest $request)
    {
        Category::create($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    // Read
    public function show(Category $category)
    {
        $category->load('products'); // relasi hasMany
        return view('categories.show', compact('category'));
    }

    // Edit (form)
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Edit (update)
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    // Delete
    public function destroy(Category $category)
    {
        $productCount = $category->products()->count();
        $category->delete(); // cascade akan menghapus produk terkait (FK on delete cascade)

        return redirect()
            ->route('categories.index')
            ->with('success', "Kategori dihapus. {$productCount} produk terkait juga ikut terhapus.");
    }
}