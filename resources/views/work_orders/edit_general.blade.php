@extends('layouts.app')

@section('title', __('models/workOrders.plural_'.$mode))

@section('breadcrumbs', __('models/workOrders.parent_menu_'.$mode))

@section('content')
    @include('flash::message')
    <div>

        @include('layouts.partials.messages')

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrders.plural') }} - @lang('crud.edit')  </h4>
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrders','action_name' => 'edit' ,'key'=>$workOrder->id ]) --}}
                <x-form-toolbar screenname="workOrders" actionname='edit' :key="$workOrder->id">
                    <x-slot:before class="font-bold">
                        @if ($mode=="general" && $workOrder->status == 1 )
                            {!! Form::open(['route' => ['workOrders.changeStatus',"updateStatusToStart",  $workOrder->id], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="ارسال أمر العمل الى الادارة التابعة">
                                    الأرسال الى الادارة التابعة
                                </button>
                            {!! Form::close() !!}
                        @endif
                    </x-slot>
                    {{-- <x-slot:after class="text-sm">
                        Footer
                    </x-slot> --}}
                </x-form-toolbar>
            </div>
            {!! Form::model($workOrder, ['route' => ['workOrders.update', $workOrder->id], 'method' => 'patch', 'files' => true]) !!}
            <div class="card-body">
                <div class="row">
                    @include('work_orders.fields',["formMode"=>"edit"])
                </div>
            </div>

            <div class="card-footer">
                 <x-form-submit-buttons screenname="workOrders" cancelroute="workOrders.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}
            @include('work_orders.details.edit.attachment_add_modal')
        </div>
    </div>
@endsection
