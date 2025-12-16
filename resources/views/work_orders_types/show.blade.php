@extends('layouts.app')

@section('title', __('models/workOrdersTypes.plural'))

@section('breadcrumbs', __('models/workOrdersTypes.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersTypes.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersTypes','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders_types.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
