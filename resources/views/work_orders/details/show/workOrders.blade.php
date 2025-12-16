<div class="row m-1">
    <div class="table-responsive">
        <table class="table table-bordered" id="permits-table">
            <thead>
            <tr>
                <th>{{__('models/emergencyMissions.fields.mission_number')}}</th>
                <th>{{__('models/emergencyMissions.fields.received_date')}}</th>
                <th>{{__('models/emergencyMissions.fields.district_name')}}</th>
                <th>{{__('models/workOrders.fields.current_department_name')}}</th>
                <th>{{__('models/emergencyMissions.fields.customer_number')}}</th>
                <th>{{__('models/emergencyMissions.fields.description')}}</th>
                <th>{{__('models/emergencyMissions.fields.mission_received_employee_short')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($workOrder->workOrders as $workOrder)
                <tr>
                    <td>{{$workOrder->mission_number}}</td>
                    <td>{{$workOrder->received_date}}</td>
                    <td>{{$workOrder->district->name ?? ''}}</td>
                    <td>{!! $workOrder->current_department->name ?? '<span class="badge rounded-pill badge-light-danger">غير مربوط بادارة</span>'  !!}</td>
                    <td>{{$workOrder->customer_number}}</td>
                    <td>{{$workOrder->description}}</td>
                    <td>{{$workOrder->received_employee->name ?? ''}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; color: red; ">لا توجد تصاريح</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
