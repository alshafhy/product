@extends('layouts.app')

@section('title', 'Size Details')

@section('breadcrumbs', 'Sizes')

@section('content')
<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Size Details</h4>
            @include('layouts.partials.form_toolbar', ['screen_name' => 'sizes','action_name' => 'show'])
        </div>
        <div class="card-body">
            <div class="row">
                @include('sizes.show_fields')
            </div>
        </div>
    </div>
</div>
@endsection