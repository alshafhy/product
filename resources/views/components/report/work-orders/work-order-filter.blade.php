<div>
    <div class="mb-1">
        <label class="form-label" for="amount">أمر العمل</label>
        <input id="work_order_number" name="work_order_number" class="form-control" type="number" placeholder="رقم أمر العمل" />
    </div>
    <div class="row">
        <div class=" mb-1  col-6">
            <x-date-pickr name="from_received_date" :labelTitle="__('models/workOrders.fields.from_received_date')"></x-date-pickr>
        </div>
        <div class=" mb-1 col-6">
            <x-date-pickr name="to_received_date" :labelTitle="__('models/workOrders.fields.to_received_date')"></x-date-pickr>
        </div>
    </div>
    @if (request()->is('reports/previewPdf/finishedDrillingWorkOrdersReport'))
        <div class="row">
            <div class="mb-1 col-6">
                <x-date-pickr name="from_drilling_complete_date" :labelTitle="__('models/workOrders.fields.from_finished_date')"></x-date-pickr>
            </div>
            <div class="mb-1 col-6">
                <x-date-pickr name="to_drilling_complete_date" :labelTitle="__('models/workOrders.fields.to_finished_date')"></x-date-pickr>
            </div>
        </div>
        <div class="mb-1">
            {!! Form::label('project_id', __('models/workOrders.fields.project').':') !!}
            {!! Form::select('project_id', $workOrdersProject,null, ['class' => 'select2 form-select form-control']) !!}
        </div>
    @endif
    <div class="mb-1">
        {!! Form::label('status', __('models/workOrders.fields.status').':') !!}
        {!! Form::select('status', $workOrderStatus,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
    <div class="mb-1">
        {!! Form::label('electricity_department_id', __('models/workOrders.fields.electricity_department_name').':') !!}
        {!! Form::select('electricity_department_id', $electricityDepartments,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
    <div class="mb-1">
        {!! Form::label('consultant_id', __('models/workOrders.fields.consultant_name').':') !!}
        {!! Form::select('consultant_id', $consultants,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
    <div class="mb-1">
        {!! Form::label('work_type_id', __('models/workOrders.fields.work_type_id').':') !!}
        {!! Form::select('work_type_id', $workTypes,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
    <div class="mb-1">
        {!! Form::label('drilling_worker', __('models/workOrders.fields.drilling_works').':') !!}
        {!! Form::select('drilling_worker', $drilling_worker,null, ['class' => 'select2 form-select form-control']) !!}
    </div>

</div>
