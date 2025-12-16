@extends('layouts.app')

@section('title', __('models/workOrders.plural_'.$mode))

@section('breadcrumbs', __('models/workOrders.parent_menu_'.$mode))

@section('content')
    @include('flash::message')

    <div>

        @include('layouts.partials.messages')

        <div class="card">
            
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrders.work_orders_electricity_title') }} - @lang('crud.edit')  </h4>
                {!! Form::open(['route' => ['workOrders.changeStatus',"toGeneral",  $workOrder->id,"workOrdersElectricity"], 'method' => 'patch']) !!}
                <div class="modal fade" id="stopModal" tabindex="-1" aria-labelledby="stopModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border border-danger">
                            <div class="modal-header text-danger">
                                <h1 class="modal-title fs-5" id="stopModalLabel">إرجاع أمر العمل الي العام</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group col-sm-12">
                                    هل انت متأكد من ارجاع امر العمل الي أوامر العمل العامه
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                <button type="submit" class="btn btn-danger">إرجاع</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <button type="button" data-bs-toggle="modal" data-bs-target="#stopModal" class="btn btn-outline-danger me-75 round"  title="إرجاع الي العام">
                    إرجاع الي العام
                </button> --}}
                {!! Form::close() !!}
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrders','action_name' => 'edit' ,'key'=>$workOrder->id ]) --}}
                <x-form-toolbar screenname="workOrdersElectricity" actionname='edit' :key="$workOrder->id">
                    <x-slot:before class="font-bold">
                        
                    @if ( $workOrder->electrical_operations_status == 0 )
                        {!! Form::open(['route' => ['workOrders.changeStatus',"electricityInProgress",  $workOrder->id,"workOrdersElectricity"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="تحويل الى جارى تنفيذ أعمال الحفر">
                                تحويل الى جارى تنفيذ أعمال الكهرباء 
                            </button>
                        {!! Form::close() !!}
                    @endif
                    @if ( $workOrder->electrical_operations_status == 1 )
                        {!! Form::open(['route' => ['workOrders.changeStatus',"electricalOperationsFinished" , $workOrder->id,"workOrdersElectricity"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="انتهاء الاعمال ">
                                تحويل الى انتهاء أعمال الكهرباء 
                            </button>
                        {!! Form::close() !!}
                    @endif
                    @if ( $workOrder->status == 3 && $workOrder->electrical_operations_status == 2 && $workOrder->current_department_id == 2  )
                        {!! Form::open(['route' => ['workOrders.changeStatus',"electricalConvertDepartment" , $workOrder->id,"workOrdersElectricity"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="الارسال الى المستخلصات">
                                  تسليم أمر العمل والارسال الى المستخلصات 
                            </button>
                        {!! Form::close() !!}
                    @endif
                   
                    @include('work_orders.process_actions', ['screenName' => "workOrdersElectricity"]) 

                    @if (  $workOrder->status == 6    )
                        {!! Form::open(['route' => ['workOrders.changeStatus',"reOpenDrillingWorkOrder",  $workOrder->id,"workOrdersElectricity"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="سيتم تحويل كل من حالة أمر العمل وحالة أعمال الكهرباء الى جارى التنفيذ">
                                اعادة البدء فى التنفيذ 
                            </button>
                        {!! Form::close() !!}
                    @endif
                        
                    </x-slot>
                    {{-- <x-slot:after class="text-sm">
                        Footer
                    </x-slot> --}}
                </x-form-toolbar>
            </div>
            {!! Form::model($workOrder, ['route' => ['workOrdersElectricity.update', $workOrder->id], 'method' => 'patch', 'files' => true]) !!}
            <div class="card-body">
                <div class="row">
                    @include('work_orders.fields',["formMode"=>"edit"])
                </div>
            </div>

            <div class="card-footer">
                 <x-form-submit-buttons screenname="workOrdersElectricity" cancelroute="workOrdersElectricity.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}
            @include('work_orders.details.edit.attachment_add_modal')
        </div>
    </div>
@endsection
