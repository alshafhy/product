@extends('layouts.app')

@section('title', __('models/workOrdersProjects.plural'))

@section('breadcrumbs', __('models/workOrdersProjects.plural'))

@section('content')

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersProjects.plural') }} - @lang('crud.show')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersProjects','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    @include('work_orders_projects.show_fields')
                </div>
                <div class="row">
                    @include('work_orders_projects.work_orders')
                </div>
            </div>
        </div>
    </div>
@endsection
