<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            ID:
        </div>
        <div class="col-sm-9">
            {{ $product->id }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            Name:
        </div>
        <div class="col-sm-9">
            {{ $product->name }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            Price:
        </div>
        <div class="col-sm-9">
            ${{ number_format($product->price, 2) }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            Size:
        </div>
        <div class="col-sm-9">
            {{ $product->size->name ?? 'N/A' }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            Color:
        </div>
        <div class="col-sm-9">
            {{ $product->color->name ?? 'N/A' }}
        </div>
    </div>
</div>

<div class="col-sm-12">
    <div class="mb-1 row">
        <div class="col-sm-3">
            Images:
        </div>
        <div class="col-sm-9">
            @if($product->images->count() > 0)
            <div class="row">
                @foreach($product->images as $image)
                <div class="col-md-3 mb-3">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="img-fluid rounded" alt="Product Image" style="max-height: 200px; object-fit: cover;">
                </div>
                @endforeach
            </div>
            @else
            <span class="text-muted">No images available</span>
            @endif
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            Created At:
        </div>
        <div class="col-sm-9">
            {{ $product->created_at }}
        </div>
    </div>
</div>

<div class="col-sm-6">
    <div class="mb-1 row">
        <div class="col-sm-3">
            Updated At:
        </div>
        <div class="col-sm-9">
            {{ $product->updated_at }}
        </div>
    </div>
</div>