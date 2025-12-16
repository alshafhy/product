@extends('layouts.app')

@section('title', __('models/workOrders.plural_'.$mode))

@section('breadcrumbs', __('models/workOrders.parent_menu_'.$mode))

@section('content')
    
    <div>

        @include('layouts.partials.messages')
        <div class="card">

            {!! Form::open(['route' => 'workOrders.store']) !!}
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrders.plural') }} - @lang('crud.add_new')  </h4>
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrders','action_name' => 'create']) --}}
                <x-form-toolbar screenname="workOrders" actionname='create'></x-form-toolbar>

            </div>
             
            <div class="card-body">
                <div class="row">
                    @include('work_orders.fields',["formMode"=>"create"])
                </div>
            </div>

            <div class="card-footer">
                <x-form-submit-buttons screenname="workOrders" cancelroute="workOrders.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
