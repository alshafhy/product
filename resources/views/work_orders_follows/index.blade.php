@extends('layouts.app')

@section('title', __('models/workOrderFollows.plural'))

@section('breadcrumbs', __('models/workOrderFollows.plural'))

@section('content')
    @include('flash::message')
    <div class="clearfix"></div>
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{-- <h4 class="card-title"> @lang('models/workOrderFollows.plural')</h4>
                    @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrderFollows','action_name' => '']) --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @include('work_orders_follows.table')
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bordered table end -->
@endsection




