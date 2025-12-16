@extends('layouts.app')

@section('title', __('models/cities.plural'))

@section('breadcrumbs', __('models/cities.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/cities.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'cities','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('cities.show_fields')
                </div>
                <div class="row">
                    <x-activity-logs :activities="$city->activities"></x-activity-logs>
                </div>
            </div>
        </div>
    </div>
@endsection
