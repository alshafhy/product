@extends('layouts.app')

@section('title', __('models/workOrdersPermitTypes.plural'))

@section('breadcrumbs', __('models/workOrdersPermitTypes.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersPermitTypes.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersPermitTypes','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders_permit_types.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
