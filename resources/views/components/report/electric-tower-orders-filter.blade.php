<div>
    <div class="mb-1">
        <label class="form-label" for="amount">أمر العمل</label>
        <input id="work_order_number" name="work_order_number" class="form-control" type="number" placeholder="رقم أمر العمل" />
    </div>
    <div class="mb-1">
        <x-date-pickr name="from_received_date" :labelTitle="__('models/workOrders.fields.from_received_date')"></x-date-pickr>
    </div>
    <div class="mb-1">
        <x-date-pickr name="to_received_date" :labelTitle="__('models/workOrders.fields.to_received_date')"></x-date-pickr>
    </div>
    <div class="mb-1">
        {!! Form::label('status', __('models/workOrders.fields.status').':') !!}
        {!! Form::select('status', $workOrderStatus,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
    {{-- <div class="mb-1">
        {!! Form::label('electricity_department_id', __('models/workOrders.fields.electricity_department_name').':') !!}
        {!! Form::select('electricity_department_id', $electricityDepartments,null, ['class' => 'select2 form-select form-control']) !!}
    </div> --}}
    {{-- <div class="mb-1">
        {!! Form::label('work_type', __('models/electricTowerWorkOrdersReport.fields.work_type').':') !!}
        {!! Form::select('work_type', $workOrdersType,null, ['class' => 'select2 form-select form-control']) !!}
    </div> --}}
    <div class="mb-1">
        {!! Form::label('work_type_id', __('models/workOrders.fields.work_type_name').':') !!}
        {!! Form::select('work_type_id', $workOrdersType,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
</div>
