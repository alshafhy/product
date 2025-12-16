@extends('layouts.reportPdfLayout')
@section('filter-description')
<x-report.filter-description :reportRouteName="$comp_name"></x-report.filter-description>
@endsection
@section('content')
<table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
    <tr>
        <td width="10%" class="title">رقم التصريح</td>
        <td width="8%" class="title">رقم أمر العمل</td>
        <td width="5%" class="title">نوع العمل</td>
        <td width="7%" class="title">الحى</td>
        <td width="5%" class="title">مبلغ الغرامة</td>
        <td width="5%" class="title">سبب الغرامة</td>

    </tr>

    @foreach ($data as $workOrderFollow)
    <tr>
            <td class="TextCenter">{{$workOrderFollow->sadad_number}}</td>
            <td class="TextCenter">{{isset($workOrderFollow->workOrdersPermits->workOrders[0]->work_order_number)?$workOrderFollow->workOrdersPermits->workOrders[0]->work_order_number:""}}</td>
            <td class="TextCenter">{{isset($workOrderFollow->workOrdersPermits->workOrders[0]->work_type_id)?$workOrderFollow->workOrdersPermits->workOrders[0]->workOrdersType->name:""}}</td>
            <td class="TextCenter">{{isset($workOrderFollow->workOrdersPermits->workOrders[0]->district_id)?$workOrderFollow->workOrdersPermits->workOrders[0]->district->name:""}}</td>
            <td class="TextCenter">{{$workOrderFollow->amount}}</td>
            <td class="TextCenter">{{$workOrderFollow->fine_reason}}</td>

        </tr>
    @endforeach
</table>

@endsection
