@extends('layouts.app')

@section('title', 'Products')

@section('breadcrumbs', 'Products')

@section('content')
<div class="content-body">
    <section class="basic-horizontal-layouts">
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Product</h4>
                        @include('layouts.partials.form_toolbar', ['screen_name' => 'products','action_name' => 'edit'])
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            {!! Form::model($product, ['route' => ['products.update', $product->id], 'method' => 'patch', 'files' => true]) !!}

                            <div class="row">
                                @include('products.fields')

                                <!-- Existing Images -->
                                @if($product->images->count() > 0)
                                <div class="form-group col-sm-12">
                                    <label>Existing Images:</label>
                                    <div class="row">
                                        @foreach($product->images as $image)
                                        <div class="col-md-3 mb-3">
                                            <div class="card">
                                                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Product Image" style="height: 150px; object-fit: cover;">
                                                <div class="card-body text-center">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="form-check-input" id="delete_{{ $image->id }}">
                                                        <label class="form-check-label" for="delete_{{ $image->id }}">Delete</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-sm-12">
                                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection