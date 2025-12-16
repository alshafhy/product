@extends('layouts.app')

@section('title', __('models/assayItems.plural'))

@section('breadcrumbs', __('models/assayItems.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/assayItems.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'assayItems','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('assay_items.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
