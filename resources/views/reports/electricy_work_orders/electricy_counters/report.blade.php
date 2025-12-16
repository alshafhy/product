@extends('layouts.reportPdfLayout')
@section('filter-description')
<x-report.filter-description :reportRouteName="$comp_name"></x-report.filter-description>
@endsection
@section('content')
<table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
    <tr>
        <td width="5%" class="title">م</td>
        <td width="8%" class="title">رقم أمر العمل</td>
        <td width="5%" class="title">نوع العمل</td>
        <td width="7%" class="title">تاريخ الاستلام</td>
        <td width="5%" class="title">تاريخ التنفيذ</td>
        <td width="5%" class="title">مدة التنفيذ</td>
        <td width="7%" class="title">اسم الحى</td>
        <td width="5%" class="title">رقم المحطة</td>
        <td width="9%" class="title">مراقب الشركة</td>
        <td width="5%" class="title">عدد العدادات</td>

        <td width="5%" class="title">ملاحظات</td>
    </tr>

        @foreach ($data as $workOrder)
        <tr>
            <td class="TextCenter">{{ $loop->index +1 }}</td>
            <td class="TextCenter">{{$workOrder->work_order_number}}</td>
            <td class="TextCenter">{{$workOrder->workType->name}}</td>
            <td class="TextCenter">{{($workOrder->received_date) ? $workOrder->received_date->format('Y-m-d') : ''}}</td>
            <td class="TextCenter">{{($workOrder->finished_date) ? $workOrder->finished_date->format('Y-m-d') : ''}}</td>
            <td class="TextCenter">{{$workOrder->totalWorkPeriod}} يوم </td>
            <td class="TextCenter">{{$workOrder->district_name}}</td>
            <td class="TextCenter">{{$workOrder->electrical_station_number}}</td>
            <td class="TextCenter">{{$workOrder->electricity_company_employees->name}}</td>
            <td class="TextCenter">{{$workOrder->electrical_operation->total_electrical_counters}}</td>
            <td class="TextCenter">{{$workOrder->electrical_operation->note}}</td>

        </tr>
    @endforeach
</table>

@endsection
