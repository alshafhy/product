<?php

namespace App\Http\Controllers;

use App\DataTables\ProductDataTable;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Size;
use App\Models\Color;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Support\Facades\Storage;

class ProductController extends AppBaseController
{
    public function index(ProductDataTable $productDataTable)
    {
        return $productDataTable->render('products.index');
    }

    public function create()
    {
        $sizes = Size::pluck('name', 'id');
        $colors = Color::pluck('name', 'id');

        return view('products.create', compact('sizes', 'colors'));
    }

    public function store(CreateProductRequest $request)
    {
        $input = $request->except('images');

        $product = Product::create($input);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        Flash::success('Product saved successfully.');

        return redirect(route('products.index'));
    }

    public function show($id)
    {
        $product = Product::with(['size', 'color', 'images'])->find($id);

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        return view('products.show')->with('product', $product);
    }

    public function edit($id)
    {
        $product = Product::with('images')->find($id);

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        $sizes = Size::pluck('name', 'id');
        $colors = Color::pluck('name', 'id');

        return view('products.edit', compact('product', 'sizes', 'colors'));
    }

    public function update($id, UpdateProductRequest $request)
    {
        $product = Product::find($id);

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        $product->fill($request->except(['images', 'delete_images']));
        $product->save();

        // Handle image deletions
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $image = ProductImage::find($imageId);
                if ($image && $image->product_id == $product->id) {
                    Storage::disk('public')->delete($image->image_path);
                    $image->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path
                ]);
            }
        }

        Flash::success('Product updated successfully.');

        return redirect(route('products.index'));
    }

    public function destroy($id)
    {
        $product = Product::with('images')->find($id);

        if (empty($product)) {
            Flash::error('Product not found');
            return redirect(route('products.index'));
        }

        // Delete all associated images
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        $product->delete();

        Flash::success('Product deleted successfully.');

        return redirect(route('products.index'));
    }
}
