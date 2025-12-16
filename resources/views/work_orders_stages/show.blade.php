@extends('layouts.app')

@section('title', __('models/workOrdersStages.plural'))

@section('breadcrumbs', __('models/workOrdersStages.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersStages.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersStages','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders_stages.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
