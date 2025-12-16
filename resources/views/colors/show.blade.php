@extends('layouts.app')

@section('title', 'Color Details')

@section('breadcrumbs', 'Colors')

@section('content')
<div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Color Details</h4>
            @include('layouts.partials.form_toolbar', ['screen_name' => 'colors','action_name' => 'show'])
        </div>
        <div class="card-body">
            <div class="row">
                @include('colors.show_fields')
            </div>
        </div>
    </div>
</div>
@endsection