    @include('layouts.partials.print_style')

    <body>
        @include('layouts.partials.print_header')
        <br>
        @php
        $work_order_permit_status= config("const.work_order_permit_status");
        $lab_result_status_list= config("const.lab_result_status_list");
        @endphp
        <table width="100%" border="0" cellspacing="0" cellpadding="0" dir="rtl" style="border-collapse:collapse;">
            <tr>
                <td class="TextCenter">رقم التصريح :</td>
                <td class="Text">{{ $data->permit_number }}</td>
                <td class="TextCenter">رقم امر العمل :</td>
                <td class="Text">{{ $data->workOrders[0]->work_order_number }}</td>
                <td class="TextCenter">نوع التصريح :</td>
                <td class="Text">{{ $data->workOrdersPermitType->name }}</td>
            </tr>
            <tr>
                <td class="TextCenter"> رقم إحالة السداد :</td>
                <td class="Text">{{ $data->sadad_number }}</td>
                <td class="TextCenter">مبلغ الاصدار :</td>
                <td class="Text">{{ $data->issued_amount }}</td>
                <td class="TextCenter">مدة التصريح :</td>
                <td class="Text">{{ $data->period }}</td>
            </tr>
            <tr>
                <td class="TextCenter">حالة التصريح :</td>
                <td class="Text">{{ $work_order_permit_status[$data->status]['title'] }}</td>
                <td class="TextCenter">تاريخ الإصدار :</td>
                <td class="Text">{{ $data->issue_date }}</td>
                <td class="TextCenter">تاريخ البداية :</td>
                <td class="Text">{{ $data->start_date }}</td>
            </tr>
            <tr>
                <td class="TextCenter">تاريخ النهاية :</td>
                <td class="Text">{{ $data->end_date }}</td>

                <td class="TextCenter">ملاحظات :</td>
                <td class="Text">{{ $data->notes }}</td>
            </tr>
            <tr>
                <td colspan="12" class="TextCenter"></td>
            </tr>
        </table>
        <br><br>
        @if (!empty($data->workOrdersPermitsExtension[0]))
            <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl"
                style="border-collapse:collapse;">
                <tr>
                    <td colspan="12" class="TextCenter">التمديدات</td>
                </tr>
                <tr class="TextCenter">
                    <td width="20%" class="TextCenter">رقم السداد</td>
                    <td width="20%" class="TextCenter">تاريخ البدء</td>
                    <td width="20%" class="TextCenter">تاريخ الانتهاء</td>
                    <td width="20%" class="TextCenter">مبلغ التمديد</td>
                    <td width="20%" class="TextCenter">ملاحظات</td>
                </tr>
                @foreach ($data->workOrdersPermitsExtension as $workFine)
                    <tr class="TextCenter">
                        <td class="TextCenter">{{ $workFine->sadad_number }}</td>
                        <td class="TextCenter">{{ $data->start_date }}</td>
                        <td class="TextCenter">{{ $data->end_date }}</td>
                        <td class="TextCenter">{{ $data->total_extend_amount }}</td>
                        <td class="TextCenter">{{ $data->notes }}</td>
                    </tr>
                @endforeach
            </table>
        @endif

        <br><br>
        @if (!empty($data->workOrdersPermitsFine[0]))
        <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl"
            style="border-collapse:collapse;">
            <tr>
                <td colspan="12" class="TextCenter">الغرامات</td>
            </tr>
            <tr class="pg-black">
                <td width="20%" class="TextCenter">رقم السداد</td>
                <td width="20%" class="TextCenter">تاريخ الغرامه</td>
                <td width="20%" class="TextCenter">المبلغ</td>
                <td width="20%" class="TextCenter">سبب الغرامه</td>
                <td width="20%" class="TextCenter">ملاحظات</td>
            </tr>
            @foreach ($data->workOrdersPermitsFine as $workFine)
                <tr>
                    <td width="20%" class="TextCenter">{{ $workFine->sadad_number }}</td>
                    <td width="20%" class="TextCenter">{{ $workFine->issue_date->format('Y-m-d') }}</td>
                    <td width="20%" class="TextCenter">{{ $workFine->amount }}</td>
                    <td width="20%" class="TextCenter">{{ $workFine->fine_reason }}</td>
                    <td width="20%" class="TextCenter">{{ $data->notes }}</td>
                </tr>
            @endforeach
        </table>
        @endif
        <br><br>
        {{-- @dd($data->landLayersHistory) --}}
        @if (!empty($data->landLayersHistory[0]))
        <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl"
            style="border-collapse:collapse;">
            <tr>
                <td colspan="12" class="TextCenter">اعمال اعادة الوضع</td>
            </tr>
            <tr class="pg-black">
                <td width="10%" class="TextCenter">النوع</td>
                <td width="14%" class="TextCenter">الطبقة</td>
                <td width="14%" class="TextCenter">نتيجة المختبر</td>
                <td width="14%" class="TextCenter">سبب الرسوب</td>
                <td width="18%" class="TextCenter">المنفذ</td>
                <td width="14%" class="TextCenter">منشئ السجل</td>
                <td width="16%" class="TextCenter">تاريخ التنفيذ</td>
            </tr>
            @foreach ($data->landLayersHistory as $landLayer)

                <tr>
                    <td width="10%" class="TextCenter">
                        @if($landLayer->event_type=="created") اضافة @else تعديل @endif
                    </td>
                    <td width="14%" class="TextCenter">{{$landLayer->layer->name}}</td>
                    <td width="14%" class="TextCenter">{{$lab_result_status_list[$landLayer->lab_result_status]}}</td>
                    <td width="14%" class="TextCenter">{{ $landLayer->note }}</td>
                    <td width="18%" class="TextCenter">
                        @if($landLayer->land_layer->layer_worker_type==2) الموظف - {{ $landLayer->land_layer->employee->name  }} @else المقاول - {{ $landLayer->land_layer->contractor->name }} @endif
                    </td>
                    <td width="14%" class="TextCenter">{{$landLayer->user->name}}</td>
                    <td width="16%" class="TextCenter">{{ $landLayer->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </table>
        @endif
        <br><br>
        <table width="100%" border="1" cellspacing="0" cellpadding="0" dir="rtl"
            style="border-collapse:collapse;">
            <tr>
                <td colspan="16" class="TextCenter">الاجمالى</td>
            </tr>
            <tr>
                <td class="TextCenter">مبلغ الاصدار</td>
                <td colspan="7" class="TextCenter">{{ $data->issued_amount ?? 0 }}</td>
                <td class="TextCenter">مبلغ التسليم</td>
                <td colspan="7" class="TextCenter">{{ $data->clearance_sdad_amount ?? 0 }}</td>
            </tr>
            <tr>
                <td class="TextCenter">اجمالى الغرامات</td>
                <td colspan="7" class="TextCenter">{{ $data->total_fines_amount ?? 0 }}</td>
                <td class="TextCenter">اجمالى التمديدات</td>
                <td colspan="7" class="TextCenter">{{ $data->total_extend_amount ?? 0 }}</td>
            </tr>
            <tr>
                <td colspan="9" class="TextCenter">اجمالى تكلفه التصريح</td>
                <td colspan="7" class="TextCenter">{{ $data->total_amount ?? 0 }}</td>
            </tr>
            {{-- @endforeach --}}

        </table>
        <br><br>
    </body>
