<?php

namespace App\Http\Controllers\POS;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $this->authorize('product.view');
        return ProductResource::collection($this->service->getAll());
    }

    public function store(Request $request)
    {
        $this->authorize('product.create');
        // Validation would normally be in a separate FormRequest
        $data = $request->validate([
            'code_id' => 'required|string|unique:products',
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'branch_id' => 'required|exists:branches,id',
            'sell_price' => 'numeric',
            'buy_price' => 'numeric',
            'quantity' => 'numeric',
        ]);

        return new ProductResource($this->service->create($data));
    }

    public function show(Product $product)
    {
        $this->authorize('product.view');
        return new ProductResource($product->load('category'));
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('product.edit');
        $this->service->update($product, $request->all());
        return new ProductResource($product);
    }

    public function destroy(Product $product)
    {
        $this->authorize('product.delete');
        $this->service->delete($product);
        return response()->noContent();
    }
}
