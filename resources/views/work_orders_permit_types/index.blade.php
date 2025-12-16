@extends('layouts.app')

@section('title', __('models/workOrdersPermitTypes.plural'))

@section('breadcrumbs', __('models/workOrdersPermitTypes.plural'))

@section('content')
    @include('flash::message')
    <div class="clearfix"></div>
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                {{-- <div class="card-header">
                    <h4 class="card-title"> @lang('models/workOrdersPermitTypes.plural')</h4>
                    @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersPermitTypes','action_name' => 'index'])
                </div> --}}
                <div class="card-body">
                    <div class="table-responsive">
                        @include('work_orders_permit_types.table')
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bordered table end -->
@endsection




