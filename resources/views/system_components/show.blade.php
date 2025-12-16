@extends('layouts.app')

@section('title', __('models/systemComponents.plural'))

@section('breadcrumbs', __('models/systemComponents.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/systemComponents.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'systemComponents','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('system_components.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
