
@php
    $work_order_status= config("const.work_order_general_status");
@endphp
<div class="p-1">
    <div class="table-responsive">
        <table class="table table-bordered" id="cities-table">
            <thead>
            <tr>
                <th>{{__('index')}}</th>
                <th>{{__('models/workOrders.fields.work_order_number')}}</th>
                <th>{{__('models/workOrders.fields.received_date')}}</th>
                <th>{{__('models/workOrders.fields.work_type_name')}}</th>
                <th>{{__('models/workOrders.fields.district_name')}}</th>
                <th>{{__('models/workOrders.fields.total_work_period')}}</th>
                <th>{{__('models/workOrders.fields.project_stage_id')}}</th>
                <th>{{__('models/workOrders.fields.assay_forms_status')}}</th>
                <th>{{__('models/workOrders.fields.status')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($workOrdersProject->workOrders as $workOrder)
                <tr>

                     <td>{{$loop->iteration}}</td>
                     <td>
                        <a href="{{ url('workOrdersManagement/workOrders',['id'=>$workOrder->id]) }}" class="btn btn-default text-primary">
                        {{$workOrder->work_order_number}}</a>
                    </td>
                    <td>{{$workOrder->received_date->toDateString()}}</td>
                    <td>{{$workOrder->workType->full_name}}</td>
                    <td>{{$workOrder->district->name}}</td>
                    <td>{{$workOrder->total_work_period}}</td>
                    <td>{{($workOrder->project_stage_id)? $workOrder->project_stage_id : "أمر العمل الرئيسى للمشروع"}} </td>
                    <td>{{($workOrder->assay_forms_status)? config('const.assay_form')[$workOrder->assay_forms_status]['title'] : 'لا توجد مقايسة' }}</td>
                    <td>
                        <span class="badge rounded-pill {{$work_order_status[$workOrder->status]['class']}}">
                            {{$work_order_status[$workOrder->status]['title']}}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">{{__('There is no work orders attached for this project')}}</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
