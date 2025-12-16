@extends('layouts.app')

@section('title', __('models/itemsCategories.plural'))

@section('breadcrumbs', __('models/itemsCategories.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/itemsCategories.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'itemsCategories','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('items_categories.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
