<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\UnitOfMeasure;
use App\Models\Branch;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function index(): View
    {
        Gate::authorize('product.view');
        $products = Product::with(['category', 'unit', 'branch'])->latest()->paginate(20);
        return view('dashboard.products.index', compact('products'));
    }

    public function create(): View
    {
        Gate::authorize('product.create');
        $categories = Category::all();
        $units = UnitOfMeasure::all();
        $branches = Branch::all();
        return view('dashboard.products.create', compact('categories', 'units', 'branches'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        Product::create($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show(Product $product): View
    {
        Gate::authorize('product.view');
        return view('dashboard.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        Gate::authorize('product.edit');
        $categories = Category::all();
        $units = UnitOfMeasure::all();
        $branches = Branch::all();
        return view('dashboard.products.edit', compact('product', 'categories', 'units', 'branches'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        Gate::authorize('product.delete');
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
