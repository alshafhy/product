<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/workTypes.fields.id').':') !!}
    <p>{{ $workType->id }}</p>
</div>

<!-- Code Field -->
<div class="col-sm-12">
    {!! Form::label('code', __('models/workTypes.fields.code').':') !!}
    <p>{{ $workType->code }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/workTypes.fields.name').':') !!}
    <p>{{ $workType->name }}</p>
</div>

<!-- Notes Field -->
<div class="col-sm-12">
    {!! Form::label('notes', __('models/workTypes.fields.notes').':') !!}
    <p>{{ $workType->notes }}</p>
</div>

<!-- Needs Drilling Operations Field -->
<div class="col-sm-12">
    {!! Form::label('needs_drilling_operations', __('models/workTypes.fields.needs_drilling_operations').':') !!}
    <p>{{ $workType->needs_drilling_operations }}</p>
</div>

<!-- Needs Electrical Work Field -->
<div class="col-sm-12">
    {!! Form::label('needs_electrical_work', __('models/workTypes.fields.needs_electrical_work').':') !!}
    <p>{{ $workType->needs_electrical_work }}</p>
</div>

<!-- Needs Work Orders Permit Field -->
<div class="col-sm-12">
    {!! Form::label('needs_work_orders_permit', __('models/workTypes.fields.needs_work_orders_permit').':') !!}
    <p>{{ $workType->needs_work_orders_permit }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/workTypes.fields.created_at').':') !!}
    <p>{{ $workType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/workTypes.fields.updated_at').':') !!}
    <p>{{ $workType->updated_at }}</p>
</div>

