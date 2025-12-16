@extends('layouts.app')

@section('title', __('models/workOrdersPermits.plural'))

@section('breadcrumbs', __('models/workOrdersPermits.plural'))

@section('content')
    @php
        $workOrder = $workOrdersPermit->workOrders->first();
        $work_order_status= config("const.work_order_general_status");
        $work_order_drilling_status= config("const.work_order_drilling_status");
        $work_order_electricity_status = config("const.work_order_electricity_status");
        $lab_result_status_list = config("const.lab_result_status_list");
    @endphp
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{  __('models/workOrdersPermits.plural') }} - @lang('crud.show')  </h4>
                <a class="btn btn-outline-primary me-75 round"  style="margin-right: 45%; margin-top: 22px;" href="{{route("workOrderFollows.printFollow",['id'=>$workOrdersPermit->id])}}">
                    طباعه التصريح -تفصيلى
                </a>
                @include('layouts.partials.form_toolbar', ['screen_name' => 'workOrdersPermits','action_name' => 'show'])
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-sm-12 col-lg-12">
                        @include('work_orders.details.edit.fixed_info' ,["workOrder"=>$workOrder])
                    </div>
                    @include('work_orders_permits.show_fields')
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">المعلومات</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-1 row">
                            <div class="col-sm-5 fw-bolder d-flex">
                                <span class="fw-bolder text-primary">تراب</span>
                                &nbsp;
                                <b>:</b>
                            </div>
                            <div class="col-sm-7 ">
                                {{$workOrdersPermit->length_dust ?? 0 }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-1 row">
                            <div class="col-sm-5 fw-bolder d-flex">
                                <span class="fw-bolder text-primary">أسفلت</span>
                                &nbsp;
                                <b>:</b>
                            </div>
                            <div class="col-sm-7 ">
                                {{$workOrdersPermit->length_asphalt ?? 0 }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-1 row">
                            <div class="col-sm-5 fw-bolder d-flex">
                                <span class="fw-bolder text-primary">رصيف</span>
                                &nbsp;
                                <b>:</b>
                            </div>
                            <div class="col-sm-7 ">
                                {{$workOrdersPermit->length_sidewalk ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-1 row">
                            <div class="col-sm-5 fw-bolder d-flex">
                                <span class="fw-bolder text-primary">إجمالي</span>
                                &nbsp;
                                <b>:</b>
                            </div>
                            <div class="col-sm-7 ">
                                {{$workOrdersPermit->length_total ?? 0 }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-1 row">
                            <div class="col-sm-5 fw-bolder d-flex">
                                <span class="fw-bolder text-primary">عدد الطبقات المطلوبة</span>
                                &nbsp;
                                <b>:</b>
                            </div>
                            <div class="col-sm-7 ">
                                {{$workOrdersPermit->drilling_layer ?? 0 }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-1 row">
                            <div class="col-sm-5 fw-bolder d-flex">
                                <span class="fw-bolder text-primary">عمق الحفرية</span>
                                &nbsp;
                                <b>:</b>
                            </div>
                            <div class="col-sm-7 ">
                                {{$workOrdersPermit->drilling_deep ?? 0 }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="mb-1 row">
                            <div class="col-sm-5 fw-bolder d-flex">
                                <span class="fw-bolder text-primary">عرض الحفرية</span>
                                &nbsp;
                                <b>:</b>
                            </div>
                            <div class="col-sm-7 ">
                                {{$workOrdersPermit->drilling_width ?? 0 }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mb-1 row">
                            <div class="col-sm-5 fw-bolder d-flex">
                                <span class="fw-bolder text-primary">نوع الحفر</span>
                                &nbsp;
                                <b>:</b>
                            </div>
                            <div class="col-sm-7 ">
                                {{$workOrdersPermit->drilling_type == 'مفتوح'? 'مفتوح' : 'Microtrench' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">التمديدات</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped table-hover table-responsive">
                        <tbody id="extensions_table">
                        <thead>
                        <tr>
                            <th>{{('#')}}</th>
                            <th>المعرف</th>
                            <th>رقم السداد</th>
                            <th>تاريخ البدء</th>
                            <th>تاريخ الانتهاء</th>
                            <th>مبلغ التمديد</th>
                            <th>ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(($workOrdersPermit->workOrdersPermitsExtension))
                            @foreach($workOrdersPermit->workOrdersPermitsExtension as $workOrdersPermitsExtension)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th scope="row">{{ $workOrdersPermitsExtension->id }}</th>
                                    <td>{{$workOrdersPermitsExtension->sadad_number}}</td>
                                    <td>{{$workOrdersPermitsExtension->from_date}}</td>
                                    <td>{{$workOrdersPermitsExtension->to_date}}</td>
                                    <td>{{$workOrdersPermitsExtension->amount}}</td>
                                    <td>{{$workOrdersPermitsExtension->notes}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">الغرامات</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped table-hover table-responsive">
                        <tbody id="extensions_table">
                        <thead>
                        <tr>
                            <th>{{('#')}}</th>
                            <th>المعرف</th>
                            <th>رقم السداد</th>
                            <th>تاريخ الغرامة</th>
                            <th>المبلغ</th>
                            <th>سبب الغرامة</th>
                            <th>ملاحظات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($workOrdersPermit->workOrdersPermitsFine)
                            @foreach($workOrdersPermit->workOrdersPermitsFine as $workOrdersPermitsFine)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th scope="row">{{ $workOrdersPermitsFine->id }}</th>
                                    <td>{{$workOrdersPermitsFine->sadad_number}}</td>
                                    <td>{{Helper::dateFormat($workOrdersPermitsFine->issue_date)}}</td>
                                    <td>{{$workOrdersPermitsFine->amount}}</td>
                                    <td>{{$workOrdersPermitsFine->fine_reason}}</td>
                                    <td>{{$workOrdersPermitsFine->notes}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">تفاصيل الطبقات</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped table-hover table-responsive text-center">
                        <tbody id="extensions_table">
                        <thead>
                        <tr>
                            <th>{{('#')}}</th>
                            <th>الطبقة</th>
                            <th>تاريخ التنفيذ</th>
                            <th>المنفذ</th>
                            <th>نتيجة المختبر</th>
                            <th>سبب الرسوب</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(($workOrdersPermit->landLayers))
                            @foreach($workOrdersPermit->landLayers as $landLayer)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{$landLayer->layer->name}}</td>
                                    <td>{{$landLayer->start_date}}</td>
                                    <td>{{$landLayer->employee->name ?? $landLayer->contractor->name}}</td>
                                    <td>{{$lab_result_status_list[$landLayer->lab_result_status]}}</td>
                                    <td>{{$landLayer->note}}</td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">الملفات المؤرشفة بالتصريح </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <x-attachment.file_list :model="get_class($workOrdersPermit)" :id="$workOrdersPermit->id" :options="['display'=>['type'=>true,'action'=>true],'action'=>['view'=>false,'download'=>true,'delete'=>false]]"></x-attachment.file_list>
                </div>
            </div>
        </div>
    </div>



    <div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">أوامر العمل المرتبطة</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <table class="table table-striped table-hover table-responsive">
                        <tbody id="extensions_table">
                        <thead>
                        <tr>
                            <th>{{('#')}}</th>
                            <th>{{__('models/workOrders.fields.work_order_number')}}</th>
                            <th>{{__('models/workOrders.fields.received_date')}}</th>
                            <th>{{__('models/workOrders.fields.work_type_name')}}</th>
                            <th>{{__('models/workOrders.fields.district_name')}}</th>
                            <th>{{__('models/workOrders.fields.current_department_name')}}</th>
                            <th>{{__('models/workOrders.fields.total_work_period')}}</th>
                            <th>حالة تنفيذ اعمال الحفر</th>
                            <th>حالة تنفيذ اعمال الكهرباء</th>
                            <th>{{__('models/workOrders.fields.status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(($workOrdersPermit->workOrders))
                            @foreach($workOrdersPermit->workOrders as $workOrder)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <th scope="row">{{ $workOrder->work_order_number }}</th>
                                    <td>{{$workOrder->received_date}}</td>
                                    <td>{{$workOrder->work_type->code ?? ''}}</td>
                                    <td>{{$workOrder->district->name ?? ''}}</td>
                                    <td>{!! $workOrder->current_department->name ?? '<span class="badge rounded-pill badge-light-danger">غير مربوط بادارة</span>' !!}</td>
                                    <td>{{$workOrder->total_work_period}}</td>
                                    <td><span class="badge rounded-pill {{$work_order_drilling_status[$workOrder->drilling_status]['class']}}">{{$work_order_drilling_status[$workOrder->drilling_status]['title']}}</span></td>
                                    <td><span class="badge rounded-pill {{$work_order_electricity_status[$workOrder->electrical_operations_status]['class']}}">{{$work_order_electricity_status[$workOrder->electrical_operations_status]['title']}}</span></td>
                                    <td><span class="badge rounded-pill {{$work_order_status[$workOrder->status]['class']}}">{{$work_order_status[$workOrder->status]['title']}}</span></td>
                                </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
