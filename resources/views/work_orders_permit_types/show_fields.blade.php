<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', __('models/workOrdersPermitTypes.fields.id').':') !!}
    <p>{{ $workOrdersPermitType->id }}</p>
</div>

<!-- Name Field -->
<div class="col-sm-12">
    {!! Form::label('name', __('models/workOrdersPermitTypes.fields.name').':') !!}
    <p>{{ $workOrdersPermitType->name }}</p>
</div>

<!-- Description Field -->
<div class="col-sm-12">
    {!! Form::label('description', __('models/workOrdersPermitTypes.fields.description').':') !!}
    <p>{{ $workOrdersPermitType->description }}</p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/workOrdersPermitTypes.fields.created_at').':') !!}
    <p>{{ $workOrdersPermitType->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/workOrdersPermitTypes.fields.updated_at').':') !!}
    <p>{{ $workOrdersPermitType->updated_at }}</p>
</div>

