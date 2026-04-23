<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function index(): View
    {
        Gate::authorize('category.view');
        $categories = Category::with('parent')->latest()->paginate(20);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create(): View
    {
        Gate::authorize('category.create');
        $parents = Category::all();
        return view('dashboard.categories.create', compact('parents'));
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        Category::create($request->validated());
        return redirect()->route('dashboard.categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category): View
    {
        Gate::authorize('category.view');
        return view('dashboard.categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        Gate::authorize('category.edit');
        $parents = Category::where('id', '!=', $category->id)->get();
        return view('dashboard.categories.edit', compact('category', 'parents'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return redirect()->route('dashboard.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        Gate::authorize('category.delete');
        $category->delete();
        return redirect()->route('dashboard.categories.index')->with('success', 'Category deleted successfully.');
    }
}
