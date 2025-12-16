@extends('layouts.reportPdfLayout')
@section('filter-description')
<x-report.filter-description :reportRouteName="$comp_name"></x-report.filter-description>
@endsection
@section('content')
    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
        <tr>
            <td width="12%" class="title">رقم أمر العمل</td>
            <td width="10%" class="title">نوع العمل</td>
            <td width="10%" class="title">تاريخ الاستلام</td>
            <td width="10%" class="title">الادارة المسئولة الحالية</td>
            <td width="7%" class="title">مدة العمل</td>
            <td width="10%" class="title">الحالة</td>
            <td width="7%" class="title">مقايسة</td>
            <td width="7%" class="title">شهادة انجاز</td>
            <td width="7%" class="title">مستخلص</td>
        </tr>

            @foreach ($data as $workOrder)
            <tr>
                <td class="TextCenter">{{$workOrder->work_order_number}}</td>
                <td class="TextCenter">{{$workOrder->work_type_code}}</td>
                <td class="TextCenter">{{$workOrder->received_date->format('Y-m-d')}}</td>
                <td class="TextCenter">{{$workOrder->current_department_name}}</td>
                <td class="TextCenter">{{$workOrder->work_period}}</td>
                <td class="TextCenter">{{$workOrder->statusTitle['title']}}</td>
                <td class="TextCenter">{{($workOrder->assay_forms_id)? "نعم" :"لا"}}</td>
                <td class="TextCenter">{{($workOrder->achievement_certificate_id)? "نعم" :"لا"}}</td>
                <td class="TextCenter">{{($workOrder->payment_clearance_id)? "نعم" :"لا"}}</td>
            </tr>
        @endforeach
    </table>

@endsection