@extends('layouts.app')

@section('title', __('models/colors.plural'))

@section('breadcrumbs', __('models/colors.plural'))

@section('content')
@include('flash::message')
<div class="clearfix"></div>
<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @include('colors.table')
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bordered table end -->
@endsection