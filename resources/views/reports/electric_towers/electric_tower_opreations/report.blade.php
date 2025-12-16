@extends('layouts.reportPdfLayout')
@section('filter-description')
<x-report.filter-description :reportRouteName="$comp_name"></x-report.filter-description>
@endsection
@section('content')
    <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
        <tr>
            <td width="2%" class="title">م</td>
            <td width="5%" class="title">رقم الفسيل</td>
            <td width="5%" class="title">نوع العمل</td>
            <td width="8%" class="title">رقم أمر العمل</td>
            <td width="7%" class="title">تاريخ الاستلام</td>
            {{-- <td width="5%" class="title">المدة الفعلية</td> --}}
            <td width="4%" class="title">مدة التنفيذ</td>
            <td width="5%" class="title">اسم المشترك</td>
            <td width="4%" class="title">الحى</td>
            <td width="5%" class="title">رقم المحطة</td>
            <td width="7%" class="title">اسم الاستشارى</td>
            <td width="4%" class="title">عامود ١٠</td>
            <td width="4%" class="title">عامود ١٣</td>
            <td width="4%" class="title">محول</td>
            <td width="4%" class="title">شداد</td>
            <td width="4%" class="title">شبكة ض/ع</td>
            <td width="4%" class="title">شبكة ض/م</td>
            <td width="5%" class="title">طول الحفرية</td>
            <td width="5%" class="title">الحالة</td>
            {{-- <td width="5%" class="title">ملاحظات</td> --}}
            <td width="7%" class="title">الوصف</td>
            <td width="9%" class="title">المنفذ لأعمال الحفر</td>
            <td width="4%" class="title">مقايسة</td>
            <td width="4%" class="title">ازبلت</td>
        </tr>

            @foreach ($data as $workOrder)
            <tr>
                <td class="TextCenter">{{ $loop->index +1 }}</td>
                <td class="TextCenter">{{$workOrder->reference_number}}</td>
                <td class="TextCenter">{{$workOrder->work_type_code}}</td>
                <td class="TextCenter">{{$workOrder->work_order_number}}</td>
                <td class="TextCenter">{{$workOrder->received_date->format('Y-m-d')}}</td>
                {{-- <td class="TextCenter">-</td> --}}
                <td class="TextCenter">{{$workOrder->work_period}}</td>
                <td class="TextCenter">{{$workOrder->customer_name}}</td>
                <td class="TextCenter">{{$workOrder->district_name}}</td>
                <td class="TextCenter">{{$workOrder->electrical_station_number}}</td>
                <td class="TextCenter">{{$workOrder->consultant_name}}</td>
                <td class="TextCenter">{{$workOrder->electricity_tower->tower10}}</td>
                <td class="TextCenter">{{$workOrder->electricity_tower->tower13}}</td>
                <td class="TextCenter">{{$workOrder->electricity_tower->converter}}</td>
                <td class="TextCenter">{{$workOrder->electricity_tower->shadad}}</td>
                <td class="TextCenter">{{$workOrder->electricity_tower->grid_high_voltage}}</td>
                <td class="TextCenter">{{$workOrder->electricity_tower->grid_low_voltage}}</td>
                <td class="TextCenter">{{$workOrder->landscape_length_total}}</td>
                <td class="TextCenter">{{$workOrder->statusTitle['title']}}</td>
                {{-- <td class="TextCenter">{{$workOrder->description}}</td> --}}
                <td class="TextCenter">{{$workOrder->description}}</td>
                <td class="TextCenter">{{$workOrder->drilling_worker}}</td>
                <td class="TextCenter">{{($workOrder->assay_forms_status)? config('const.assay_form')[$workOrder->assay_forms_status]['title'] : 'لا توجد مقايسة' }}</td>
                <td class="TextCenter">{{config('const.asbuilt_status')[$workOrder->asbuilt_status]}}</td>

            </tr>
        @endforeach
    </table>

@endsection
