
    <div class="row m-1">
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">حالة تنفيذ الأعمال الكهربائية</span>:
            {{ config("const.general_work_opreation_status.".$workOrder->electrical_operation->status.".title") ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">تاريخ التنفيذ</span>:
            {{$workOrder->electrical_operation->electrical_complete_date ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">الطبلون</span>:
            {{$workOrder->electrical_operation->tablun ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">رقم المخرج</span>:
            {{$workOrder->electrical_operation->end ?? 'غير معرف' }}
        </div>
    </div>
    <div class="row m-1">
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">الجهد</span>:
            {{$workOrder->electrical_operation->end_type ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">قاطع المحطة</span>:
            {{$workOrder->electrical_operation->station_breaker ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">عدد العدادات</span>:
            {{$workOrder->electrical_operation->total_electrical_counters ?? 'غير معرف' }}
        </div>
        <div class="col-sm-3">
            <span class="fw-bolder text-primary">نوع المنفذ</span>:
            @if($workOrder->electrical_operation->electrical_worker_type)
                @switch($workOrder->electrical_operation->electrical_worker_type)
                    @case('employee')
                        {{$workOrder->electrical_operation->employee->name ?? '-'}} (موظف)
                    @break
                    @case('contractor')
                    {{$workOrder->electrical_operation->contractor->name ?? '-'}} (مقاول)
                    @break
                @endswitch
            @else
                غير معرف
            @endif
        </div>
    </div>

<div class="row m-1">
    <table class="table table-striped table-responsive table-sm" id="electric_meters_table">
        <thead>
        <tr>
            <th>رقم العداد</th>
            <th>رقم الاشتراك</th>
            <th>القراءة السابقة</th>
            <th>السعة السابقة</th>
            <th>السعة المعتمدة</th>
        </tr>
        </thead>
        <tbody id="electric_meters_rows">
        @forelse($workOrder->meters as $meter)
            <tr>
                <td>{{$meter->meter_no}}</td>
                <td>{{$meter->subscription_no}}</td>
                <td>{{$meter->reading}}</td>
                <td>{{$meter->previous_capacity}}</td>
                <td>{{$meter->approved_capacity}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5" style="text-align:center; color: red; ">لا توجد عدادات</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
