@extends('layouts.app')

@section('title', 'Product Details')

@section('breadcrumbs', 'Products')

@section('content')
<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Product Details</h4>
            @include('layouts.partials.form_toolbar', ['screen_name' => 'products','action_name' => 'show'])
        </div>
        <div class="card-body">
            <div class="row">
                @include('products.show_fields')
            </div>
        </div>
    </div>
</div>
@endsection