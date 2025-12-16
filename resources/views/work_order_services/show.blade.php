@extends('layouts.app')

@section('title', __('models/workOrderServices.plural'))

@section('breadcrumbs', __('models/workOrderServices.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrderServices.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrderServices','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_order_services.show_fields')
                </div>
            </div>
        </div>
    </div>
@endsection
