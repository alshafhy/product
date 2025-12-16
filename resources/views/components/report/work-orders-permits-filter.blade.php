<div>
    <div class="mb-1">
        <label class="form-label" for="amount">أمر العمل</label>
        <input id="work_order_number" name="work_order_number" class="form-control" type="number" placeholder="رقم أمر العمل" />
    </div>
    <div class="row">
        <div class="form-group col-sm-6">
            <x-date-pickr name="from_issue_date" :labelTitle="__('models/workOrdersPermits.fields.from_issue_date')"></x-date-pickr>
        </div>
        <div class="form-group col-sm-6">
            <x-date-pickr name="to_issue_date" :labelTitle="__('models/workOrdersPermits.fields.to_issue_date')"></x-date-pickr>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-sm-6 m-0">
            <x-date-pickr name="from_end_date" :labelTitle="__('models/workOrdersPermits.fields.from_end_date')"></x-date-pickr>
        </div>
        <div class="form-group col-sm-6 m-0">
            <x-date-pickr name="to_end_date" :labelTitle="__('models/workOrdersPermits.fields.to_end_date')"></x-date-pickr>
        </div>
    </div>
    {{-- @dd($workOrders) --}}
    <div class="mb-1">
        {!! Form::label('status', __('models/workOrdersPermits.fields.status').':') !!}
        {!! Form::select('status',$workOrdersPermits,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
    <div class="mb-1">
        {!! Form::label('work_order_status', __('models/workOrdersPermits.fields.work_order_status').':') !!}
        {!! Form::select('work_order_status',$workOrderStatus,null, ['class' => 'select2 form-select form-control']) !!}
    </div>
</div>
