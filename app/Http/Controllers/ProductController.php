<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\UnitOfMeasure;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $this->authorize('product.view');
        $products = Product::with(['category', 'unit'])->latest()->paginate(20);
        return view('products.index', compact('products'));
    }

    public function create(): View
    {
        $this->authorize('product.create');
        $categories = Category::all();
        $units      = UnitOfMeasure::all();
        return view('products.create', compact('categories', 'units'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $product = Product::create(array_merge($request->validated(), [
            'branch_id'  => auth()->user()->branch_id,
            'created_by' => auth()->id(),
        ]));
        return redirect()
            ->route('dashboard.products.show', $product)
            ->with('success', 'تم إنشاء المنتج بنجاح.');
    }

    public function show(Product $product): View
    {
        $this->authorize('product.view');
        return view('products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $this->authorize('product.edit');
        $categories = Category::all();
        $units      = UnitOfMeasure::all();
        return view('products.edit', compact('product', 'categories', 'units'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->update(array_merge($request->validated(), [
            'updated_by' => auth()->id(),
        ]));
        return redirect()
            ->route('dashboard.products.show', $product)
            ->with('success', 'تم تحديث المنتج بنجاح.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->authorize('product.delete');
        $product->delete();
        return redirect()
            ->route('dashboard.products.index')
            ->with('success', 'تم حذف المنتج بنجاح.');
    }

    /**
     * Adjust product stock quantity.
     * type=set: replace quantity; type=add: increment; type=subtract: decrement.
     */
    public function adjustStock(Request $request, Product $product): RedirectResponse
    {
        $this->authorize('product.adjust_stock');

        $validated = $request->validate([
            'quantity' => 'required|numeric|min:0',
            'type'     => 'required|in:set,add,subtract',
        ]);

        try {
            DB::transaction(function () use ($product, $validated) {
                $product = Product::lockForUpdate()->findOrFail($product->id);

                match ($validated['type']) {
                    'set'      => $product->update(['quantity' => $validated['quantity']]),
                    'add'      => $product->incrementStock((float) $validated['quantity']),
                    'subtract' => $product->decrementStock((float) $validated['quantity']),
                };
            });
        } catch (\RuntimeException $e) {
            return back()->withErrors(['quantity' => $e->getMessage()]);
        }

        return back()->with('success', 'تم تعديل المخزون بنجاح.');
    }
}
