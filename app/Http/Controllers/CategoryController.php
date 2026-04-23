<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $this->authorize('category.view');
        $categories = Category::with('parent')->latest()->paginate(20);
        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        $this->authorize('category.create');
        $parents = Category::all();
        return view('categories.create', compact('parents'));
    }

    public function store(StoreCategoryRequest $request): RedirectResponse
    {
        $category = Category::create($request->validated());
        return redirect()
            ->route('dashboard.categories.show', $category)
            ->with('success', 'تم إنشاء الفئة بنجاح.');
    }

    public function show(Category $category): View
    {
        $this->authorize('category.view');
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category): View
    {
        $this->authorize('category.edit');
        $parents = Category::where('id', '!=', $category->id)->get();
        return view('categories.edit', compact('category', 'parents'));
    }

    public function update(UpdateCategoryRequest $request, Category $category): RedirectResponse
    {
        $category->update($request->validated());
        return redirect()
            ->route('dashboard.categories.show', $category)
            ->with('success', 'تم تحديث الفئة بنجاح.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $this->authorize('category.delete');
        $category->delete();
        return redirect()
            ->route('dashboard.categories.index')
            ->with('success', 'تم حذف الفئة بنجاح.');
    }
}
