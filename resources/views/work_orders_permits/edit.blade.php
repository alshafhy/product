@extends('layouts.app')

@section('title', __('models/workOrdersPermits.plural'))

@section('breadcrumbs', __('models/workOrdersPermits.plural'))

@section('content')

<script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>

<style>
    form label {font-weight:bold}
</style>


    <div>
        @include('flash::message')

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::model($workOrdersPermit, ['route' => ['workOrdersPermits.update', $workOrdersPermit->id], 'method' => 'patch']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersPermits.plural') }} - @lang('crud.edit')  </h4>
                <a class="btn btn-outline-primary me-75 round " style="margin-right: 53%; margin-top: 22px;" href="{{route("workOrderFollows.printFollow",['id'=>$workOrdersPermit->id])}}">
                    طباعه التصريح -تفصيلى
                </a>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersPermits','action_name' => 'edit'])
            </div>

            <div class="card-body">
                <div class="row">
                    @include('work_orders_permits.fields' , ["formMode"=>"edit"])
                </div>
            </div>

            <div class="card-footer">
                 <x-form-submit-buttons screenname="workOrdersPermits" cancelroute="workOrdersPermits.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}



            <div class="card-body">
                <div class="row">
                    @include('work_orders_permits.ajax_modals.extensions_modals')
                    @include('work_orders_permits.ajax_modals.fines_modals')
                </div>
            </div>

            @section("page-script")
                <script src="{{ asset(mix('js/scripts/pages/app-workOrdersPermits-edit.js')) }}"></script>
            @endsection


            @include('work_orders_permits.details.attachment_add_modal')

        </div>
    </div>
@endsection
