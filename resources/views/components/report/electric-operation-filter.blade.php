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
        <x-date-pickr name="from_finished_date" :labelTitle="__('models/workOrders.fields.from_finished_date')"></x-date-pickr>
    </div>
    <div class="mb-1">
        <x-date-pickr name="to_finished_date" :labelTitle="__('models/workOrders.fields.to_finished_date')"></x-date-pickr>
    </div>
    <div class="mb-1">
        {!! Form::label('work_type_id', __('models/workOrders.fields.work_type_name').':') !!}
        {!! Form::select('work_type_id', $m,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
</div>
