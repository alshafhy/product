<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', __('models/workTypes.fields.code').':') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/workTypes.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notes', __('models/workTypes.fields.notes').':') !!}
    {!! Form::text('notes', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    <x-select2 name="default_department_id" :options="$departmentsList" :labelTitle="__('models/workTypes.fields.default_department_id')"></x-select2> 
</div>         

<!-- Needs Drilling Operations Field -->
<div class="form-group col-sm-6">
    {{-- {!! Form::label('needs_drilling_operations', __('models/workTypes.fields.needs_drilling_operations').':') !!}
    {!! Form::text('needs_drilling_operations', null, ['class' => 'form-control']) !!} --}}
    <x-custom-switch name="needs_drilling_operations" :labelTitle="__('models/workTypes.fields.needs_drilling_operations')"></x-custom-switch>
</div>

<!-- Needs Electrical Work Field -->
<div class="form-group col-sm-6">
    {{-- {!! Form::label('needs_electrical_work', __('models/workTypes.fields.needs_electrical_work').':') !!}
    {!! Form::text('needs_electrical_work', null, ['class' => 'form-control']) !!} --}}
    <x-custom-switch name="needs_electrical_work" :labelTitle="__('models/workTypes.fields.needs_electrical_work')"></x-custom-switch>
</div>

<!-- Needs Work Orders Permit Field -->
<div class="form-group col-sm-6">
    {{-- {!! Form::label('needs_work_orders_permit', __('models/workTypes.fields.needs_work_orders_permit').':') !!}
    {!! Form::text('needs_work_orders_permit', null, ['class' => 'form-control']) !!} --}}
    <x-custom-switch name="needs_work_orders_permit" :labelTitle="__('models/workTypes.fields.needs_work_orders_permit')"></x-custom-switch>
</div>