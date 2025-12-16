@extends('layouts.app')

@section('title', __('models/products.plural'))

@section('breadcrumbs', __('models/products.plural'))

@section('content')
@include('flash::message')
<div class="clearfix"></div>
<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @include('products.table')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bordered table end -->
@endsection