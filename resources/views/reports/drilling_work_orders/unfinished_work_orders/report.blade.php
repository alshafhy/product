@extends('layouts.reportPdfLayout')
@section('filter-description')
<x-report.filter-description :reportRouteName="$comp_name"></x-report.filter-description>
@endsection
@section('content')
    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
        <tr>
            <td width="8%" class="title">رقم أمر العمل</td>
            <td width="7%" class="title">تاريخ الاستلام</td>
            <td width="5%" class="title">نوع العمل</td>
            <td width="7%" class="title">اسم الحى</td>
            <td width="5%" class="title">مدة العمل</td>

            <td width="5%" class="title">قسم شركة الكهرباء</td>
            <td width="4%" class="title">اجمالى الاطوال</td>
            <td width="10%" class="title">اسم الاستشارى</td>
            <td width="9%" class="title">المنفذ لأعمال الحفر</td>
            <td width="9%" class="title">التصريح</td>
            <td width="5%" class="title">مدة التصريح</td>
            <td width="5%" class="title">حالة التصريح</td>
            <td width="5%" class="title">حالة أعمال الحفر</td>
            <td width="5%" class="title">حالة أعمال الكهرباء</td>
            <td width="5%" class="title">الحالة</td>
        </tr>

            @foreach ($data as $workOrder)
            <tr>
                <td class="TextCenter">{{$workOrder->work_order_number}}</td>
                <td class="TextCenter">{{$workOrder->received_date->format('Y-m-d')}}</td>
                <td class="TextCenter">{{$workOrder->work_type_code}}</td>
                <td class="TextCenter">{{$workOrder->district_name}}</td>
                <td class="TextCenter">{{$workOrder->totalWorkPeriod}}</td>
                <td class="TextCenter">{{$workOrder->electricity_department_name}}</td>
                <td class="TextCenter">
                    @if (empty($workOrder->landscape->length_total) || $workOrder->landscape->length_total == 0)
                        {{$workOrder->landscape->length_total_before;}}
                    @else
                        {{$workOrder->landscape->length_total}}
                    @endif
                </td>
                <td class="TextCenter">{{$workOrder->consultant_name}}</td>
                <td class="TextCenter">{{$workOrder->drilling_worker}}</td>

                <td class="TextCenter">{{$workOrder->permit_number}}</td>
                <td class="TextCenter">{{$workOrder->permit_woking_days}}</td>
                <td class="TextCenter">{{ ($workOrder->permit_status)? __("models/workOrdersPermits.status.".App\Enums\WorkOrderPermitStatusEnum::getOptions()[$workOrder->permit_status] ): ""}}</td>
                <td class="TextCenter">{{__("models/workOrders.status.".App\Enums\WorkOrderOperationsStatusEnum::getOptions()[$workOrder->drilling_status])}}</td>
                <td class="TextCenter">{{__("models/workOrders.status.".App\Enums\WorkOrderOperationsStatusEnum::getOptions()[$workOrder->electrical_operations_status])}}</td>
                <td class="TextCenter">{{$workOrder->statusTitle['title']}}</td>
            </tr>
        @endforeach

    </table>
    <br>
    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
        <tr>
            <td class="TextCenter">عدد أوامر العمل </td>
            <td colspan="4" class="TextCenter">{{$data->rowCount }}</td>

            <td class="TextCenter">اجمالى الطول</td>
            <td colspan="7" class="TextCenter">{{$data->landscapeLengthTotal}}</td>

        </tr>
    </table>

@endsection
