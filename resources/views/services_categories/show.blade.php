@extends('layouts.app')

@section('title', __('models/servicesCategories.plural'))

@section('breadcrumbs', __('models/servicesCategories.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/servicesCategories.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'servicesCategories','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('services_categories.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
