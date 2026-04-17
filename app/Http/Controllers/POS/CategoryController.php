<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('category.view');
        return CategoryResource::collection($this->service->getAll());
    }

    public function store(Request $request)
    {
        $this->authorize('category.create');
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'ar_name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        return new CategoryResource($this->service->create($data));
    }

    public function show(Category $category)
    {
        $this->authorize('category.view');
        return new CategoryResource($category);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('category.edit');
        $data = $request->validate([
            'name' => 'string|max:255',
            'ar_name' => 'string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $this->service->update($category, $data);
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $this->authorize('category.delete');
        $this->service->delete($category);
        return response()->noContent();
    }
}
