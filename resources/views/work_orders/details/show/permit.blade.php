@php
    $work_order_permit_status = config("const.work_order_permit_status");
@endphp
<div class="row m-1">
    <div class="table-responsive">
        <table class="table table-bordered" id="permits-table">
            <thead>
            <tr>
                <th>رقم التصريح</th>
                <th>نوع التصريح</th>
                <th>رقم إحالة السداد</th>
                <th>مبلغ الاصدار</th>
                <th>تاريخ الإصدار</th>
                <th>مدة التصريح</th>
                <th>الحالة</th>
                <th>مده العمل</th>
                <th>المدة المنقضيه من التصريح</th>
            </tr>
            </thead>
            <tbody>
            @forelse($workOrder->workOrdersPermits as $permit)
                <tr>
                    <td>{{$permit->permit_number}}</td>
                    <td>{{$permit->workOrdersPermitType->name}}</td>
                    <td>{{$permit->sadad_number}}</td>
                    <td>{{$permit->issued_amount}}</td>
                    <td>{{$permit->issue_date}}</td>
                    <td>{{$permit->period}}</td>
                    <td>
                        @if(isset($work_order_permit_status[$permit->status]))
                        <span class="badge rounded-pill {{$work_order_permit_status[$permit->status]['class']}}">{{$work_order_permit_status[$permit->status]['title']}}</span>
                        @else
                            {{$permit->status}}
                        @endif
                    </td>
                    <td>{{$permit->total_permit_period}}</td>
                    <td>
                        <div class="d-flex flex-column"><small class="mb-1">{{$permit->total_permit_period_percentage}} %</small>
                            <div class="progress w-100 me-3" style="height: 6px;">
                                <div class="progress-bar badge-light-primary" style="width: {{$permit->total_permit_period_percentage}}%" aria-valuenow="'+data+'%" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align:center; color: red; ">لا توجد تصاريح</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
