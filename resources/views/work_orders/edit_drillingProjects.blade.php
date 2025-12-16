@extends('layouts.app')

@section('title', __('models/workOrders.plural'))

@section('breadcrumbs', __('models/workOrders.parent_menu_'.$mode))

@section('content')
    @include('flash::message')

    <div>

        @include('layouts.partials.messages')

        <div class="card">

            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrders.plural') }} - @lang('crud.edit')  </h4>
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrders','action_name' => 'edit' ,'key'=>$workOrder->id ]) --}}
                <x-form-toolbar screenname="workOrdersDrilling" actionname='edit' :key="$workOrder->id">
                    <x-slot:before class="font-bold">

                        {{-- @if ($mode=="general" && $workOrder->status == 1 ) --}}
                        @if ( $workOrder->drilling_status == 0 )
                            {!! Form::open(['route' => ['workOrders.changeStatus',"drillInProgress",  $workOrder->id,"workOrdersDrilling"], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="تحويل الى جارى تنفيذ أعمال الحفر">
                                    تحويل الى جارى تنفيذ أعمال الحفر
                                </button>
                            {!! Form::close() !!}
                        @endif
                        @if ( $workOrder->drilling_status == 1  )
                            {!! Form::open(['route' => ['workOrders.changeStatus',"drillFinished" , $workOrder->id,"workOrdersDrilling"], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="انتهاء الاعمال والارسال الى اعادة الوضع">
                                    تحويل الى انتهاء أعمال الحفر
                                </button>
                            {!! Form::close() !!}
                        @endif
                        @if ( $workOrder->status == 3 && $workOrder->drilling_status == 2  )
                            {!! Form::open(['route' => ['workOrders.changeStatus',"convertDepartment" , $workOrder->id,"workOrdersDrilling"], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="الارسال الى اعادة الوضع">
                                      الارسال الى اعادة الوضع
                                </button>
                            {!! Form::close() !!}
                        @endif

                        @include('work_orders.process_actions', ['screenName' => "workOrdersDrilling"])

                        {{-- @endif --}}
                    </x-slot>
                    {{-- <x-slot:after class="text-sm">
                        Footer
                    </x-slot> --}}
                </x-form-toolbar>
            </div>
            {!! Form::model($workOrder, ['route' => ['workOrdersDrillingProjects.update', $workOrder->id], 'method' => 'patch', 'files' => true]) !!}
            <div class="card-body">
                <div class="row">
                    @include('work_orders.fields',["formMode"=>"edit"])
                </div>
            </div>

            <div class="card-footer">
                {{-- {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('workOrdersDrilling.index') }}" class="btn btn-default">
                    @lang('crud.cancel')
                 </a> --}}
                 <x-form-submit-buttons screenname="workOrdersDrilling" cancelroute="workOrdersDrilling.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}
            @include('work_orders.details.edit.attachment_add_modal')
        </div>
    </div>
@endsection
