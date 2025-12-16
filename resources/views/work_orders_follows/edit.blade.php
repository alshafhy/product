@extends('layouts.app')

@section('title', __('models/workOrderFollows.plural'))

@section('breadcrumbs', __('models/workOrderFollows.plural'))

@section('content')

    <script src="{{ asset(mix('vendors/js/extensions/sweetalert2.all.min.js')) }}"></script>
    @include('flash::message')
    <div>

        @include('layouts.partials.messages')

        <div class="card">


            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrderFollows.plural') }} - @lang('crud.edit')  </h4>
                {{-- @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrderFollows','action_name' => 'edit']) --}}
                <x-form-toolbar screenname="workOrderFollows" actionname='edit' :key="$workOrderFollow->id">
                    <x-slot:before class="font-bold">
                        @if ( $workOrderFollow->status == 3)
                        {!! Form::open(['route' => ['WorkOrderFollows.changeStatus',"returnWorkOrderToDrilling",  $workOrderFollow->id,'workOrderFollows'], 'method' => 'patch']) !!}
                        <div class="modal fade" id="returnWorkOrderDrillingModal" tabindex="-1" aria-labelledby="returnWorkOrderDrillingLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content border border-danger">
                                    <div class="modal-header text-danger">
                                        <h1 class="modal-title fs-5" id="returnWorkOrderDrillingLabel">الارجاع الى ادارة التمديدات والحفر</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group col-sm-12">
                                            هل انت متأكد من ارجاع امر العمل الي ادارة التمديدات والحفر
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                                        <button type="submit" class="btn btn-danger">إرجاع</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="button" data-bs-toggle="modal" data-bs-target="#returnWorkOrderDrillingModal" class="btn btn-outline-warning me-75 round"  title="ارجاع الى ادارة التمديدات والحفر">
                            ارجاع الى ادارة التمديدات والحفر
                        </button>
                        {!! Form::close() !!}
                        {!! Form::open(['route' => ['WorkOrderFollows.changeStatus',"restablishWorkInProgress",  $workOrderFollow->id,"workOrderFollows"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="تحويل الى جارى  أعمال اعادة الوضع">
                                تحويل الى جارى  أعمال اعادة الوضع
                            </button>
                        {!! Form::close() !!}

                        @endif
                        @if ( $workOrderFollow->status == 4)
                        {!! Form::open(['route' => ['WorkOrderFollows.changeStatus',"restablishWorkFinished" , $workOrderFollow->id,"workOrderFollows"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="انتهاء الاعمال والبدء فى عملية التسليم">
                                تحويل الى انتهاء أعمال اعادة الوضع
                            </button>
                            <a class="btn btn-outline-primary me-75 round" href="{{route("workOrderFollows.printFollow",['id'=>$workOrderFollow->id])}}">
                                طباعه التصريح -تفصيلى
                            </a>
                            {!! Form::close() !!}
                        @endif

                        @if ( $workOrderFollow->status == 5)
                        {!! Form::open(['route' => ['WorkOrderFollows.changeStatus',"initialDelivery" , $workOrderFollow->id,"workOrderFollows"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="تسليم التصريح المبدئي وتحويل أمر العمل الى تم التسليم">
                                تسليم التصريح المبدئي
                            </button>
                        {!! Form::close() !!}
                        @endif
                        @if ( $workOrderFollow->status == 6)
                        {!! Form::open(['route' => ['WorkOrderFollows.changeStatus',"finalDelivery" , $workOrderFollow->id,"workOrderFollows"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="تسليم التصريح النهائى ">
                                تسليم التصريح النهائى
                            </button>
                        {!! Form::close() !!}
                        @endif
                        {{-- @if ( $workOrderFollow->status == 5)
                        {!! Form::open(['route' => ['WorkOrderFollows.changeStatus',"restablishConvertDepartment" , $workOrderFollow->id,"workOrderFollows"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="الارسال الى المستخلصات">
                                تسليم أمر العمل والارسال الى المستخلصات
                            </button>
                        {!! Form::close() !!}
                        @endif --}}

                        {{-- @if ( $workOrderFollow->drilling_status == 0 )
                            {!! Form::open(['route' => ['workOrders.changeStatus',"drillInProgress",  $workOrder->id,"workOrdersDrilling"], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="تحويل الى جارى تنفيذ أعمال الحفر">
                                    تحويل الى جارى تنفيذ أعمال الحفر
                                </button>
                            {!! Form::close() !!}
                        @endif
                        @if ( $workOrderFollow->drilling_status == 1  )
                            {!! Form::open(['route' => ['workOrders.changeStatus',"drillFinished" , $workOrder->id,"workOrdersDrilling"], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="انتهاء الاعمال والارسال الى اعادة الوضع">
                                    تحويل الى انتهاء أعمال الحفر
                                </button>
                            {!! Form::close() !!}
                        @endif
                        @if ( $workOrderFollow->status == 3  )
                            {!! Form::open(['route' => ['workOrders.changeStatus',"convertDepartment" , $workOrder->id,"workOrdersDrilling"], 'method' => 'patch']) !!}
                                <button type="submit" class="btn btn-outline-primary me-75 round"  title="الارسال الى اعادة الوضع">
                                      الارسال الى اعادة الوضع
                                </button>
                            {!! Form::close() !!}
                        @endif --}}
                        {{-- {!! Form::open(['route' => ['workOrders.changeStatus',"stopped",  $workOrder->id,"workOrdersDrilling"], 'method' => 'patch']) !!}
                            <button type="submit" class="btn btn-outline-primary me-75 round"  title="تحويل الى متوقف التنفيذ">
                                تحويل الى متوقف التنفيذ
                            </button>
                        {!! Form::close() !!} --}}
                    </x-slot>
                </x-form-toolbar>
            </div>
            {!! Form::model($workOrderFollow, ['route' => ['workOrderFollows.update', $workOrderFollow->id], 'method' => 'patch']) !!}
            <div class="card-body">
                <div class="row">
                    @include('work_orders_follows.fields' , ["formMode"=>"edit"])
                </div>
            </div>

            <div class="card-footer">
                <x-form-submit-buttons screenname="workOrderFollows" cancelroute="workOrderFollows.index"></x-form-submit-buttons>
            </div>

            {!! Form::close() !!}


            <div class="card-body">
                <div class="row">
                    @include('work_orders_follows.ajax_modals.land_layers_modals')
                </div>
            </div>


        </div>
    </div>
@endsection

@section("page-script")
    <script src="{{ asset(mix('js/scripts/pages/app-returnSituations-edit.js')) }}"></script>
@endsection
