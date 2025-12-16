@extends('layouts.app')

@section('title', __('models/workOrdersPermits.plural'))

@section('breadcrumbs', __('models/workOrdersPermits.plural'))

@section('content')
    
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            {!! Form::open(['route' => 'workOrdersPermits.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersPermits.plural') }} - @lang('crud.add_new')  </h4>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersPermits','action_name' => 'create'])
            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('work_orders_permits.fields' , ["formMode"=>"create"])
                </div>
            </div>

            <div class="card-footer">
                <x-form-submit-buttons screenname="workOrdersPermits" cancelroute="workOrdersPermits.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
