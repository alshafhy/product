<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductService extends BaseService
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    public function delete(Product $product): bool
    {
        return $product->delete();
    }
}
