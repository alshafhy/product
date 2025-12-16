@extends('layouts.reportPdfLayout')
@section('filter-description')
<x-report.filter-description :reportRouteName="$comp_name"></x-report.filter-description>
@endsection
@section('content')
<table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
    <tr>
        <td width="5%" class="title">م</td>
        <td width="8%" class="title">رقم أمر العمل</td>
        <td width="7%" class="title">تاريخ الاستلام</td>
        <td width="5%" class="title">تاريخ التنفيذ</td>
        <td width="7%" class="title">اسم الحى</td>
        <td width="5%" class="title">رقم المحطة</td>

        <td width="5%" class="title">عدد العدادت</td>
        {{-- <td width="4%" class="title">اجمالى الاطوال</td>
        <td width="10%" class="title">اسم الاستشارى</td> --}}
        <td width="9%" class="title">المنفذ لأعمال الحفر</td>
        {{-- <td width="9%" class="title">التصريح</td>
        <td width="11%" class="title">تاريخ التنفيذ</td>
        <td width="20%" class="title">وصف العمل</td> --}}
        {{-- <td width="5%" class="title">مدة التصريح</td>
        <td width="5%" class="title">حالة التصريح</td>
        <td width="5%" class="title">حالة أعمال الحفر</td>
        <td width="5%" class="title">حالة أعمال الكهرباء</td>
        <td width="5%" class="title">الحالة</td> --}}
    </tr>

        @foreach ($data as $workOrder)
        <tr>
            {{-- @dd($workOrder->electrical_operation) --}}
            {{-- @dd($workOrder->electrical_operation->electrical_contractor_id)مقاول --}}
            {{-- @dd($workOrder->electrical_operation->electrical_employee_id) --}}
            {{-- @dd($workOrder->electrical_operation->contractor->name) --}}
            <td class="TextCenter">{{ $loop->index +1 }}</td>
            <td class="TextCenter">{{$workOrder->work_order_number}}</td>
            <td class="TextCenter">{{($workOrder->received_date) ? $workOrder->received_date->format('Y-m-d') : ''}}</td>
            <td class="TextCenter">{{($workOrder->finished_date) ? $workOrder->finished_date->format('Y-m-d') : ''}}</td>
            <td class="TextCenter">{{$workOrder->district_name}}</td>
            <td class="TextCenter">{{$workOrder->electrical_station_number}}</td>
            <td class="TextCenter">{{$workOrder->meters->count()}}</td>
            <td class="TextCenter">
                @if (isset($workOrder->electrical_operation->electrical_employee_id))
                    {{$workOrder->electrical_operation->employee->name}}
                @elseif (isset($workOrder->electrical_operation->electrical_contractor_id))
                    {{$workOrder->electrical_operation->contractor->name}}
                @endif
            </td>

            {{-- <td class="TextCenter">{{($workOrder->electrical_operation->electrical_contractor_id || $workOrder->electrical_operation->electrical_employee_id)?}}</td> --}}
            {{-- <td class="TextCenter">{{$workOrder->drilling_worker}}</td> --}}
            {{-- <td class="TextCenter">{{$workOrder->consultant_name}}</td>
            <td class="TextCenter">{{$workOrder->drilling_worker}}</td>
            <td class="TextCenter">{{$workOrder->permit_number}}</td>
            <td class="TextCenter">{{$workOrder->drilling_complete_date}}</td>
            <td class="TextCenter">{{$workOrder->description}}</td> --}}
{{--
            <td class="TextCenter">{{$workOrder->permit_woking_days}}</td>
            <td class="TextCenter">{{ ($workOrder->permit_status)? __("models/workOrdersPermits.status.".App\Enums\WorkOrderPermitStatusEnum::getOptions()[$workOrder->permit_status] ): ""}}</td>
            <td class="TextCenter">{{__("models/workOrders.status.".App\Enums\WorkOrderOperationsStatusEnum::getOptions()[$workOrder->drilling_status])}}</td>
            <td class="TextCenter">{{__("models/workOrders.status.".App\Enums\WorkOrderOperationsStatusEnum::getOptions()[$workOrder->electrical_operations_status])}}</td>
            <td class="TextCenter">{{$workOrder->statusTitle['title']}}</td> --}}
        </tr>
    @endforeach
</table>

@endsection
